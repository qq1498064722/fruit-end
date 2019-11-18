<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Category extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $cate =  Db::table('category')->select();
        if($cate){
            return json([
                'code'=>config('code.success'),
                'msg'=>'分类获取成功',
                'data'=>$cate
            ]);
        }else{
            return json([
                'code'=>config('code.success'),
                'msg'=>'无数据',
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
        $cate =  Db::table('category')->where('id',$id)->find();
        if($cate){
            return json([
                'code'=>config('code.success'),
                'msg'=>'分类获取成功',
                'data'=>$cate
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
