<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-09-23
 * Time: 10:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserManager extends Model
{
    protected $table = 'user_manager';
    protected $primaryKey = 'managerId';
    protected $guarded = [];
}