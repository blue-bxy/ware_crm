<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class OperateLog extends Controller
{
    //显示日志信息
    public function operate_log()
    {
        $key = input('key');//管理员id
        $start = input('start');//开始时间
        $end = input('end');//结束时间
        $arr=Db::table("sys_user")->column("id,name"); //获取用户列表
        if(request()->isAjax ()){
            $map = [];
            if($key&&$key!==""){
                $map['admin_id'] =  $key;
            }
            if($start&&$start!==""&&$end=="")
            {
                $map[] = ['add_time','>= time',$start];
            }
            if($end&&$end!==""&&$start=="")
            {
                $map[] = ['add_time','<= time',$end];
            }
            if($start&&$start!==""&&$end&&$end!=="")
            {
                $map[] = ['add_time','between time',[$start,$end]];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = Db::table('sys_loginfo')->where($map)->count();//计算总数量
            $lists = Db::table('sys_loginfo')->where($map)->page($Nowpage, $limits)->order('add_time' ,'desc')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('val', $key);
        $this->assign("search_user",$arr);
        return $this->fetch();
    }

    //批量删除日志
    public function batchDelLog(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('SysLoginfo')->batchDelLog($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除日志
    public function del_log()
    {
        $id = input('param.id');
        $flag = model('SysLoginfo')->delLog($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
}
