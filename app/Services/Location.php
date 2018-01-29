<?php
/**
 * Des:
 * Author: larry
 * Date: 29/01/2018
 * Time: 4:49 PM
 */

namespace App\Services;


use GuzzleHttp\Client;

class Location
{

    public static function getTenCentLocation($config, $lat, $long)
    {
        $api_url = $config['api'] . http_build_query([
                'key'      => $config['key'],
                'location' => $lat . ',' . $long,
            ]);
        $client = new Client();
        $response = $client->request('GET', $api_url);
        $body = json_decode($response->getBody(), true);

        if (!isset($body['status']) || $body['status'] != 0) {
            return ['err' => '定位失败', 'data' => $body];
        }

        $res = $body['result']['address_component'];
        $res['address'] = $body['result']['address'];

        return $res;
    }
}