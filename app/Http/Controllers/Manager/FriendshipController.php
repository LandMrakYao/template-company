<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-12-30
 * Time: 15:20
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FriendshipController extends Controller
{
    public function index(Request $request)
    {
        $data = \DB::table("friendship")->orderBy('createTime','DESC')->get();
        return $this->apiResponse($data);
    }

    public function store(Request $request)
    {
        $data = $request->only(['friendshipId', 'urlName', 'url']);
        $validator = Validator::make($data, [
            'urlName' => 'required',
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }
        $friendshipId = $data['friendshipId'];
        if($friendshipId){
           $status =  \DB::table("friendship")->where('friendshipId',$friendshipId)->update($data);
        }else{
           $status =  \DB::table("friendship")->insert($data);
        }
        if (!$status) {
            return $this->apiResponse('', config('errorCode.UPDATE_ERROR'));
        }
        return $this->apiResponse('');

    }
    public function destroy($friendshipId)
    {
        \DB::table("friendship")->where('friendshipId',$friendshipId)->delete();
        return $this->apiResponse('');
    }
}