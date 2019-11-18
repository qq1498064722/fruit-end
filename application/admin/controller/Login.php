<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/29
 * Time: 10:24
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Exception;
use think\JWT;

class Login extends Controller
{
    public function index(){
        try{
            $data = $this->request->post();
            $password = $data['password'];
            $names = $data['names'];
            $salt = config('salt');
            $password= crypt($password,md5($salt));
            $res = Db::table('manager')->where(['names'=>$names,'password'=>$password])->find();
            if($res){
                $payload = ['id'=>$res['id'],'names'=>$res['names']];
                $token = JWT::getToken($payload,config('jwtkey'));
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'登录成功',
                    'data'=>[
                        'token'=>$token,
                        'names'=>$names,
                    ]
                ]);
            }else{
                return json([
                    'code'=>config('code.fail'),
                    'msg'=>'登录失败'
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code'=>config('code.fail'),
                'msg'=>'失败'
            ]);
        }

    }
}