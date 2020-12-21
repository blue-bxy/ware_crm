<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    //登录
    public function login(){
        if(request()->isAjax()){
            $data=[
                'loginname'=>input('post.loginname'),
                'pwd'=>input('post.password'),
                'captcha'=>input('post.code'),
            ];
            $result=$this->validate($data,[
                'captcha|验证码'=>'require|captcha'
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysUser')->login($data);
            if($result==1){
                writelog('管理员【'.session('admin.loginname').'】登录成功',200);
                $this->success('登录成功! 欢迎使用','admin/index/index');
            }else{
                $this->error($result);
            }
        }
        return $this->fetch('/login/login');
    }

    //退出登录
    public function loginOut()
    {
        session(null);
        $this->redirect(url('admin/login/login'));
    }
}
