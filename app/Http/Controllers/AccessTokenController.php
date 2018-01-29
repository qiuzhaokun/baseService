<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use App\Services\weChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessTokenController extends Controller
{

    /**
     * 直接获取  storage中的 weChat_{appId}_access_token
     */
    public function weChatAccessToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appId' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 422, 'err' => $validator->errors()];
        }

        $weChatAppId = $request->get('appId');
        $result = weChat::getWeChatAccessToken($weChatAppId);

        return $result;
    }
}
