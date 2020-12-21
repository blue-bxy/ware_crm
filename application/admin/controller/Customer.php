<?php

namespace app\admin\controller;

use think\Controller;

class Customer extends Controller
{
    //客户管理页面
    public function customer(){
        $customername=input('customername');//客户名称
        $customerphone=input('customerphone');//客户电话
        $connectionperson=input('connectionperson');//联系人
        $bank=input('bank');//开户行
        $address=input('address');//地址
        if(request()->isAjax()){
            extract(input());
            $map = [];
            if($customername&&$customername!==""){
                $map[] = ['customername','like',"%" . $customername . "%"];
            }
            if($customerphone&&$customerphone!==""){
                $map[] = ['customerphone','like',"%" . $customerphone . "%"];
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
            $count = model('BusCustomer')->where($map)->count();//计算总页面
            $lists = model('BusCustomer')->where($map)->page($Nowpage, $limits)->select();
            return json(['code'=>220,'msg'=>'','count'=>$count,'data'=>$lists]);
        }
        return view();
    }

    //批量删除客户
    public function batchDelCustomer(){
        extract(input());
        if(empty($ids)){
            return json(['code'=>100,'msg'=>'请选择要删除的记录！']);
        }
        $flag = model('BusCustomer')->batchDelCustomer($ids);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //删除客户
    public function DeleteCustomer(){
        $id = input('param.id');
        $flag = model('BusCustomer')->delCustomer($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    //添加客户
    public function add_customer(){
        if($this->request->isAjax()){
            $data=[
                "customername"=>input('post.customername'),
                "customerphone"=>input('post.customerphone'),
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
                'customername|客户名称'=>'require|unique:BusCustomer',
                'zip|邮编'=>'zip',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('BusCustomer')->AddCustomer($data);
            if($result==1){
                $this->success('客户添加成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑客户
    public function edit_customer(){
        if(request()->isAjax()){
            $data=[
                "id"=>input('post.id'),
                "customername"=>input('post.customername'),
                "customerphone"=>input('post.customerphone'),
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
                'customername|客户名称'=>'require|unique:BusCustomer',
                'zip|邮编'=>'zip',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $result=model('BusCustomer')->UpdateCustomer($data);
            if($result==1){
                $this->success('客户更新成功');
            }else{
                $this->error($result);
            }
        }
        $id=input('id');
        //根据id查询客户信息
        $result=model('BusCustomer')->find($id);
        $data['customer']=$result;
        $this->assign($data);
        return view();
    }

    //更改客户可用状态
    public function customer_state()
    {
        extract(input());
        $flag = model('BusCustomer')->customer_state($id,$num);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
}
