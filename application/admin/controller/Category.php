<?php

namespace app\admin\controller;

use think\Controller;
use think\Exception;
use think\Request;

class Category extends Controller
{

    protected function _initialize()
    {
//        parent::_initialize(); // TODO: Change the autogenerated stub
        checkToken();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
//        $data = $this->request->get();
        $model = model('Category');
        $result = $model->select();
        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类查看成功',
                'data'=>$result
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类查看失败'
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

//        echo 'create';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //权限身份验证，请求方式验证
        //验证参数
        //cname  cthumb  csort
        $data = $this->request->post();
        $validate = validate('Category');
        if (!$validate->scene('insert')->check($data)) {
            return json([
                'code' => config('code.fail'),
                'msg' => $validate->getError()
            ]);
        }
        $model = model('Category');
        $result = $model->insert($data);
        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类添加成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类添加失败'
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
        try{
            $model = model('Category');
            $result = $model->selectupdates($id);
            if ($result) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '获取成功',
                    'data'=>$result
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '失败'
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code' => config('code.success'),
                'msg' => '服务器异常，请联系管理员'
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
        $data = $this->request->put();
        $model = model('Category');
        $result = $model->updates($data,$id);
//        var_dump($request);
        if ($result>0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类修改成功',
                'data'=>$result
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类修改失败'
            ]);
        }
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
        try{
//            $id = $this->request->delete();
//            var_dump($id);
//            $validate = validate('Category');
//            if (!$validate->scene('delete')->check($id)) {
//                return json([
//                    'code' => config('code.fail'),
//                    'msg' => $validate->getError()
//                ]);
//            }
            $model = model('Category');
            $result = $model->del($id);
            if ($result) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '分类删除成功'
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '分类删除失败'
                ]);
            }
        }catch (Exception $exception){
            return json([
                'code' => config('code.success'),
                'msg' => '服务器异常，请联系管理员'
            ]);
        }

    }
}
