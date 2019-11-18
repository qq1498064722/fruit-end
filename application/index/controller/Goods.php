<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->request->get();
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit = $data['limit'];
        }else{
            $limit = 2;
        };
        if(isset($data['page'])&&!empty($data['page'])){
            $page = $data['page'];
        }else{
            $page = 1;
        };
        $cid = $data['cid'];
        $goods = Db::table('goods')->field('id,gname,gthumb,nprice,oprice')
            ->order('id','asc')
            ->where('cid',$cid)->paginate($limit,false,[
                'page'=>$page,
            ]);
        $total = $goods->total();
        $good = $goods->items();
        if($total>0 && count($good)){
            return json([
                'code'=>config('code.success'),
                'msg'=>'商品获取成功',
                'data'=>$good,
                'total'=>$total,
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
        $goods = Db::table('goods')
            ->where('id',$id)->find();
        if($goods){
            return json([
                'code'=>config('code.success'),
                'msg'=>'分类获取成功',
                'data'=>$goods
            ]);
        }else{
            return json([
                'code'=>config('code.fail'),
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
