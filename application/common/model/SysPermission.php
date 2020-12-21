<?php

namespace app\common\model;

use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class SysPermission extends Model
{
    //开启时间戳
    protected $autoWriteTimestamp = true;

    //软删除
    use SoftDelete;

    //查询菜单
    public function SelectMenu($nodeStr=""){
        //超级管理员没有节点数组
        if($nodeStr == "SUPERAUTH"){
            $result=$this->where('available','1')->order('ordernum')->select()->toArray();
        }elseif(empty($nodeStr)){
            $result = array();
        }else{
            $where = 'available = 1 and id in('.$nodeStr.')';
            $result = $this->where($where)->order('ordernum')->select()->toArray();
        }
        $menu = prepareMenu($result);
        return $menu;
    }

    //批量删除菜单
    public function batchDelMenu($param){
        try{
           SysPermission::destroy($param);
            writelog('菜单批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('菜单批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除菜单
    public function delMenu($menu_id){
        try{
            SysPermission::destroy($menu_id);
            writelog('菜单【ID='.$menu_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除菜单成功'];
        }catch( PDOException $e){
            writelog('菜单【ID='.$menu_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除菜单失败'];
        }
    }

    //添加菜单
    public function AddMenu($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加菜单成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加菜单失败',100);
            return '添加失败';
        }
    }

    //编辑菜单
    public function UpdateMenu($data){
        Db::startTrans();// 启动事务
        try{
            $menu=$this->find($data['id']);
            $menu->pid=$data['pid'];
            $menu->title=$data['title'];
            $menu->icon=$data['icon'];
            $menu->href=$data['href'];
            $menu->available=$data['available'];
            $menu->ordernum=$data['ordernum'];
            $menu->open=$data['open'];
            $menu->save();
            Db::commit();// 提交事务
            writelog('菜单【'.$data['title'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('菜单【'.$data['title'].'】更新失败',100);
            return '菜单更新失败！';
        }
    }

    //批量删除权限
    public function batchDelPermission($param){
        try{
            SysPermission::destroy($param);
            writelog('权限批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('权限批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除权限
    public function delPermission($permission_id){
        try{
            SysPermission::destroy($permission_id);
            writelog('权限【ID='.$permission_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除权限成功'];
        }catch( PDOException $e){
            writelog('权限【ID='.$permission_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除权限失败'];
        }
    }

    //添加权限
    public function AddPermission($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加权限成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加权限失败',100);
            return '添加失败';
        }
    }

    //编辑权限
    public function UpdatePermission($data){
        Db::startTrans();// 启动事务
        try{
            $permission=$this->find($data['id']);
            $permission->pid=$data['pid'];
            $permission->title=$data['title'];
            $permission->percode=$data['percode'];
            $permission->available=$data['available'];
            $permission->ordernum=$data['ordernum'];
            $permission->open=$data['open'];
            $permission->save();
            Db::commit();// 提交事务
            writelog('权限【'.$data['title'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('权限【'.$data['title'].'】更新失败',100);
            return '权限更新失败！';
        }
    }
}
