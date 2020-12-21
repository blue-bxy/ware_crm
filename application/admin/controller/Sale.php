<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Sale extends Controller
{
    //商品销售管理页面
    public function sale(){
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
            $count = model('BusSales')->where($map)->count();//计算总页面
            $lists = model('BusSales')->where($map)->page($Nowpage, $limits)->with('customer,goods')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('search_goods', $goods_arr);
        $this->assign('search_customer', $arr);
        return view();
    }

    //批量删除商品销售
    public function batchDelSale(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusSales')->batchDelSale($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除商品销售
    public function DeleteSale(){
        $id = input('param.id');
        $flag = model('BusSales')->delSale($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //添加商品销售
    public function add_sale(){
        if($this->request->isAjax()){
            $data=input('post.');
            $data['operateperson']=session('admin.name');
            $result=model('BusSales')->AddSale($data);
            //减少商品表中该商品的库存量
            $good=model('BusGoods')->get($data['goodsid']);
            $good->dangernum=['dec', $data['number']];
            $goodresult=$good->save();
            if($result==1&&$goodresult){
                $this->success('商品销售添加成功');
            }else{
                $this->error($result);
            }
        }
        $arr=Db::table("bus_customer")->column('id,customername'); //获取客户列表
        $this->assign("search_customer",$arr);
        $arr=Db::table("bus_goods")->column('id,goodsname'); //获取商品列表
        $this->assign("search_goods",$arr);
        return view();
    }

    //根据商品id加载该商品数量
    public function loadGoodsCountByGoodsId(){
        $goodsid=input('goodsid');
        $result=model('BusGoods')->where('id',$goodsid)->value('dangernum');
        return json(['code'=>'200','data'=>$result]);
    }

    //编辑商品销售
    public function edit_sale(){
        if(request()->isAjax()){
            $data=input('post.');
            $result=model('BusSales')->UpdateSale($data);
            if($result==1){
                $this->success('商品销售更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询商品销售信息
        $result=model('BusSales')->find($id);
        $data['sale']=$result;
        //查询该商品的数量，以防直接修改销售商品数量时大于该商品的库存量
        $goodscount=model('BusGoods')->where('id',$result['goodsid'])->value('dangernum');
        $this->assign("goodscount",$goodscount);
        $arr=Db::table("bus_customer")->column('id,customername'); //获取客户列表
        $this->assign("search_customer",$arr);
        $arr=Db::table("bus_goods")->column('id,goodsname'); //获取商品列表
        $this->assign("search_goods",$arr);
        $this->assign($data);
        return view();
    }

    //商品退货
    public function backGoods(){
        $data=input('post.');
        //根据销售单id查询该销售单信息
        $sale=model('BusSales')->find($data['id']);
        //查询商品信息
        $goods=model('BusGoods')->get($sale['goodsid']);
        //将退货信息写入销售退货表中
        $result=model('BusSalesback')->add($data,$sale,$goods['goodsname']);
        //更改退货商品的库存量
        $goods->dangernum=['inc', $data['number']];
        $goodresult=$goods->save();
        //更改销售数量
        $number=$sale['number']-$data['number'];
        $sale->number=$number;
        $saleresult=$sale->save();
        if($result==1&&$goodresult&&$saleresult){
            $this->success('销售商品退货成功');
        }else{
            $this->error($result);
        }
    }
}
