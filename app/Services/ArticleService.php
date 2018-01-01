<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-10-27
 * Time: 18:21
 */

namespace App\Services;


class ArticleService
{
    //无限级联
    public function tree($array,$parent_id = 0, $level = 0)
    {
        static $list = array();

        foreach ($array as $key => $value) {

            if($value['acParentId'] == $parent_id)
            {
                $value['level'] = $level;
                $list[] = $value;

                $this->tree($array , $value['acId'] , $level+1);
            }

        }

        return $list;
    }
}