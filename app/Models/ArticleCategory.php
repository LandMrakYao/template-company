<?php
/**
 * 文章分类
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-27
 * Time: 18:19
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class articleCategory extends Model
{
    protected $table = 'article_category';
    protected $primaryKey = 'acId';
    protected $guarded = [];
    public $timestamps = false;


}