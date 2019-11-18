<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Lists extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        try{
            $data = $this->request->get();
            if(isset($data['page'])&&!empty($data['page'])){
                $page=$data['page'];
            }else{
                $page=1;
            }
            if(isset($data['limit'])&&!empty($data['limit'])){
                $limit=$data['limit'];
            }else{
                $limit=1;
            }
            if(isset($data['cid'])&&!empty($data['cid'])){
                $cid=$data['cid'];
            }
            $res=Db::table('goods')->where('cid',$cid)->paginate($limit,false,[
                'page'=>$page
            ]);
            $total=$res->total();
            $goods=$res->items();
            if ($total > 0 && count($goods)){
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'查询成功',
                    'data'=>$goods,
                    'total'=>$total,
                ]);
            }else{
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'暂无数据'
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code'=>config('code.fail'),
                'msg'=>'服务器错误'
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
        $data=$this->request->get();
        $id=$data['id'];
        $result=Db::table('goods')->field('gbanner,gname,nprice,oprice,norms,brand')->where('id',$id)->find();
        if($result){
            return json([
                'code' => 200,
                'msg' => '商品获取成功',
                'data' => $result
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '商品获取失败',
            ]);
        };
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
