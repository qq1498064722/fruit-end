<?php
/**
 * Created by PhpStorm.
 * User: 11412
 * Date: 2019/11/15
 * Time: 11:25
 */

namespace app\common\model;


use think\Model;

class Addressmodel extends Model
{
    protected $table = 'address';
    public function queryOne($where){
        return $this->where($where)->find();
    }
}