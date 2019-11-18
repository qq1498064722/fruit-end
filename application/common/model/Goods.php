<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/30
 * Time: 22:23
 */

namespace app\common\model;


use think\Model;

class Goods extends Model
{
    public function insert($data){
        $data['create_time'] = time();
        $data['update_time'] = time();
        return $this->allowField(true)->save($data);//allowField验证允许通过的字段
    }
    public function selects()
    {
        return $this->select();
    }
    public function del($id)
    {
        return $this->where('id',$id)->delete();
    }
    public function selectone($id)
    {
        return $this->field('cid,gname,nprice,oprice,gdetail,gthumb,gbanner,gstock,description,gbrand,gnorms')->where('id',$id)->find();
    }
    public function updates( $data,$id)
    {
        return $this->where('id',$id)->update($data);
    }

}