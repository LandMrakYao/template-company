<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2018-01-01
 * Time: 15:49
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $primaryKey = 'pictureId';
    protected $guarded = [];
}