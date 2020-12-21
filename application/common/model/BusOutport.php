<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusOutport extends Model
{
    //关联供应商
    public function provider(){
        return $this->belongsTo('BusProvider','providerid','id');
    }
    //关联商品
    public function goods(){
        return $this->belongsTo('BusGoods','goodsid','id');
    }

    //添加商品退货信息
    public function add($data,$inport,$goodsname){
        Db::startTrans();// 启动事务
        try{
            $outport=new BusOutport;
            $outport->providerid=$inport['providerid'];
            $outport->paytype=$inport['paytype'];
            $outport->outputtime=date("Y-m-d H:i:s");
            $outport->operateperson=session('admin.name');
            $price=$inport['inportprice']/$inport['number']*$data['number'];//得到退货商品的金额
            $outport->outportprice=$price;
            $outport->number=$data['number'];
            $outport->remark=$data['remark'];
            $outport->goodsid=$inport['goodsid'];
            $outport->inportid=$inport['id'];
            $outport->save();
            Db::commit();// 提交事务
            writelog('商品【'.$goodsname.'】退货成功',200);
            return 1;
        }catch (\Exception $e){
            Db::rollback();// 回滚事务
            writelog('商品【'.$goodsname.'】退货失败',100);
            return '商品退货失败！';
        }
    }

    //批量删除商品销售退还信息
    public function batchDelOutPort($param){
        try{
            BusOutport::destroy($param);
            writelog('商品退还信息批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('商品退还信息批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }
}
