<?php
/**
 * 文章分类管理
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-27
 * Time: 18:15
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = ArticleCategory::get()->toArray();
        $articleService = new ArticleService();
        $result = $articleService->tree($data);
        return $this->apiResponse($result);
    }

    public function store(Request $request)
    {
        $data = $request->only(['acId', 'acName', 'acParentId', 'acSort']);
        $validator = Validator::make($data, [
            'acName' => 'required',
            'acSort' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }
        $data['acParentId'] = $data['acParentId'] ? $data['acParentId'] : 0;
        $acId = $data['acId'];
        unset($data['acId']);
        if ($acId) {
            //編輯
            $status = ArticleCategory::where('acId', $acId)->update($data);
        } else {
            $status = ArticleCategory::create($data);
        }
        if (!$status) {
            return $this->apiResponse('', config('errorCode.UPDATE_ERROR'));
        }
        return $this->apiResponse('');
    }

    public function destroy($acId)
    {
        $status = ArticleCategory::destroy($acId);
        if (!$status) {
            ArticleCategory::where("acParentId", $acId)->delete();
        }
        return $this->apiResponse('');
    }
}