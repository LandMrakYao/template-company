<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * json返回格式
     * @param $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiResponse($data,  $code = 0)
    {
        if($code == 0){
            return response()->json([
                'resultStatus'  => $code == 0 ? true : false,
                'errorCode'     => $code  !=0 ? $code : null,
                'errorMessage'  => null,
                'resultData'    => $data

            ]);
        }else{
            return response()->json([
                'resultStatus'  =>  false,
                'errorCode'     => $code['errorCode'],
                'errorMessage'  => $code['errorMessage'],
                'resultData'    => null

            ]);
        }

    }
}
