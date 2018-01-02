<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2018-01-01
 * Time: 15:46
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\PictureCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PictureController extends Controller
{
    public function index(Request $request)
    {
        $data = Picture::select('t1.*','t2.pictureCategoryName')
            ->from((new Picture())->getTable().' as t1')
            ->join((new PictureCategory())->getTable().' as t2','t1.pictureCategoryId','=','t2.pictureCategoryId')
            ->paginate(20)->toArray();
        $result['picture'] = $data['data'];
        $result['totalNum'] = $data['total'];
        return $this->apiResponse($result);

    }
    public function store(Request $request)
    {
        $data = $request->only(['pictureId', 'pictureUrl','pictureName','pictureCategoryId','pictureSort']);
        $validator = Validator::make($data, [
            'pictureUrl' => 'required',
            'pictureName' => 'required',
            'pictureCategoryId'=>'integer|required',
            'pictureSort' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }
        $pictureId = $data['pictureId'];
        if ($pictureId) {
            //編輯
            $status = Picture::where('pictureId', $pictureId)->update($data);
        } else {
            $status = Picture::create($data);
        }
        if (!$status) {
            return $this->apiResponse('', config('errorCode.UPDATE_ERROR'));
        }
        return $this->apiResponse('');
    }
    public function destroy($pictureCategoryId)
    {
        Picture::destroy($pictureCategoryId);
        return $this->apiResponse('');

    }
}