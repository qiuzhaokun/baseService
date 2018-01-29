<?php


$router->get('/', function (){
    return json_encode(['status' => 404, 'message' => '请求地址错误', 'data' => []]);
});
//微信 access_token 中控
$router->get('/accessToken', 'AccessTokenController@weChatAccessToken');

$router->get('/location', 'LocationController@location');
