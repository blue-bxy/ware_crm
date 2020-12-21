<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusInport extends Model
{
    //关联供应商
    public function provider(){
        return $this->belongsTo('BusProvider','providerid','id');
    }
    //关联商品
    public function goods(){
        return $this->belongsTo('BusGoods','goodsid','id');
    }

    //添加商品进货
    public function AddInport($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加商品进货成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加商品进货失败',100);
            return '添加失败';
        }
    }

    //编辑商品进货
    public function UpdateInport($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('商品进货信息【'.$data['id'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('商品进货信息【'.$data['id'].'】更新失败',100);
            return '商品进货更新失败！';
        }
    }

    //批量删除商品进货
    public function batchDelInport($param){
        try{
            BusInport::destroy($param);
            writelog('商品进货批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('商品进货批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除商品进货
    public function delInport($inport_id){
        try{
            $this->where('id', $inport_id)->delete();
            writelog('商品进货【ID='.$inport_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除商品成功'];
        }catch( PDOException $e){
            writelog('商品进货【ID='.$inport_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除商品失败'];
        }
    }
}
