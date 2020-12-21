<?php

namespace app\admin\controller;

use think\Controller;

class Provider extends Controller
{
    //供应商管理页面
    public function provider(){
        $providername=input('providername');//供应商名称
        $providerphone=input('providerphone');//供应商电话
        $connectionperson=input('connectionperson');//联系人
        $address=input('address');
        $bank=input('bank');//开户行
        if(request()->isAjax()){
            extract(input());
            $map = [];
            if($providername&&$providername!==""){
                $map[] = ['providername','like',"%" . $providername . "%"];
            }
            if($providerphone&&$providerphone!==""){
                $map[] = ['providerphone','like',"%" . $providerphone . "%"];
            }
            if($connectionperson&&$connectionperson!==""){
                $map[] = ['connectionperson','like',"%" . $connectionperson . "%"];
            }
            if($bank&&$bank!==""){
                $map[] = ['bank','like',"%" . $bank . "%"];
            }
            if($address&&$address!==""){
                $map['address'] = [ $address ];
            }
            $Nowpage = input('get.page') ? input('get.page'):1;
            $limits = input("limit")?input("limit"):10;// 获取总条数;
            $count = model('BusProvider')->where($map)->count();//计算总页面
            $lists = model('BusProvider')->where($map)->page($Nowpage, $limits)->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return view();
    }

    //批量删除供应商
    public function batchDelProvider(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusProvider')->batchDelProvider($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除供应商
    public function DeleteProvider(){
        $id = input('param.id');
        $flag = model('BusProvider')->delProvider($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //添加供应商
    public function add_provider(){
        if($this->request->isAjax()){
            $data=[
                "providername"=>input('post.providername'),
                "providerphone"=>input('post.providerphone'),
                "zip"=>input('post.zip'),
                "address"=>input('post.address'),
                "connectionperson"=>input('post.connectionperson'),
                "phone"=>input('post.phone'),
                "email"=>input('post.email'),
                "bank"=>input('post.bank'),
                "bankaccountnumber"=>input('post.bankaccountnumber'),
                "fax"=>input('post.fax'),
                "available"=>input('post.available'),
            ];
            $result=$this->validate($data,[
                'providername|供应商名称'=>'require|unique:BusProvider',
                'zip|邮编'=>'zip',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('BusProvider')->AddProvider($data);
            if($result==1){
                $this->success('供应商添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑供应商
    public function edit_provider(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "providername"=>input('post.providername'),
                "providerphone"=>input('post.providerphone'),
                "zip"=>input('post.zip'),
                "address"=>input('post.address'),
                "connectionperson"=>input('post.connectionperson'),
                "phone"=>input('post.phone'),
                "email"=>input('post.email'),
                "bank"=>input('post.bank'),
                "bankaccountnumber"=>input('post.bankaccountnumber'),
                "fax"=>input('post.fax'),
                "available"=>input('post.available'),
            ];
            $result=$this->validate($data,[
                'providername|供应商名称'=>'require|unique:BusProvider',
                'zip|邮编'=>'zip',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('BusProvider')->UpdateProvider($data);
            if($result==1){
                $this->success('供应商更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询供应商信息
        $result=model('BusProvider')->find($id);
        $data['provider']=$result;
        $this->assign($data);
        return view();
    }

    //更改供应商可用状态
    public function provider_state()
    {
        extract(input());
        $flag = model('BusProvider')->provider_state($id,$num);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
}
