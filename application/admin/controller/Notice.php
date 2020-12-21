<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Notice extends Controller
{
    //显示公告信息
    public function show_notice()
    {
        $title=input('title');//标题
        $opername=input('opername');//发布人
        $start = input('start');//开始时间
        $end = input('end');//结束时间
        if(request()->isAjax ()){
            $map = [];
            if($title&&$title!==""){
                $map[] = ['title','like',"%" . $title . "%"];
            }
            if($opername&&$opername!==""){
                $map['opername'] =  $opername;
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
            $count = Db::table('sys_notice')->where($map)->count();//计算总页面
            $lists = Db::table('sys_notice')->where($map)->page($Nowpage, $limits)->order('create_time' ,'desc')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return $this->fetch();
    }

    //添加公告
    public function add_notice(){
        if($this->request->isAjax()){
            $data=[
                "title"=>input('post.title'),
                "content"=>input('post.content'),
                "opername"=>session('admin.loginname')
            ];
            $result=$this->validate($data,[
                'title|标题'=>'require|unique:SysNotice',
                'content|内容'=>'require'
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysNotice')->AddNotice($data);
            if($result==1){
                $this->success('公告添加成功','admin/Notice/show_notice');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //批量删除公告
    public function batchDelNotice(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysNotice')->batchDelNotice($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除公告
    public function del_notice(){
        $id = input('param.id');
        $flag = model('SysNotice')->delNotice($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //更新公告
    public function edit_notice(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "title"=>input('post.title'),
                "content"=>input('post.content'),
            ];
            $result=$this->validate($data,[
                'title|标题'=>'require',
                'content|内容'=>'require'
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('SysNotice')->UpdateNotice($data);
            if($result==1){
                $this->success('公告更新成功','admin/Notice/show_notice');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询公告信息
        $result=model('SysNotice')->find($id);
        $data['notice']=$result;
        $this->assign($data);
        return view();
    }

    //查看公告
    public function see_notice(){
        $id=input('id');
        $notice=model('SysNotice')->find($id);
        $data['notice']=$notice;
        $this->assign($data);
        return view();
    }
}
