<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-12-01
 * Time: 9:40
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Libs\Contracts\OSS;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        if ($file->isValid()) {

            $realPath = $file->getRealPath();
            $entension = $file -> getClientOriginalExtension();
            $clientName = $file->getClientOriginalName();    //客户端文件名称
            $newName = md5(date('ymdhis') . $clientName) . "." . $entension;    //定义上传文件的新名称

            $mimeTye = $file->getMimeType();
            $path = 'groupon/'.$newName ;
            $model = new OSS();

            $result =  $model->publicUpload('xcxhn',$path,$realPath,[ 'ContentType' => $mimeTye]);

            if($result){
                $data = $model->url.$newName;
                return $this->apiResponse($data);
            }
        }
        return $this->apiResponse('', config('errorCode.UPLOAD_ERROR'));
    }
}