<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-27
 * Time: 17:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'messageId';
    protected $guarded = [];
    public $timestamps = false;
}