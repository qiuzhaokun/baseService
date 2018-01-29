<?php
/**
 * Des:
 * Author: larry
 * Date: 29/01/2018
 * Time: 11:13 AM
 */

namespace App\Services;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class Helper
{
    public static function jsonGet(string $key)
    {
        if(empty($key)){
            return null;
        }
        Redis::select(config('cache.storage_default_db'));
        $res = Redis::get($key);
        return json_decode($res, true);
    }

    public static function jsonSet(string $key, $data, int $expire_time = 0)
    {
        if(empty($key) || empty($data)){
            return null;
        }

        Redis::select(config('cache.storage_default_db'));
        if ($expire_time) {
            return Redis::setex($key, intval($expire_time), json_encode($data));
        } else {
            return Redis::set($key, json_encode($data));
        }
    }

    public static function getCacheKey(string $key, array $data)
    {
        $cacheKey = config('cacheKey.' . $key);
        if (empty($key) || empty($cacheKey)) {
            return null;
        }
        $cacheKeyRes = null;
        if (strpos($cacheKey, '{') == false || strpos($cacheKey, '}') == false || empty($data)) {
            return $cacheKey;
        }
        $i = 0;
        foreach ($data as $key => $value) {
            if ($i == 0) {
                $cacheKeyRes = $cacheKey;
            }
            $i++;
            $cacheKeyRes = str_replace('{' . $key . '}', $value, $cacheKeyRes);
        }
        return $cacheKeyRes;
    }


}