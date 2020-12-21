<?php

namespace app\admin\controller;

use think\Controller;
use org\Verify;
use think\Db;

class Index extends Base
{

    //主页面
    public function index(){
        //查询菜单
        $menu=model('SysPermission')->SelectMenu(session('admin.rule'));
        //查询用户头像
        $portrait=model('SysUser')->field('imgpath')->where('id',session('admin.id'))->find();
        $this->assign([
            'menu'=>$menu,
            'portrait'=>$portrait['imgpath'],
        ]);
        return $this->fetch('/index/index');
    }

    //首页
    public function main(){
        return view();
    }


    //后台用户修改头像上传
    public function updateFace(){
        $base64url = input('base64url');
        $arr = base64_img($base64url,false);
        if($arr['code'] == 200){
            $res = Db::table('sys_user')->where('id',input('id'))->update(["imgpath"=>$arr['msg']]);
            if($res){
                session('portrait', $arr['msg']); //用户头像
                return json(['code'=>200,'msg'=>"上传成功"]);
            }else{
                return json(['code'=>100,'msg'=>"上传失败"]);
            }
        }elseif($arr['code'] == 100){
            writelog('管理员上传头像失败',100);
            return json($arr);
        }
    }

    //验证原始密码
    public function editPwd(){
        extract(input());
        if(isset($type) && $type=='checkPassword') {
            $old_pwd = md5($old_pwd);
            $flag = model('SysUser')->CheckOldPwd($old_pwd, session('admin.id'));
            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        }else{
            $param['pwd'] = md5($new_pwd);
            $flag = model('SysUser')->editPassword($param);
            return json(['code'=>$flag['code'],'msg'=>$flag['msg']]);
        }
    }
}
