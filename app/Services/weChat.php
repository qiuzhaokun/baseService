<?php
/**
 * Des:
 * Author: larry
 * Date: 29/01/2018
 * Time: 4:14 PM
 */

namespace App\Services;

use GuzzleHttp\Client;

class weChat
{
    public static function getWeChatAccessToken($appId)
    {
        $cacheKey = Helper::getCacheKey('weChat.accessToken', ['appId' => $appId]);
        if ($result = Helper::jsonGet($cacheKey)) {
            return $result;
        }
        $config = self::getConfig($appId);
        if (empty($config)) {
            return ['err' => '配置错误'];
        }
        $url = config('weChat.requestClient.url');
        $url = $url . '?' . http_build_query(array_merge(config('weChat.requestClient.query'), $config));
        $clientConfig = config('weChat.requestClient.config');
        $client = new Client();
        $response = $client->request('GET', $url, $clientConfig);
        $body = $response->getBody();
        $body = json_decode($body, true);
        if (!empty($body['errcode'])) {
            return ['err' => $body['errmsg'], 'status' => $body['errcode']];
        }
        //写入缓存
        Helper::jsonSet($cacheKey, $body, ($body['expires_in'] - 60));
        return $body;
    }

    private static function getConfig($appId)
    {
        $config = config('weChat.accessToken');

        $config = collect($config)->keyBy('appid')->toArray();
        return $config[$appId] ?? [];
    }

}