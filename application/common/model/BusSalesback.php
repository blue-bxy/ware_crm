<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusSalesback extends Model
{
    //关联客户
    public function customer(){
        return $this->belongsTo('BusCustomer','customerid','id');
    }
    //关联商品
    public function goods(){
        return $this->belongsTo('BusGoods','goodsid','id');
    }

    //添加商品退货信息
    public function add($data,$sale,$goodsname){
        Db::startTrans();// 启动事务
        try{
            $saleback=new BusSalesback;
            $saleback->customerid=$sale['customerid'];
            $saleback->paytype=$sale['paytype'];
            $saleback->salesbacktime=date("Y-m-d H:i:s");
            $saleback->operateperson=session('admin.name');
            $price=$sale['saleprice']/$sale['number']*$data['number'];//得到退货商品的金额
            $saleback->salebackprice=$price;
            $saleback->number=$data['number'];
            $saleback->remark=$data['remark'];
            $saleback->goodsid=$sale['goodsid'];
            $saleback->saleid=$sale['id'];
            $saleback->save();
            Db::commit();// 提交事务
            writelog('销售商品【'.$goodsname.'】退货成功',200);
            return 1;
        }catch (\Exception $e){
            Db::rollback();// 回滚事务
            writelog('销售商品【'.$goodsname.'】退货失败',100);
            return '销售商品退货失败！';
        }
    }

    //批量删除商品销售退还信息
    public function batchDelSaleBack($param){
        try{
            BusSalesback::destroy($param);
            writelog('商品销售退还信息批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('商品销售退还信息批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }
}
