<?php namespace App\Imports;

use App\Option;
use App\Review as ReviewModel;
use App\Profile as ProfileModel;
use App\Profile;
use Carbon\Carbon;
use App\Integration\Services\Vk;

class Review {

    /**
     * @var int
     */
    protected static $__count_imports_reviews = 0;

    /**
     * @var int
     */
    protected static $__count_imports_new_reviews = 0;

    /**
     * @var int
     */
    protected static $__count_imports_profiles = 0;

    /**
     * @var int
     */
    protected static $__count_imports_new_profiles = 0;

    public static function import($offset = 0, $count = 20) {
        $offset = $offset == 0 ? $offset = 1 : $offset;
        list($allReviews, $reviews) = self::getReviews($offset, $count);
        $users = self::getUsers(self::getUserIds($reviews));

        $reviews_filtered = array_values(array_filter($reviews, function($review) use($users) {
            return array_search($review['from_id'], array_column($users, 'uid'));
        }));

        $reviews_mapped = array_map(function($review) use($users) {
            $profile_index = array_search($review['from_id'], array_column($users, 'uid'));
            $review['profile'] = $users[$profile_index];
            return $review;
        }, $reviews_filtered);

        self::resetCounter();
        $reviews_normalized = array_map([__CLASS__, 'normalize'], $reviews_mapped);

        Option::set('vk-reviews-last-update-date', time());
        Option::set('vk-reviews-count', $allReviews);
        return [
            'offset' => $offset,
            'count' => $count,
            'counts' => [
                'all' => $allReviews,
                'reviews' => self::$__count_imports_reviews,
                'new_reviews' => self::$__count_imports_new_reviews,
                'profiles' => self::$__count_imports_profiles,
                'new_profiles' => self::$__count_imports_new_profiles
            ]
        ];
    }

    /**
     * @return void
     */
    public static function resetCounter() {
        self::$__count_imports_reviews = 0;
        self::$__count_imports_new_reviews = 0;
        self::$__count_imports_profiles = 0;
        self::$__count_imports_new_profiles = 0;
    }

    /**
     * @param int $offset
     * @param int $count
     * @return array
     * @throws \Exception
     */
    public static function getReviews($offset = 0, $count = 20) {
        $response = Vk::call('board.getComments', [
            'group_id' => Option::get('vk-group-id'),
            'topic_id' => Option::get('vk-board-topic-id'),
            'offset' => $offset,
            'count' => $count
        ]);

        $response = $response['response'];
        $reviews = array_slice($response['comments'], 1);

        return [$response['comments'][0], $reviews];
    }

    /**
     * @param array $reviews
     * @return array
     */
    public static function getUserIds($reviews) {
        return array_unique(array_column($reviews, 'from_id'));
    }

    /**
     * @param array $userIds
     * @return mixed
     * @throws \Exception
     */
    public static function getUsers(array $userIds) {
        $response = Vk::call('users.get', [
            'user_ids' => $userIds,
            'fields' => 'first_name,last_name,deactivated,photo_200_orig,photo_400_orig,domain'
        ]);

        $response = $response['response'];
        $users = array_values(array_filter($response, function($user) {
            return !isset($user['deactivated']);
        }));

        return $users;
    }

    /**
     * @param $reviewData
     * @return \App\Review
     */
    public static function normalize(&$reviewData) {
        $review = ReviewModel::firstOrNew(['external_id' => $reviewData['id']]);
        $review->external_id = $reviewData['id'];
        $review->text = $reviewData['text'];
        $review->date = Carbon::createFromTimestamp($reviewData['date']);

        $profileData = $reviewData['profile'];
        $profile = ProfileModel::firstOrNew(['external_id' => $reviewData['profile']['uid']]);
        $profile->first_name = $profileData['first_name'];
        $profile->last_name = $profileData['last_name'];
        $profile->domain = $profileData['domain'];

        if (isset($profileData['photo_200_orig'])) {
            $profile->photo = $profileData['photo_200_orig'];
        }
        
        if (isset($profileData['photo_400_orig'])) {
            $profile->photo_big = $profileData['photo_400_orig'];
        }

        $profile->save();
        $profile->reviews()->save($review);

        return $review;
    }
}