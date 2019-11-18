<?php
/**
 * Created by PhpStorm.
 * User: 11412
 * Date: 2019/11/11
 * Time: 14:54
 */

namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Request;

class Cart extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();
        checkToken();
    }

    public function save()
    {
        $uid = $this->request->id;//token中拿到用户id
        $data = $this->request->post();
        $gid = $data['gid'];
        $nprice = $data['nprice'];
        $model = model('Cartmodel');
        $cart = $model->queryone($uid);//查是否存在购物车
        $cid = $cart['cid'];
        if ($cart) {
            //购物车存在
            $extramodel = model('Cartextramodel');
            //查询是否存在此商品
            $goodsInfo = $extramodel->queryone(['uid' => $uid, 'gid' => $gid]);
            $IncRes = '';
            $insertRes = '';
            if ($goodsInfo) {
                //如果存在商品，数量加一
                $IncRes = $extramodel->goodsnumInc(['uid' => $uid, 'gid' => $gid]);

            } else {
                //如果商品不存在，直接添加一条商品
                $insertRes = $extramodel->insertGoods(['cid' => $cid, 'gid' => $gid, 'num' => 1, 'status' => 1, 'uid' => $uid]);

            }
            //副表改变，修改主表的数量和总的价格
            $numberInc = $model->cartInc($uid, 'total');
            $priceInc = $model->cartInc($uid, 'price', $nprice);
            if (($IncRes && $numberInc && $priceInc) || ($insertRes && $numberInc && $priceInc)) {
                Db::commit();
                return json([
                    'code' => config('code.success'),
                    'msg' => '购物车添加成功',
                    'data'=>['cid'=>$cid,'uid'=>$uid]
                ]);
            } else {
                Db::rollback();
            }
        } else {
            //购物车不存在
            //手动事务
            Db::startTrans();
            $arr = ['id' => $uid, 'total' => 1, 'price' => $nprice];
            $row = $model->insertCart($arr);
            $cid = $model->getLastInsID();//拿到购物车的id
            $goods = ['cid' => $cid, 'gid' => $gid, 'num' => 1, 'status' => 1, 'uid' => $uid];
            $res = Db::table('cart_extra')->insert($goods);
            if ($row && $res) {
                Db::commit();
                return json([
                    'code' => config('code.success'),
                    'msg' => '购物车添加成功',
                    'data'=>['cid'=>$cid,'uid'=>$uid]
                ]);
            } else {
                Db::rollback();
            }
        }

    }

    public function read($id)
    {
        $uid = $this->request->id;
        $cartModel = model('Cartmodel');
        $cart = $cartModel->queryone($uid);
//        $cartExtraModel = model('Cartextramodel');
//        $goods = $cartExtraModel->querygoods($uid);
        $goods = Db::table('cart_extra')->alias('c')
            ->field('c.gid,c.num,c.status,goods.id,goods.gname,goods.gthumb,goods.nprice')
            ->join('goods', 'c.gid=goods.id')->select();
        if ($cart) {
            $cart['goods'] = $goods;
            return json([
                'code' => config('code.success'),
                'msg' => '购物车获取成功',
                'data' => $cart
            ]);
        } else {
            return json([
                'code' => config('code.success'),
                'msg' => '购物车空空如也',
            ]);
        }
    }

    public function update(Request $request,$id){
        $uid = $this->request->id;
        $data = $this->request->put();
        $gid = $data['gid'];
        $sale = $data['price'];
        $cartModel = model('Cartmodel');
        $cartExtraModel = model('Cartextramodel');
        $goods = $cartExtraModel->queryone(['uid' => $uid, 'gid' => $gid]);
        $status = $goods['status']? 0 : 1;
        $num = $goods['num'];
        Db::startTrans();
        $goodsRes = $cartExtraModel->updateGoods(['uid' => $uid,'gid' => $gid], ['status'=>$status]);
        $cart = $cartModel->queryone($uid);
        $total = $cart['total'];
        $price = $cart['price'];
        if($status){
            $total +=$num;
            $price += $num * $sale;
        }else{
            $total -=$num;
            $price -= $num * $sale;
        }
        $cartRes = $cartModel->updateCart(['id' => $uid],['total'=>$total,'price'=>$price]);
        if ($goodsRes && $cartRes)  {
            Db::commit();
            return json([
                'code' => config('code.success'),
                'msg' => '状态更新成功',
            ]);
        }else{
            Db::rollback();
            return json([
                'code' => config('code.fail'),
                'msg' => '状态更新失败',
            ]);
        }


    }
}