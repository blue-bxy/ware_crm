<?php

namespace app\admin\controller;

use think\Controller;

class Permission extends Controller
{
    //权限管理页面
    public function permission(){
        return view();
    }

    //权限管理页面左边树区域
    public function permission_left(){
        return view();
    }

    //响应dtree树数据
    public function json(){
        $list["code"]=0;
        $list["msg"]='加载成功';
        $result=model('SysPermission')->field('id,title,pid as parentId,open as spread')->where('type','menu')->select()->toArray();
        $list['data']=$result;
        return json($list);
    }

    //权限管理页面右边表格区域
    public function permission_right(){
        $title=input('title');//权限名称
        $percode=input('$percode');//权限编码
        $id=input('id');//权限id(左边点击树时刷新右边的表格数据)
        if(request()->isAjax()){
            extract(input());
            $map = [];
            $map1=[];
            if($title&&$title!==""){
                $map[] = ['title','like',"%" . $title . "%"];
            }
            if($percode&&$percode!==""){
                $map[] = ['percode','like',"%" . $percode . "%"];
            }
            if($id&&$id!==""){
                $map[]=['pid','=',$id];
                $map1[]=['id','=',$id];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('SysPermission')->where('type','permission')->where($map)->whereOr($map1)->count();//计算总页面
            $lists = model('SysPermission')->where('type','permission')->where($map)->whereOr($map1)->page($Nowpage, $limits)->order('ordernum')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return view();
    }

    //批量删除权限
    public function batchDelPermission(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysPermission')->batchDelpermission($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg'],'url'=>'admin/permission/permission']);
    }

    //删除权限
    public function DeletePermission(){
        $id = input('param.id');
        $flag = model('SysPermission')->delPermission($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg'],'url'=>'admin/permission/permission']);
    }

    //添加权限
    public function add_permission(){
        if($this->request->isAjax()){
            $data=[
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "percode"=>input('post.percode'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open'),
                "type"=>'permission'
            ];
            $result=$this->validate($data,[
                'title|权限名称'=>'require|unique:SysPermission',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysPermission')->AddPermission($data);
            if($result==1){
                $this->success('权限添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑权限
    public function edit_permission(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "percode"=>input('post.percode'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open'),
                "type"=>'permission'
            ];
            $result=model('SysPermission')->UpdatePermission($data);
            if($result==1){
                $this->success('权限更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询权限信息
        $result=model('SysPermission')->find($id);
        $data['permission']=$result;
        $this->assign($data);
        return view();
    }
}
