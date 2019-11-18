<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/29
 * Time: 16:51
 */

namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cname'=>'require|min:2|max:4',
        'cthumb'=>'require',
        'csort'=>'require',
        'id'=>'require',
    ];
    protected $message = [
        'id'=>'id字段必填',
        'cthumb'=>'cthumb字段必填',
        'cname.require'=>'cname字段必填',
        'cname.min'=>'cname最少2个字符',
        'cname.max'=>'cname最多4个字符',
    ];
    protected $scene = [
        'insert'=>['cname','cthumb','csort'],
        'delete'=>['id']
    ];
}