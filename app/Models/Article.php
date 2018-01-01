<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-11-08
 * Time: 17:54
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'articleId';
    protected $guarded = [];
}