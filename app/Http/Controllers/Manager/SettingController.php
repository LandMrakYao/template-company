<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-26
 * Time: 20:38
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::get();
        return $this->apiResponse($data);
    }

    public function store(Request $request)
    {
        $data = $request->only(['company','recordNumber','url','flow']);
        Setting::where('name','company')->update(['value'=>$data['company']]);
        Setting::where('name','recordNumber')->update(['value'=>$data['recordNumber']]);
        Setting::where('name','url')->update(['value'=>$data['url']]);
        Setting::where('name','flow')->update(['value'=>$data['flow']]);
        return $this->apiResponse('');
    }
}