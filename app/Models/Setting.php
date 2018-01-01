<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-26
 * Time: 20:39
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $guarded = [];
    public $timestamps = false;
}