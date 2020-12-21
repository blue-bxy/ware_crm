<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Menu extends Controller
{
    //菜单管理页面
    public function menu(){
        return view();
    }

    //菜单管理页面左边树区域
    public function menu_left(){
        return view();
    }

    //响应dtree树数据
    public function json(){
        $list["code"]=0;
        $list["msg"]='加载成功';
        $result=model('SysPermission')->field('id,title,pid as parentId,open as spread')->where('type','menu')->select()->toArray();
        /*foreach ($result as $value){
            $spread=$value['spread']==1?true:false;
            $list['data']['spread']=$spread;
        }*/
        $list['data']=$result;
        return json($list);
    }

    //菜单管理页面右边表格区域
    public function menu_right(){
        $title=input('title');//菜单名称
        $id=input('id');//菜单id(左边点击树时刷新右边的表格数据)
        if(request()->isAjax()){
            extract(input());
            $map = [];
            $map1=[];
            if($title&&$title!==""){
                $map[] = ['title','like',"%" . $title . "%"];
            }
            if($id&&$id!==""){
                $map[]=['pid','=',$id];
                $map1[]=['id','=',$id];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('SysPermission')->where('type','menu')->where($map)->whereOr($map1)->count();//计算总页面
            $lists = model('SysPermission')->where('type','menu')->where($map)->whereOr($map1)->page($Nowpage, $limits)->order('ordernum')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return view();
    }

    //批量删除菜单
    public function batchDelMenu(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysPermission')->batchDelMenu($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg'],'url'=>'admin/menu/menu']);
    }

    //删除菜单
    public function DeleteMenu(){
        $id = input('param.id');
        $flag = model('SysPermission')->delMenu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg'],'url'=>'admin/menu/menu']);
    }

    //添加菜单
    public function add_menu(){
        if($this->request->isAjax()){
            $data=[
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "icon"=>input('post.icon'),
                "href"=>input('post.href'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open'),
                "type"=>'menu'
            ];
            $result=$this->validate($data,[
                'title|菜单名称'=>'require|unique:SysPermission',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysPermission')->AddMenu($data);
            if($result==1){
                $this->success('菜单添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑菜单
    public function edit_menu(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "icon"=>input('post.icon'),
                "href"=>input('post.href'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open'),
                "type"=>'menu'
            ];
            $result=model('SysPermission')->UpdateMenu($data);
            if($result==1){
                $this->success('菜单更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询菜单信息
        $result=model('SysPermission')->find($id);
        $data['menu']=$result;
        $this->assign($data);
        return view();
    }
}
