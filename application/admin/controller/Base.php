<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Base extends Controller
{
    public function initialize(){
        if(!session('admin.id')||!session('admin.name')){
            $this->redirect(url('admin/login/login'));
        }
        $adminSta = Db::name ('sys_user')->where ('id' , session ('admin.id'))->field ('available,loginname')->find ();
        $roleid = Db::name ('sys_role_user')->where ('uid' , session ('admin.id'))->field ('rid')->find ();
        $role=Db::name ('sys_role')->where ('id' , $roleid['rid'])->field ('name,available')->find ();
        if ( is_null ($adminSta[ 'loginname' ]) ) {
            writelog (session ('loginname') . '账号不存在,强制下线！' , 200);
            $this->error ('抱歉，账号不存在,强制下线' , 'admin/login/loginOut');
        }
        if ( $adminSta[ 'available' ] == 0 ) {
            writelog ($adminSta[ 'loginname' ] . '账号被禁用,强制下线！' , 200);
            $this->error ('抱歉，该账号被禁用，强制下线' , 'admin/login/loginOut');
        }
        if ( is_null ($roleid[ 'rid' ]) ) {
            writelog (session ('loginname') . '未分配角色,强制下线！' , 200);
            $this->error ('抱歉，您无角色身份,强制下线' , 'admin/login/loginOut');
        }
        if ( $role[ 'available' ] == 0 ) {
            writelog ($role[ 'name' ] . '角色被禁用,强制下线！' , 200);
            $this->error ('抱歉，该账号角色被禁用，强制下线' , 'admin/login/loginOut');
        }
    }
}
