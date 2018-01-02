<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2018-01-01
 * Time: 15:45
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\PictureCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PictureCategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyWords = $request->keyWords;
        $sql = PictureCategory::select("*");
        if($keyWords){
            $sql->where('pictureCategoryName','like','%'.$keyWords.'%');
        }
        $data = $sql->paginate(20)->toArray();
        $result['pictureCategory'] = $data['data'];
        $result['totalNum'] = $data['total'];
        return $this->apiResponse($result);

    }
    public function store(Request $request)
    {
        $data = $request->only(['pictureCategoryId', 'pictureCategoryName']);
        $validator = Validator::make($data, [
            'pictureCategoryName' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }
        $pictureCategoryId = $data['pictureCategoryId'];
        if ($pictureCategoryId) {
            //編輯
            $status = PictureCategory::where('pictureCategoryId', $pictureCategoryId)->update($data);
        } else {
            $status = PictureCategory::create($data);
        }
        if (!$status) {
            return $this->apiResponse('', config('errorCode.UPDATE_ERROR'));
        }
        return $this->apiResponse('');
    }
    public function destroy($pictureCategoryId)
    {
        PictureCategory::destroy($pictureCategoryId);
        return $this->apiResponse('');

    }
}