<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-27
 * Time: 17:25
 */

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $data = Message::paginate()->toArray();
        $result['message'] = $data['data'];
        $result['totalNum'] = $data['total'];
        return $this->apiResponse($result);
    }
}