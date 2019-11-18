<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        try {
            $data = $this->request->post();
            $model = model('Usermodel');
            //验证手机号是否被注册过
            $result = $model->queryusers(['tel' => $data['tel']]);
            if (count($result) > 0) {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '该手机号已注册',
                ]);
            }
            $result = $model->queryusers(['nickname' => $data['nickname']]);
            if (count($result) > 0) {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '该用户名已被占用',
                ]);
            }
            $salt = config('salt');
            $data['password'] = crypt($data['password'], md5($salt));

            $result = $model->insert($data);
            if ($result) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '恭喜您！注册成功',
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '注册失败',
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '服务器错误,请联系管理员',
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        checkToken();
        $uid = $this->request->id;
        $nickname = $this->request->nickname;
//        $user =  Db::table('users')->where('nickname',$id)->find();
        $model = model('Usermodel');
        $user = $model ->queryone($uid);
        $user['sex'] = SexCodeToText($user['sex']);
        if($user){
            return json([
                'code'=>config('code.success'),
                'msg'=>'用户获取成功',
                'data'=>$user
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
