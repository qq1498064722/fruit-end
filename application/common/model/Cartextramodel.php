<?php
/**
 * Created by PhpStorm.
 * User: 11412
 * Date: 2019/11/11
 * Time: 17:08
 */

namespace app\common\model;


use think\Model;

class Cartextramodel extends Model
{
    protected $table = 'cart_extra';
    //查询某一件商品是否存在
    public function queryone($data){
        return $this->where($data)->find();
    }
    //追加一条商品
    public function insertGoods($data){
        return $this->allowField(true)->save($data);
    }
    //那个用户的购物车里面的那个商品加加
    public function goodsnumInc($where){
        return $this->where($where)->setInc('num');
    }
    //查询这个用户的所有商品
    public function querygoods($uid){
        return $this->field('gid,num,status')->where('uid',$uid)->select();
    }
    //商品减减
    public function goodsNumDec($where){
        return $this->where($where)->setDec('num');
    }
    public function deleteGoods($where){
        return $this->where($where)->delete();
    }
    public function updateGoods($where,$value){
        return $this->where($where)->update($value);
    }
    public function querySelectGoods($where){
        return $this->where($where)->select();
    }


}