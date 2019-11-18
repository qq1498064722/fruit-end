<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Reserve extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->request->get();
        if(isset($data['page'])&&!empty($data['page'])){
            $page = $data['page'];
        }else{
            $page = 1;
        };
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit = $data['limit'];
        }else{
            $limit = 3;
        }
//        $sarr = [];
//        if(isset($data['gname'])&&!empty($data['gname'])){
//            $sarr['gname'] = ['like','%'.$data['gname'].'%'];
//        };
//        if(isset($data['min_price'])&&!empty($data['min_price'])&&isset($data['max_price'])&&!empty($data['max_price'])){
//            $sarr['nprice'] = [
//                'between',[$data['min_price'],$data['max_price']]
//            ];
//        };
        $reserves = Db::table('reserve')
            ->paginate($limit,false,[
                'page'=>$page,
            ]);
//        goods.id,goods.gname,goods.nprice,goods.oprice,goods.gdetail,goods.gthumb,goods.gbanner,goods.create_time,goods.update_time,goods.gstock,goods.description,goods.gbrand,goods.gnorms'
//        $model = model('Goods');
//        $goods = $model->selects();
        $count = $reserves->total();
        $reserve = $reserves->items();
        if ($count>0 && count($reserve)) {
            return json([
                'code' => config('code.success'),
                'msg' => '预订查询成功',
                'data' => $reserve,
                'count'=>$count,
            ]);
        } else {
            return json([
                'code' => config('code.success'),
                'msg' => '暂无数据'
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
        $result = Db::table('reserve')->where('id',$id)->delete();
//        $model = model('Goods');
//        $result = $model->del($id);
        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '预约删除成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '预约删除失败'
            ]);
        }
    }
}
