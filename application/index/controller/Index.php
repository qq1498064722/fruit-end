<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //分类 商品
       $cate = Db::table('category')->field('id,cname,cthumb')
           ->order('id','asc')->limit(0,4)->select();
       $len = count($cate);
       if($len){
           for ($i = 0;$i<$len;$i++){
               $cid = $cate[$i]['id'];
               $goods = Db::table('goods')->field('id,gname,gthumb,nprice,oprice')
                   ->where('cid',$cid)->limit(0,3)->select();
               $cate[$i]['goods']=$goods;
           }
           if($cate){
               return json([
                   'code'=>config('code.success'),
                   'msg'=>'数据查询成功',
                   'data'=>$cate
               ]);
           }else{
               return json([
                   'code'=>config('code.fail'),
                   'msg'=>'数据查询失败'
               ]);
           }

       }else{
           return json([
               'code'=>config('code.success'),
               'msg'=>'暂无数据'
           ]);
       }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

//       $cate =  Db::table('category')->where('id',$id)->find();
        $goods = Db::table('goods')->field('id,gname,gthumb,nprice,oprice')
            ->order('id','asc')
            ->where('cid',$id)->select();
        if($goods){
            return json([
                'code'=>config('code.success'),
                'msg'=>'商品获取成功',
                'data'=>$goods,
            ]);
        }else{
            return json([
                'code'=>config('code.success'),
                'msg'=>'无数据',
            ]);
        }

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
