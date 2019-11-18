<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/30
 * Time: 22:24
 */

namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'gname'=>'require',
        'gthumb'=>'require',
        'gbanner'=>'require',
        'nprice'=>'require',
        'oprice'=>'require',
        'gdetail'=>'require',
        'id'=>'require',
    ];
    protected $message = [
        'id'=>'id字段必填',
        'gthumb'=>'gthumb字段必填',
        'gname'=>'gname字段必填',
        'gbanner'=>'gbanner字段必填',
        'nprice'=>'nprice字段必填',
        'oprice'=>'oprice字段必填',
        'gdetail'=>'gdetail字段必填',
    ];
    protected $scene = [
        'insert'=>['gname','gthumb','gbanner','nprice','oprice','gdetail'],
        'delete'=>['id']
    ];

}