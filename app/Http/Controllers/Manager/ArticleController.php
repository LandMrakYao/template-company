<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-11-08
 * Time: 17:53
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $acId = $request->acId;
        $data = Article::where('acId', $acId)->orderBy('created_at','DESC')->paginate(20)->toArray();
        $result['article'] = $data['data'];
        $result['totalNum'] = $data['total'];
        return $this->apiResponse($result);
    }

    public function show($articleId)
    {
        $data = Article::where('articleId', $articleId)->first();
        return $this->apiResponse($data);
    }

    public function store(Request $request)
    {
        $data = $request->only(['articleId', 'articleSort', 'articleTitle', 'imageUrl', 'articleContent','acId']);
        $validator = Validator::make($data, [
            'articleSort' => 'required',
            'articleTitle' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse('', config('errorCode.INVALID_REQ_PARAMS'));
        }
        $articleId = $data['articleId'];
        unset($data['articleId']);
        if ($articleId) {
            //編輯
            $status = Article::where('articleId', $articleId)->update($data);
        } else {
            $status = Article::create($data);
        }
        if (!$status) {
            return $this->apiResponse('', config('errorCode.UPDATE_ERROR'));
        }
        return $this->apiResponse('');
    }

    public function destroy($articleId)
    {
        Article::destroy($articleId);
        return $this->apiResponse('');
    }
}