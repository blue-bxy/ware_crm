<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Goods extends Controller
{
    //商品管理页面
    public function goods(){
        $key = input('key');//供应商id
        $goodsname=input('goodsname');//商品名称
        $produceplace=input('produceplace');//生产地
        $productcode=input('productcode');//生产批号
        $promitcode=input('promitcode');//批准文号
        $description=input('description');//商品描述
        $size=input('size');//商品规格
        $arr=Db::table("bus_provider")->column("id,providername"); //获取供应商列表
        if(request()->isAjax()){
            extract(input());
            $map = [];
            if($key&&$key!==""){
                $map['providerid'] =  $key;
            }
            if($goodsname&&$goodsname!==""){
                $map[] = ['goodsname','like',"%" . $goodsname . "%"];
            }
            if($produceplace&&$produceplace!==""){
                $map['produceplace'] = [ $produceplace ];
            }
            if($productcode&&$productcode!==""){
                $map[] = ['productcode','like',"%" . $productcode . "%"];
            }
            if($promitcode&&$promitcode!==""){
                $map[] = ['promitcode','like',"%" . $promitcode . "%"];
            }
            if($description&&$description!==""){
                $map[] = ['description','like',"%" . $description . "%"];
            }
            if($size&&$size!==""){
                $map[] = ['size','like',"%" . $size . "%"];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('BusGoods')->where($map)->count();//计算总页面
            $lists = model('BusGoods')->where($map)->page($Nowpage, $limits)->with('provider')->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        $this->assign('val', $key);
        $this->assign("search_provider",$arr);
        return view();
    }

    //批量删除商品
    public function batchDelGoods(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusGoods')->batchDelGoods($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除商品
    public function DeleteGoods(){
        $id = input('param.id');
        $flag = model('BusGoods')->delGoods($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //添加商品
    public function add_goods(){
        if($this->request->isAjax()){
            $data=[
                "goodsname"=>input('post.goodsname'),
                "description"=>input('post.description'),
                "goodsimg"=>input('post.goodsimg'),
                "providerid"=>input('post.providerid'),
                "produceplace"=>input('post.produceplace'),
                "goodspackage"=>input('post.goodspackage'),
                "size"=>input('post.size'),
                "productcode"=>input('post.productcode'),
                "promitcode"=>input('post.promitcode'),
                "price"=>input('post.price'),
                "number"=>input('post.number'),
                "available"=>input('post.available'),
            ];
            $result=$this->validate($data,[
                'goodsname|商品名称'=>'require|unique:BusGoods',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('BusGoods')->AddGoods($data);
            if($result==1){
                $this->success('商品添加成功');
            }else{
                $this->error($result);
            }
        }
        $arr=Db::table("bus_provider")->select(); //获取供应商列表
        $this->assign("search_provider",$arr);
        return view();
    }

    //商品图片上传
    public function uploadgoodimg(){

    }

    //编辑商品
    public function edit_goods(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "goodsname"=>input('post.goodsname'),
                "description"=>input('post.description'),
                "goodsimg"=>input('post.goodsimg'),
                "providerid"=>input('post.providerid'),
                "produceplace"=>input('post.produceplace'),
                "goodspackage"=>input('post.goodspackage'),
                "size"=>input('post.size'),
                "productcode"=>input('post.productcode'),
                "promitcode"=>input('post.promitcode'),
                "price"=>input('post.price'),
                "number"=>input('post.number'),
                "dangernum"=>input('post.number'),
                "available"=>input('post.available'),
            ];
            $result=model('BusGoods')->UpdateGoods($data);
            if($result==1){
                $this->success('商品更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询商品信息
        $result=model('BusGoods')->find($id);
        $data['goods']=$result;
        $arr=Db::table("bus_provider")->select(); //获取供应商列表
        $this->assign("search_provider",$arr);
        $this->assign($data);
        return view();
    }

    //更改商品可用状态
    public function goods_state()
    {
        extract(input());
        $flag = model('BusGoods')->goods_state($id,$num);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
}
