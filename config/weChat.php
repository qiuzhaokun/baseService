<?php
/**
 *
 * Created by: larry
 * DateTime: 20/12/2017 15:56
 */

return [
    'requestClient'    => [
        'url' => 'https://api.weixin.qq.com/cgi-bin/token',
        'query' => [
            'grant_type' => 'client_credential',
            'appid' => '',
            'secret' => '',
        ],
        'config' => [
            'timeout' => 3,
        ],
    ],
    'accessToken' => [
        [
            'appid'  => '123',
            'secret' => '123',
        ],
        [
            'appid'  => '123123',
            'secret' => '123',
        ],
    ],
];