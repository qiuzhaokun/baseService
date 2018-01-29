<?php

namespace App\Http\Middleware;

use Closure;

class ApiResponseJson
{
    /**
     * api  统一返回格式
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $next($request)->original;
        if (!is_array($data) && !empty($data)) {
            return $next($request);
        }
        $status = 200;
        $msg = 'ok.';

        if (!empty($data['status'])) {
            $status = $data['status'];
            $msg = $data['err'] ?? ($data['msg'] ?? $msg);
            $data = $data['data'] ?? [];
        }

        if (!empty($data['err'])) {
            $status = $data['status'] ?? 500;
            $msg = $data['err'] ?? $msg;
            $data = $data['data'] ?? [];
        }

        $response = ['status' => $status, 'msg' => $msg, 'data' => $data ?: []];
        $status = strlen($status) > 3 ?  500 : $status;
        return Response()->json($response, $status);
    }
}
