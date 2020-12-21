<?php

namespace app\common\model;

use think\Db;
use think\Model;

class SysRole extends Model
{
    //开启时间戳
    protected $autoWriteTimestamp = true;

    //添加角色
    public function AddRole($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加角色成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加角色失败',100);
            return '添加失败';
        }
    }

    //更新角色
    public function UpdateRole($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('角色【'.$data['name'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('角色【'.$data['name'].'】更新失败',100);
            return '角色更新失败！';
        }
    }

    //批量删除角色
    public function batchDelRole($param){
        try{
            SysRole::destroy($param);
            writelog('角色批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('角色批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除角色
    public function delRole($role_id){
        try{
            $this->where('id', $role_id)->delete();
            writelog('角色【ID='.$role_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除角色成功'];
        }catch( PDOException $e){
            writelog('角色【ID='.$role_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除角色失败'];
        }
    }

    //分配权限
    public function giveQx($param){
        $name = $this->where('id',$param['id'])->value('name');
        Db::startTrans();// 启动事务
        try{
            $this->save($param, ['id' => $param['id']]);
            Db::commit();// 提交事务
            writelog('角色【'.$name.'】分配权限成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('角色【'.$name.'】分配权限失败',100);
            return '权限分配失败';
        }
    }
}
