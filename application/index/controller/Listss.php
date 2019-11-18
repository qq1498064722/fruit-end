<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
class Listss extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=1;
        }
        if(isset($data['cid'])&&!empty($data['cid'])){
            $cid=$data['cid'];
        }
        $result=Db::table('goods')->where('cid',$cid)->limit(0,$limit)->select();
        $count=Db::table('goods')->where('cid',$cid)->count();
        if($result){
            return json([
                'code' => 200,
                'msg' => '商品获取成功',
                'data' => $result,
                'count'=>$count
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '商品获取失败',
            ]);
        };

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data=$this->request->get();
        if(isset($data['cid'])&&!empty($data['cid'])){
            $cid=$data['cid'];
        }
        $cate=Db::table('category')->where('id',$cid)->select();
        if($cate){
            return json([
                'code'=>200,
                'msg'=>'分类获取成功',
                'data'=>$cate
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>'分类获取失败',
            ]);
        }
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
        //
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
