<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusSales extends Model
{
    //关联客户
    public function customer(){
        return $this->belongsTo('BusCustomer','customerid','id');
    }
    //关联商品
    public function goods(){
        return $this->belongsTo('BusGoods','goodsid','id');
    }

    //添加商品销售
    public function AddSale($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加商品销售成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加商品销售失败',100);
            return '添加失败';
        }
    }

    //编辑商品销售
    public function UpdateSale($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('商品销售信息【'.$data['id'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('商品销售信息【'.$data['id'].'】更新失败',100);
            return '商品销售更新失败！';
        }
    }

    //批量删除商品销售
    public function batchDelSale($param){
        try{
            BusSales::destroy($param);
            writelog('商品销售批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('商品销售批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除商品销售
    public function delSale($sale_id){
        try{
            $this->where('id', $sale_id)->delete();
            writelog('商品销售【ID='.$sale_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除商品成功'];
        }catch( PDOException $e){
            writelog('商品销售【ID='.$sale_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除商品失败'];
        }
    }
}
