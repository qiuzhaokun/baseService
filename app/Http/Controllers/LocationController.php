<?php
/**
 * Des:
 * Author: larry
 * Date: 29/01/2018
 * Time: 4:48 PM
 */

namespace App\Http\Controllers;


use App\Services\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * 经纬度定位【腾讯geo】
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function location(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat'  => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ['status' => 402, 'err' => $validator->errors()];
        }

        $lat = $request->get('lat');
        $long = $request->get('long');

        $config = config('common.location');
        do {
            //腾讯 geo
            $response = Location::getTenCentLocation($config['tencent'], $lat, $long);
            if (empty($response['err'])) {
                continue;
            }

            //百度 geo

            //高德 geo

        } while (0);

        return $response;
    }

}