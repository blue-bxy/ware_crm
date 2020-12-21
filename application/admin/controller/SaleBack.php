<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class SaleBack extends Controller
{
    //商品退货管理页面
    public function saleback(){
        $goodsid=input('goodsid');//商品id
        $operateperson=input('operateperson');//操作员
        $customerid=input('customerid');//客户id
        $remark=input('remark');//备注
        $start = input('start');//销售开始时间
        $end = input('end');//销售结束时间
        $arr=Db::table("bus_customer")->column("id,customername"); //获取客户列表
        $goods_arr=Db::table("bus_goods")->column("id,goodsname");;
        if(request()->isAjax()){
            extract(input());
            $map = [];
            if($customerid&&$customerid!==""){
                $map['customerid'] =  $customerid;
            }
            if($goodsid&&$goodsid!==""){
                $map['goodsid'] = $goodsid;
            }
            if($operateperson&&$operateperson!==""){
                $map[] = ['operateperson','like',"%" . $operateperson . "%"];
            }
            if($remark&&$remark!==""){
                $map[] = ['remark','like',"%" . $remark . "%"];
            }
            if($start&&$start!==""&&$end=="")
            {
                $map[] = ['salestime','>= time',$start];
            }
            if($end&&$end!==""&&$start=="")
            {
                $map[] = ['salestime','<= time',$end];
            }
            if($start&&$start!==""&&$end&&$end!=="")
            {
                $map[] = ['salestime','between time',[$start,$end]];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('BusSalesback')->where($map)->count();//计算总页面
            $lists = model('BusSalesback')->where($map)->page($Nowpage, $limits)->with('customer,goods')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('search_goods', $goods_arr);
        $this->assign('search_customer', $arr);
        return view();
    }

    //批量删除商品销售退还信息
    public function batchDelSaleBack(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusSalesback')->batchDelSaleBack($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }
}
