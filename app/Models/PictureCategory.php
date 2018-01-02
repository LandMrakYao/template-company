<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2018-01-01
 * Time: 15:50
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PictureCategory extends Model
{
    protected $table = 'picture_category';
    protected $primaryKey = 'pictureCategoryId';
    protected $guarded = [];
}