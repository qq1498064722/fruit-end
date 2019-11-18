<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/29
 * Time: 17:15
 */

namespace app\common\model;
use think\Model;

class Category extends Model
{
    //在database.php中auto_timestamp为true则针对所有表都会自动加入创建时间和更新时间
//（所以数据表中必须有create_time和update_time两个字段且数据类型为10位的int）
//    protected $autoWriteTimestamp=true;//只针对这个模型加入时间戳（创建时间和更新时间）
//    protected $table='表名';
    public function insert($data){
        $data['create_time'] = time();
        $data['update_time'] = time();
       return $this->allowField(true)->save($data);//allowField验证允许通过的字段
    }
    public function select()
    {
        return parent::select();
    }
    public function del($id)
    {
        return $this->where('id',$id)->delete();
    }
    public function selectupdates($id)
    {
        return $this->field('cname,cthumb,csort')->where('id',$id)->find();
    }
    public function updates($data,$id)
    {
        return $this->where('id',$id)->update($data);
    }

}