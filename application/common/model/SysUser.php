<?php

namespace app\common\model;

use think\Db;
use think\Model;
use app\common\model\SysRoleUser;

class SysUser extends Model
{
    //关联部门
    public function dept(){
        return $this->belongsTo('SysDept','deptid','id');
    }

    //检验登录
    public function login($data){
        $pwd=md5($data['pwd']);
        $data['pwd']=$pwd;
        unset($data['captcha']);
        $result=$this->where($data)->find();
        if(!$result){
            return '用户名或密码错误';
        }
        $adminSta = Db::name ('sys_user')->where ('id' , $result['id'])->field ('available,loginname')->find ();
        $roleid = Db::name ('sys_role_user')->where ('uid' , $result['id'])->field ('rid')->find ();
        $role=Db::name ('sys_role')->where ('id' , $roleid['rid'])->field ('name,available,rules')->find ();
        if ( $adminSta[ 'available' ] == 0 ) {
            writelog ($adminSta[ 'loginname' ] . '账号被禁用' , 200);
            return "该账号被禁用";
        }
        if ( is_null ($roleid[ 'rid' ]) ) {
            writelog ($adminSta[ 'loginname' ] . '账号未分配角色' , 200);
            return "抱歉，您无角色身份";
        }
        if ( $role[ 'available' ] == 0 ) {
            writelog ($role[ 'name' ] . '角色被禁用！' , 200);
            return "抱歉，该账号角色被禁用";
        }
        if($result){
            //存取用户的信息到session
            $sessionData=[
                'id'=>$result['id'],
                'type'=>$result['type'],
                'name'=>$result['name'],
                'loginname'=>$result['loginname'],
                'address'=>$result['address'],
                'sex'=>$result['sex']?'女':'男',
                'remark'=>$result['remark'],
                'hiredate'=>$result['hiredate'],
                'rule'=>$role['rules'],
                'imgpath'=>$result['imgpath']
            ];
            session('admin',$sessionData);
            return 1;//1表示用户名密码正确
        }else{
            return '用户名或密码错误';
        }
    }

    //验证原始密码
    public function CheckOldPwd($oldpassword,$id){
        $password =  $this->where("id",$id)->value("pwd");
        if($password === $oldpassword){
            return ['code' => 200, 'data' => '', 'msg' =>'true'];
        }else{
            return ['code' => 100, 'data' => '', 'msg' =>'false'];
        }
    }

    //修改密码
    public function editPassword($param){
        $name = $this->where('id',session('admin.id'))->value('name');
        Db::startTrans();// 启动事务
        try{
            $this->allowField (true)->save($param,['id'=>session('admin.id')]);
            Db::commit();// 提交事务
            writelog('管理员【'.$name.'】修改密码成功',200);
            return ['code'=>200,'msg'=>'密码修改成功，请重新登录！'];
        }catch( \Exception $e){
            Db::rollback ();//回滚事务
            writelog('管理员【'.$name.'】修改密码失败',100);
            return ['code'=>100,'msg'=>'密码修改失败'];
        }
    }
    //添加用户
    public function AddUser($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加'.$data['name'].'用户成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加用户失败',100);
            return '添加失败';
        }
    }

    //更新用户
    public function UpdateUser($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('用户【'.$data['name'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('用户【'.$data['name'].'】更新失败',100);
            return '用户更新失败！';
        }
    }

    //批量删除用户
    public function batchDelUser($param){
        try{
            SysUser::destroy($param);//删除用户表数据
            SysRoleUser::destroy($param);//删除用户与角色中间表中的数据
            writelog('用户批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('用户批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除用户
    public function delUser($user_id){
        try{
            $this->where('id', $user_id)->delete();
            SysRoleUser::destroy($user_id);//删除用户与角色中间表中的数据
            writelog('用户【ID='.$user_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除用户成功'];
        }catch( PDOException $e){
            writelog('用户【ID='.$user_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除用户失败'];
        }
    }
}
