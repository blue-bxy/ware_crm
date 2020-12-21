<?php

namespace app\admin\controller;

use app\common\model\SysDept;
use think\Controller;
use think\Db;

class Dept extends Controller
{
    //部门管理页面
    public function dept(){
        return view();
    }

    //部门管理页面左边树区域
    public function dept_left(){
        return view();
    }

    //响应dtree树数据
    public function json(){
        $list["code"]=0;
        $list["msg"]='加载成功';
        $result=model('SysDept')->field('id,title,pid as parentId,open as spread')->select()->toArray();
        /*foreach ($result as $value){
            $spread=$value['spread']==1?true:false;
            $list['data']['spread']=$spread;
        }*/
        $list['data']=$result;
        return json($list);
    }

    //部门管理页面右边表格区域
    public function dept_right(){
        $key=input('key');//部门名称
        $address=input('address');//部门地址
        $remark=input('remark');//部门备注*/
        $id=input('id');//部门id(左边点击树时刷新右边的表格数据)
        if(request()->isAjax()){
            extract(input());
            $map = [];
            $map1=[];
            if($key&&$key!==""){
                $map[] = ['title','like',"%" . $key . "%"];
            }
            if($address&&$address!==""){
                $map['address'] =  $address ;
            }
            if($remark&&$remark!==""){
                $map[] =['remark','like',"%" . $remark . "%"] ;
            }
            if($id&&$id!==""){
                $map[]=['pid','=',$id];
                $map1[]=['id','=',$id];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = Db::table('sys_dept')->where($map)->whereOr($map1)->count();//计算总页面
            $lists = Db::table('sys_dept')->where($map)->whereOr($map1)->page($Nowpage, $limits)->order('ordernum')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return view();
    }

    //删除部门
    public function del_dept(){
        $id = input('param.id');
        $flag = model('SysDept')->delDept($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg'],'url'=>'admin/dept/dept']);
    }

    //批量删除部门
    public function batchDelDept(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysDept')->batchDelDept($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg'],'url'=>'admin/dept/dept']);
    }

    //添加部门
    public function add_dept(){
        if($this->request->isAjax()){
            $data=[
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "address"=>input('post.address'),
                "remark"=>input('post.remark'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open')
            ];
            $result=$this->validate($data,[
                'title|部门名称'=>'require|unique:SysDept',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysDept')->AddDept($data);
            if($result==1){
                $this->success('部门添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑部门
    public function edit_dept(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "pid"=>input('post.pid'),
                "title"=>input('post.title'),
                "address"=>input('post.address'),
                "remark"=>input('post.remark'),
                "available"=>input('post.available'),
                "ordernum"=>input('post.ordernum'),
                "open"=>input('post.open')
            ];
            $result=model('SysDept')->UpdateDept($data);
            if($result==1){
                $this->success('部门更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询部门信息
        $result=model('SysDept')->find($id);
        $data['dept']=$result;
        $this->assign($data);
        return view();
    }
}
