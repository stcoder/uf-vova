<?php namespace App\Http\Controllers\Admin;

use Admin;
use AdminTemplate;
use App\Http\Controllers\Controller;
use App\Integration\Services\Vk;
use Carbon\Carbon;
use Socialite;
use App\Option;
use Session;

class Integration extends Controller {

    /**
     * Интеграция.
     *
     * @return \Illuminate\View\View
     */
    public function main() {
        $isUserIntegrated = Option::get('vk-user-id', null);
        $isGroupIntegrated = Option::get('vk-group-id', null);
        $isBoardIntegrated = Option::get('vk-board-topic-id', null);
        $data = ['user' => [], 'group' => []];

        if ($isUserIntegrated) {
            $data['user'] = [
                'id' => Option::get('vk-user-id'),
                'username' => Option::get('vk-user-name'),
                'avatar' => Option::get('vk-user-avatar'),
                'integrated-date' => Carbon::createFromTimestamp(Option::get('vk-user-integrated-date'))
            ];
        }

        if ($isGroupIntegrated) {
            $data['group'] = [
                'id' => Option::get('vk-group-id'),
                'name' => Option::get('vk-group-name'),
                'photo' => Option::get('vk-group-photo'),
                'integrated-date' => Carbon::createFromTimestamp(Option::get('vk-group-integrated-date')),
                'updated-date' => Carbon::createFromTimestamp(Option::get('vk-group-last-update-date')),
                'posts_count' => Option::get('vk-posts-count')
            ];

            if (Option::has('vk-group-updated-date')) {
                $data['group']['updated-date'] = Carbon::createFromTimestamp(Option::get('vk-group-updated-date'));
            }
        }
        
        if ($isBoardIntegrated) {
            $data['review'] = [
                'id' => Option::get('vk-board-topic-id'),
                'integrated-date' => Carbon::createFromTimestamp(Option::get('vk-board-integrated-date')),
                'reviews_count' => Option::get('vk-reviews-count'),
                'updated-date' => Carbon::createFromTimestamp(Option::get('vk-reviews-last-update-date'))
            ];
        }
        
        $display = view('admin.integration.services', $data)->render();
        return Admin::view($display, 'Интеграция');
    }

    /**
     * Выводит список групп для подключения.
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function groupSelect() {
        $data = [];

        $response = Vk::call('groups.get', [
            'user_id' => Option::get('vk-user-id'),
            'extended' => 1
        ]);

        $data['groups'] = array_slice($response['response'], 1);

        $display = view('admin.integration.group-select', $data)->render();
        return Admin::view($display, 'Подключение группы');
    }


    /**
     * Сохраняет группу в опции.
     *
     * @param $gid
     * @return Response
     * @throws \Exception
     */
    public function groupSet($gid) {
        $response = Vk::call('groups.getById', [
            'group_id' => $gid,
            'fields' => 'members_count,counters'
        ]);

        $group = $response['response'][0];

        Option::set('vk-group-id', $group['gid']);
        Option::set('vk-group-name', $group['name']);
        Option::set('vk-group-photo', $group['photo']);
        Option::set('vk-group-integrated-date', time());
        Option::set('vk-group-count-members', $group['members_count']);
        Option::set('vk-group-count-photos', $group['counters']['photos']);
        Option::set('vk-group-count-albums', $group['counters']['albums']);
        Option::set('vk-group-count-topics', $group['counters']['topics']);
        Option::set('vk-group-count-videos', $group['counters']['videos']);
        Option::set('vk-group-count-audios', $group['counters']['audios']);
        Option::set('vk-group-count-docs', $group['counters']['docs']);

        Session::flash('flash_message', 'vk-group-integrated');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }

    /**
     * Отключает группу.
     *
     * @return Response
     */
    public function groupOff() {
        Option::set('vk-group-id', null);
        Option::set('vk-group-name', null);
        Option::set('vk-group-photo', null);
        Option::set('vk-group-integrated-date', null);
        Option::set('vk-group-count-members', null);
        Option::set('vk-group-count-photos', null);
        Option::set('vk-group-count-albums', null);
        Option::set('vk-group-count-topics', null);
        Option::set('vk-group-count-videos', null);
        Option::set('vk-group-count-audios', null);
        Option::set('vk-group-count-docs', null);

        Session::flash('flash_message', 'vk-group-off');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }

    /**
     * Выводит список топиков обсуждений для подключения.
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function boardTopic() {
        $data = [];

        $response = Vk::call('board.getTopics', [
            'group_id' => Option::get('vk-group-id'),
            'count' => 100,
            'extended' => 0,
            'preview' => 1
        ]);

        $data['count'] = $response['response']['topics'][0];
        $data['topics'] = array_slice($response['response']['topics'], 1);

        $display = view('admin.integration.board-select', $data)->render();
        return Admin::view($display, 'Выберите топик обсуждений с отзывами');
    }

    /**
     * @param $topic_id
     * @return mixed
     * @throws \Exception
     */
    public function boardTopicSet($topic_id) {
        $response = Vk::call('board.getComments', [
            'group_id' => Option::get('vk-group-id'),
            'topic_id' => $topic_id,
            'count' => 0
        ]);

        $comments = $response['response']['comments'][0];

        Option::set('vk-board-topic-id', $topic_id);
        Option::set('vk-board-integrated-date', time());
        Option::set('vk-reviews-count', $comments);

        Session::flash('flash_message', 'vk-board-topic-integrated');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }

    /**
     * @return mixed
     */
    public function boardTopicOff() {
        Option::set('vk-board-topic-id', null);
        Option::set('vk-board-integrated-date', null);
        Option::set('vk-reviews-count', null);

        Session::flash('flash_message', 'vk-board-topic-off');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }

    /**
     * Redirect the user to the vkontakte authentication page.
     *
     * @return Response
     */
    public function redirectToProvider() {
        return Socialite::with('vkontakte')->scopes(['offline', 'groups', 'wall', 'video', 'audio'])->redirect();
    }

    /**
     * Отключает интегрированного пользователя.
     *
     * @return Response
     */
    public function providerOff() {
        Option::set('vk-user-id', null);
        Option::set('vk-user-name', null);
        Option::set('vk-user-avatar', null);
        Option::set('vk-user-token', null);
        Option::set('vk-user-integrated-date', null);

        Session::flash('flash_message', 'vk-user-off');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }

    /**
     * Obtain the user information from vkontakte.
     *
     * @return Response
     */
    public function handleProviderCallback() {
        $user = Socialite::with('vkontakte')->user();
        Option::set('vk-user-id', $user->id);
        Option::set('vk-user-name', $user->name);
        Option::set('vk-user-avatar', $user->avatar);
        Option::set('vk-user-token', $user->token);
        Option::set('vk-user-integrated-date', time());

        Session::flash('flash_message', 'vk-user-integrated');
        Session::flash('flash_type', 'success');

        return redirect(route('admin.integration'));
    }
}
