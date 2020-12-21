<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class User extends Controller
{
    //显示用户信息
    public function user()
    {
        $name=input('name');//真实姓名/登录名
        $remark=input('remark');//备注
        $address=input('address');//地址
        $start = input('start');//入职开始时间
        $end = input('end');//入职结束时间
        $dept=input('deptid');//所属部门
        if(request()->isAjax ()){
            $map = [];
            if($name&&$name!==""){
                $map[] = ['name|loginname','like',"%" . $name . "%"];
            }
            if($remark&&$remark!==""){
                $map[] =  ['remark','like',"%" . $remark . "%"];
            }
            if($address&&$address!==""){
                $map['address'] =  $address;
            }
            if($dept&&$dept!==""){
                $map['deptid'] =  $dept;
            }
            if($start&&$start!==""&&$end=="")
            {
                $map[] = ['hiredate','>= time',$start];
            }
            if($end&&$end!==""&&$start=="")
            {
                $map[] = ['hiredate','<= time',$end];
            }
            if($start&&$start!==""&&$end&&$end!=="")
            {
                $map[] = ['hiredate','between time',[$start,$end]];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('SysUser')->where($map)->count();//计算总页面
            $lists = model('SysUser')->where($map)->page($Nowpage, $limits)->with('dept')->order('hiredate' ,'desc')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return $this->fetch();
    }

    //添加用户
    public function add_user(){
        if($this->request->isAjax()){
            $data=[
                "deptid"=>input('post.deptid'),//父级部门id
                "ordernum"=>input('post.ordernum'),//排序码
                "pid"=>input('post.pid'),//领导id
                "name"=>input('post.name'),//真实姓名
                "loginname"=>input('post.loginname'),//登录名
                "pwd"=>md5(input('post.pwd')),//登录密码
                "address"=>input('post.address'),//用户地址
                "hiredate"=>input('post.hiredate'),//入职时间
                "sex"=>input('post.sex'),//性别
                "available"=>input('post.available'),//是否可用
                "remark"=>input('post.remark'),//用户备注
            ];
            $result=$this->validate($data,[
                'loginname|登录名'=>'require|unique:SysUser',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysUser')->AddUser($data);
            if($result==1){
                $this->success('用户添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //根据部门ID查询当前部门下面的领导列表
    public function loadUsersByDeptId(){
        $deptid=input('deptid');
        $result=model('SysUser')->where('deptid',$deptid)->select();
        return json(['code'=>200,'msg'=>'','data'=>$result]);
    }

    //更新用户
    public function edit_user(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),//用户id
                "deptid"=>input('post.deptid'),//父级部门id
                "ordernum"=>input('post.ordernum'),//排序码
                "pid"=>input('post.pid'),//领导id
                "name"=>input('post.name'),//真实姓名
                "loginname"=>input('post.loginname'),//登录名
                "pwd"=>md5(input('post.pwd')),//登录密码
                "address"=>input('post.address'),//用户地址
                "hiredate"=>input('post.hiredate'),//入职时间
                "sex"=>input('post.sex'),//性别
                "available"=>input('post.available'),//是否可用
                "remark"=>input('post.remark'),//用户备注
            ];
            $result=model('SysUser')->UpdateUser($data);
            if($result==1){
                $this->success('用户更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询用户信息
        $result=model('SysUser')->find($id);
        //根据用户的pid查询用户的领导的部门id
        $deptid=model('SysUser')->where('id',$result['pid'])->find();
        $data['user']=$result;
        if(!empty($deptid)&& $deptid!=null){
            $data['deptid']=$deptid['deptid'];
        }else{
            $data['deptid']=0;
        }
        $this->assign($data);
        return view();
    }

    //批量删除用户
    public function batchDelUser(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        if(in_array('1',$ids)){
            $key = array_search ('1',$ids);
            unset($ids[$key]);
            if(empty($ids)){
                return json(['code'=>100,'msg'=>'不可删除超级管理员']);
                die;
            }
        }
        if(in_array(session('admin.id'),$ids)){
            $key = array_search (session('admin.id'),$ids);
            unset($ids[$key]);
            if(empty($ids)){
                return json(['code'=>100,'msg'=>'不可删除自己']);
                die;
            }
        }
        $flag = model('SysUser')->batchDelUser($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除用户
    public function del_user(){
        $id = input('param.id');
        if($id=='1'){
            return json(['code'=>100,'msg'=>'不可删除超级管理员']);
            die;
        }
        if(session('admin.id')==$id){
            return json(['code'=>100,'msg'=>'不能删除自己']);
            die;
        }
        $flag = model('SysUser')->delUser($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //响应dtree树数据
    public function json(){
        $userId=input('userId');
        $list["code"]=0;
        $list["msg"]='加载成功';
        //查询所有菜单和权限
        $result=model('SysPermission')->field('id,title,pid,open')->select()->toArray();
        //查询用户表中用户的权限id
        $ruleId=model('Sysuser')->field('rules')->where('id',$userId)->find();
        //将ruleId转换为数组，得到该用户所拥有的权限
        $rule=explode(',',$ruleId['rules']);
        //判断菜单权限id是否在rule中，存在则选中复选框
        $str = "";
        foreach($result as $key=>$vo){
            $str .= '{"id":"'. $vo['id'].'","parentId":"'.$vo['pid'].'","title":"'.$vo['title'].'","spread":"true"';
            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checkArr":"1"';
            }else if(in_array("SUPERAUTH", $rule)){//是超级管理员时
                $str .= ' ,"checkArr":"1"';
            }else{
                $str .= ' ,"checkArr":"0"';
            }

            $str .= '},';
        }
        $resultQx="[" . substr($str, 0, -1) . "]";
        $list['data']=$resultQx;
        return json(['code' => 200, 'data' => $list['data'], 'msg' => 'success']);
    }

    //加载角色列表(分配角色)
    public function initRoleByUserId(){
        $userid = input('id');
        //查询所有可用的角色
        $lists=model('SysRole')->where('available','1')->select()->toArray();
        //根据$userid查询sys_role_user表中是否有对应rid，有则使页面数据表格单选框选中
        $roleid=Db::table('sys_role_user')->where('uid',$userid)->field('rid')->find();
        $str = "";
        foreach ($lists as $key=>$vo){
            $str .= '{"id":"'. $vo['id'].'","name":"'.$vo['name'].'","remark":"'.$vo['remark'].'"';
            if(empty($roleid) && $roleid['rid']!==$vo['id']){
                $str .= ',"LAY_CHECKED":"false"';
            }else{
                $str .= ',"LAY_CHECKED":"true"';
            }
            $str .= '},';
        }
        $resultRole="[" . substr($str, 0, -1) . "]";
        $list['data']=$resultRole;
        return json(['code'=>0,'msg'=>'','count'=>'','data'=>json_decode($list['data'])]);
    }

    //分配角色
    public function saveUserRole(){
        $params=input('param.');
        $role=model('SysRoleUser')->where('uid',$params['uid'])->find();
        if(empty($role)){
            $result=model('SysRoleUser')->save(['uid'=>$params['uid'],'rid'=>$params['rid']]);
        }else{
            $result=model('SysRoleUser')->save(['rid'=>$params['rid']],['uid'=>$params['uid']]);
        }
        if($result){
            return json(['code'=>200,'msg'=>'角色分配成功']);
        }
    }
}
