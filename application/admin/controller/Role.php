<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Role extends Controller
{
    //显示角色信息
    public function role()
    {
        $name=input('name');//角色名称
        $remark=input('remark');//备注
        $available=input('available');//是否可用
        $start = input('start');//开始时间
        $end = input('end');//结束时间
        if(request()->isAjax ()){
            $map = [];
            if($name&&$name!==""){
                $map[] = ['name','like',"%" . $name . "%"];
            }
            if($remark&&$remark!==""){
                $map['remark'] =  $remark;
            }
            if(isset($available)){
                $map['available'] =  $available;
            }
            if($start&&$start!==""&&$end=="")
            {
                $map[] = ['create_time','>= time',$start];
            }
            if($end&&$end!==""&&$start=="")
            {
                $map[] = ['create_time','<= time',$end];
            }
            if($start&&$start!==""&&$end&&$end!=="")
            {
                $map[] = ['create_time','between time',[$start,$end]];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = Db::table('sys_role')->where($map)->count();//计算总页面
            $lists = Db::table('sys_role')->where($map)->page($Nowpage, $limits)->order('create_time' ,'desc')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return $this->fetch();
    }

    //添加角色
    public function add_role(){
        if($this->request->isAjax()){
            $data=[
                "name"=>input('post.name'),
                "remark"=>input('post.remark'),
                "available"=>input('post.available')
            ];
            $result=model('SysRole')->AddRole($data);
            if($result==1){
                $this->success('角色添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //批量删除角色
    public function batchDelRole(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysRole')->batchDelRole($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除角色
    public function del_role(){
        $id = input('param.id');
        $flag = model('SysRole')->delRole($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //更新角色
    public function edit_role(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "name"=>input('post.name'),
                "remark"=>input('post.remark'),
                "available"=>input('post.available')
            ];
            $result=model('SysRole')->UpdateRole($data);
            if($result==1){
                $this->success('角色更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询角色信息
        $result=model('SysRole')->find($id);
        $data['role']=$result;
        $this->assign($data);
        return view();
    }


    //响应dtree树数据
    public function json(){
        $roleId=input('roleId');
        $list["code"]=0;
        $list["msg"]='加载成功';
        //查询所有菜单和权限
        $result=model('SysPermission')->field('id,title,pid,open')->select()->toArray();
        //查询角色表中角色的权限id
        $ruleId=model('SysRole')->field('rules')->where('id',$roleId)->find();
        //将ruleId转换为数组，得到该角色所拥有的权限
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

    //分配权限
    public function giveQx(){
        $param = input('param.');
        $doparam = [
            'id' => $param['id'],
            'rules' => $param['rule']
        ];
        $result=model('SysRole')->giveQx($doparam);
        if($result==1){
            $this->success('权限分配成功');
        }else{
            $this->error($result);
        }
    }
}
