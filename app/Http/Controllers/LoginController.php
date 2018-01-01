<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-09-23
 * Time: 10:44
 */

namespace App\Http\Controllers;


use App\Models\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * 管理员登陆
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->only('name','password');
        $validator = Validator::make($data,[
            'name'    => 'required',
            'password'    => 'required'
        ]);
        if($validator->fails()){
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }

        $data['enabledStatus'] = 1;
        //$data['password'] = bcrypt($data['password']);
        $password = $data['password'];
        unset($data['password']);
        $status = UserManager::select("*")
            ->where($data)
            ->first();
        if($status){//成功
            if (Hash::check($password, $status['password'])) {
                return $this->apiResponse($status);
            }else{
                return $this->apiResponse('', config('errorCode.MANAGER_LOGIN_FAILED'));
            }

        }else{//登陆失败
            return $this->apiResponse('', config('errorCode.MANAGER_LOGIN_FAILED'));
        }
    }

}