<?php namespace App\Integration\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Exception;

class Vk {
    /**
     * Access Token для запросов.
     *
     * @var string
     */
    protected static $accessToken = '';

    /**
     * @var string
     */
    protected static $patternUrl = 'https://api.vk.com/method/%s?%s';

    /**
     * @param string $accessToken
     */
    public static function setAccessToken($accessToken) {
        self::$accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public static function getAccessToken() {
        return self::$accessToken;
    }

    /**
     * @param string $method
     * @param array $query
     * @return array
     * @throws Exception
     */
    public static function call($method, $query = []) {
        $query['access_token'] = self::getAccessToken();
        $url = sprintf(self::$patternUrl, $method, http_build_query($query));

        $client = new Client();
        $request = new Request('GET', $url);
        $response = $client->send($request);

        if (empty($response)) {
            throw new Exception('Response is empty', -1);
        }

        $json = json_decode((string)$response->getBody(), true);
        if (empty($json)) {
            throw new Exception('Error while parsing JSON.', -2);
        }

        if (isset($json['error'])) {
            throw new Exception($json['error']['error_msg'], $json['error']['error_code']);
        }

        return $json;
    }
}