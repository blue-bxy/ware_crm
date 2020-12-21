<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Inport extends Controller
{
    //商品进货管理页面
    public function inport(){
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
            $count = model('BusInport')->where($map)->count();//计算总页面
            $lists = model('BusInport')->where($map)->page($Nowpage, $limits)->with('provider,goods')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('search_goods', $goods_arr);
        $this->assign("search_provider",$arr);
        return view();
    }

    //批量删除商品进货
    public function batchDelInport(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusInport')->batchDelInport($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除商品进货
    public function DeleteInport(){
        $id = input('param.id');
        $flag = model('BusInport')->delInport($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //添加商品进货
    public function add_inport(){
        if($this->request->isAjax()){
            $data=input('post.');
            $data['operateperson']=session('admin.name');
            $result=model('BusInport')->AddInport($data);
            //增加商品表中该商品的库存量
            $good=model('BusGoods')->get($data['goodsid']);
            $good->dangernum=['inc', $data['number']];
            $goodresult=$good->save();
            if($result==1&&$goodresult){
                $this->success('商品进货添加成功');
            }else{
                $this->error($result);
            }
        }
        $arr=Db::table("bus_provider")->column('id,providername'); //获取供应商列表
        $this->assign("search_provider",$arr);
        return view();
    }

    //根据供应商id加载商品下拉列表
    public function loadGoodsByProviderId(){
        $providerid=input('providerid');
        $result=model('BusGoods')->where('providerid',$providerid)->select();
        return json(['code'=>'200','data'=>$result]);
    }

    //编辑商品进货
    public function edit_inport(){
        if(request()->isAjax()){
            $data=input('post.');
            $result=model('BusInport')->UpdateInport($data);
            if($result==1){
                $this->success('商品进货更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询商品进货信息
        $result=model('BusInport')->find($id);
        $data['inport']=$result;
        $arr=Db::table("bus_provider")->column('id,providername'); //获取供应商列表
        $this->assign("search_provider",$arr);
        $this->assign($data);
        return view();
    }

    //商品退货
    public function backGoods(){
        $data=input('post.');
        //根据进货单id查询该进货单信息
        $inport=model('BusInport')->find($data['id']);
        //查询商品信息
        $goods=model('BusGoods')->get($inport['goodsid']);
        //将退货信息写入退货表中
        $result=model('BusOutport')->add($data,$inport,$goods['goodsname']);
        //更改退货商品的库存量
        $goods->dangernum=['dec', $data['number']];
        $goodresult=$goods->save();
        //更改进货数量
        $inport->number=['dec',$data['number']];
        $inportresult=$inport->save();
        if($result==1&&$goodresult&&$inportresult){
            $this->success('商品退货成功');
        }else{
            $this->error($result);
        }
    }
}
