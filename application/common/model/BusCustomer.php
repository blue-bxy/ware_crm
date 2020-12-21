<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusCustomer extends Model
{
    /**
     * @param $id
     * @param $num
     * @return array
     * 更改客户状态
     */
    public function customer_state($id,$num){
        $customername = $this->where('id',$id)->value('customername');
        if($num == 0){
            $msg = '禁用';
        }else{
            $msg = '启用';
        }
        Db::startTrans();// 启动事务
        try{
            $this->where ('id' , $id)->setField (['available' => $num]);
            Db::commit();// 提交事务
            writelog('客户【'.$customername.'】'.$msg.'成功',200);
          return ['code' => 200, 'data' => '', 'msg' => '已'.$msg];
        }catch( \Exception $e){
            Db::rollback ();//回滚事务
            writelog('客户【'.$customername.'】'.$msg.'失败',100);
            return ['code' => 100, 'data' => '', 'msg' => $msg.'失败'];
        }
    }

    //添加客户
    public function AddCustomer($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加客户成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加客户失败',100);
            return '添加失败';
        }
    }

    //编辑客户
    public function UpdateCustomer($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('客户【'.$data['customername'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('客户【'.$data['customername'].'】更新失败',100);
            return '客户更新失败！';
        }
    }

    //批量删除客户
    public function batchDelCustomer($param){
        try{
            BusCustomer::destroy($param);
            writelog('客户批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('客户批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除客户
    public function delCustomer($customer_id){
        try{
            $this->where('id', $customer_id)->delete();
            writelog('客户【ID='.$customer_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除客户成功'];
        }catch( PDOException $e){
            writelog('客户【ID='.$customer_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除客户失败'];
        }
    }
}
