<?php
/**
 * Created by PhpStorm.
 * User: 11412
 * Date: 2019/11/11
 * Time: 15:35
 */

namespace app\common\model;


use think\Model;

class Cartmodel extends Model
{

    protected $table = 'cart';
    //查询是否存在购物车
    public function queryone($uid){
        return $this->where('id', $uid)->find();
    }
    //添加初始化购物车
    public function insertCart($data){
        return $this->allowField(true)->save($data);
    }
    //谁的购物车、加total、price
    public function cartInc($uid,$filed,$value = 1){
        return $this->where('id',$uid)->setInc($filed,$value);
    }
    public function cartDec($uid,$field,$value=1){
        return $this->where('id',$uid)->setDec($field,$value);
    }

    public function updateCart($where,$value){
        return $this->where($where)->update($value);
    }
    public function deleteCart($where){
        return $this->where($where)->delete();
    }
}