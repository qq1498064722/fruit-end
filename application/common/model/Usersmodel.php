<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/11/7
 * Time: 14:28
 */

namespace app\common\model;


use think\Model;

class Usersmodel extends Model
{
    protected $table="users";
    protected $autoWriteTimestamp=true;

    public function insert($data){
        return $this->allowField(true)->save($data);
    }

    //查用户
    public function queryusers($where){
        return $this->where($where)->select();
    }

    public function queryone($uid){
        return $this->find($uid);
    }

}