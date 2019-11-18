<?php
/**
 * Created by PhpStorm.
 * User: 11412
 * Date: 2019/11/14
 * Time: 16:23
 */

namespace app\common\model;


use think\Model;

class Ordersmodel extends Model
{
    protected $table = 'orders';
    public function insertOrders($data){
        return $this->allowField(true)->save($data);
    }
    public function queryOne($where){
        return $this->where($where)->find();
    }
    public function updateOrders($where,$value){
        return $this->where($where)->update($value);
    }
}