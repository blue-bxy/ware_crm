<?php

namespace app\common\model;

use think\Db;
use think\Model;

class BusGoods extends Model
{
    //关联供应商
    public function provider(){
        return $this->belongsTo('BusProvider','providerid','id');
    }

    /**
     * @param $id
     * @param $num
     * @return array
     * 更改商品状态
     */
    public function goods_state($id,$num){
        $goodsname = $this->where('id',$id)->value('goodsname');
        if($num == 0){
            $msg = '禁用';
        }else{
            $msg = '启用';
        }
        Db::startTrans();// 启动事务
        try{
            $this->where ('id' , $id)->setField (['available' => $num]);
            Db::commit();// 提交事务
            writelog('商品【'.$goodsname.'】'.$msg.'成功',200);
            return ['code' => 200, 'data' => '', 'msg' => '已'.$msg];
        }catch( \Exception $e){
            Db::rollback ();//回滚事务
            writelog('商品【'.$goodsname.'】'.$msg.'失败',100);
            return ['code' => 100, 'data' => '', 'msg' => $msg.'失败'];
        }
    }

    //添加商品
    public function AddGoods($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加商品成功',200);
            return 1;
        }else{
            writelog('用户【'.session('admin.loginname').'】添加商品失败',100);
            return '添加失败';
        }
    }

    //编辑商品
    public function UpdateGoods($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('商品【'.$data['goodsname'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('商品【'.$data['goodsname'].'】更新失败',100);
            return '商品更新失败！';
        }
    }

    //批量删除商品
    public function batchDelGoods($param){
        try{
            BusGoods::destroy($param);
            writelog('商品批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('商品批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除商品
    public function delGoods($goods_id){
        try{
            $this->where('id', $goods_id)->delete();
            writelog('商品【ID='.$goods_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除商品成功'];
        }catch( PDOException $e){
            writelog('商品【ID='.$goods_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除商品失败'];
        }
    }
}
