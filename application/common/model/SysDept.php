<?php

namespace app\common\model;

use think\Db;
use think\Model;

class SysDept extends Model
{
    //开启时间戳
    protected $autoWriteTimestamp = true;

    //删除部门
    public function delDept($dept_id){
        try{
            $this->where('id', $dept_id)->delete();
            writelog('部门【ID='.$dept_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除部门成功'];
        }catch( PDOException $e){
            writelog('部门【ID='.$dept_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除部门失败'];
        }
    }

    //批量删除部门
    public function batchDelDept($param){
        try{
            SysDept::destroy($param);
            writelog('部门批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('部门批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //添加部门
    public function AddDept($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加部门成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加部门失败',100);
            return '添加失败';
        }
    }

    //编辑部门
    public function UpdateDept($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('部门【'.$data['title'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('部门【'.$data['title'].'】更新失败',100);
            return '部门更新失败！';
        }
    }
}
