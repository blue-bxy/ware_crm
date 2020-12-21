<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Outport extends Controller
{
    //商品退货管理页面
    public function outport(){
        $key = input('key');//供应商id
        $goodsid=input('goodsid');//商品id
        $operateperson=input('operateperson');//操作员
        $remark=input('remark');//备注
        $start = input('start');//进货开始时间
        $end = input('end');//进货结束时间
        $arr=Db::table("bus_provider")->column("id,providername"); //获取供应商列表
        $goods_arr=Db::table("bus_goods")->column("id,goodsname");;
        if(request()->isAjax()){
            extract(input());
            $map = [];
            if($key&&$key!==""){
                $map['providerid'] =  $key;
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
                $map[] = ['inporttime','>= time',$start];
            }
            if($end&&$end!==""&&$start=="")
            {
                $map[] = ['inporttime','<= time',$end];
            }
            if($start&&$start!==""&&$end&&$end!=="")
            {
                $map[] = ['inporttime','between time',[$start,$end]];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('BusOutport')->where($map)->count();//计算总页面
            $lists = model('BusOutport')->where($map)->page($Nowpage, $limits)->with('provider,goods')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('search_goods', $goods_arr);
        $this->assign("search_provider",$arr);
        return view();
    }

    //批量删除商品退还信息
    public function batchDelOutPort(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusOutport')->batchDelOutPort($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }
}
