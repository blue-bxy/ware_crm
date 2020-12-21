<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusProvider extends Model
{
    /**
     * @param $id
     * @param $num
     * @return array
     * 更改供应商状态
     */
    public function provider_state($id,$num){
        $providername = $this->where('id',$id)->value('providername');
        if($num == 0){
            $msg = '禁用';
        }else{
            $msg = '启用';
        }
        Db::startTrans();// 启动事务
        try{
            $this->where ('id' , $id)->setField (['available' => $num]);
            Db::commit();// 提交事务
            writelog('供应商【'.$providername.'】'.$msg.'成功',200);
            return ['code' => 200, 'data' => '', 'msg' => '已'.$msg];
        }catch( \Exception $e){
            Db::rollback ();//回滚事务
            writelog('供应商【'.$providername.'】'.$msg.'失败',100);
            return ['code' => 100, 'data' => '', 'msg' => $msg.'失败'];
        }
    }

    //添加供应商
    public function AddProvider($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加供应商成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加供应商失败',100);
            return '添加失败';
        }
    }

    //编辑供应商
    public function UpdateProvider($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('供应商【'.$data['providername'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('供应商【'.$data['providername'].'】更新失败',100);
            return '供应商更新失败！';
        }
    }

    //批量删除供应商
    public function batchDelProvider($param){
        try{
            Busprovider::destroy($param);
            writelog('供应商批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('供应商批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除供应商
    public function delProvider($provider_id){
        try{
            $this->where('id', $provider_id)->delete();
            writelog('供应商【ID='.$provider_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除供应商成功'];
        }catch( PDOException $e){
            writelog('供应商【ID='.$provider_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除供应商失败'];
        }
    }
}
