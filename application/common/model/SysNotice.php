<?php

namespace app\common\model;

use think\Db;
use think\Model;

class SysNotice extends Model
{
    //开启时间戳
    protected $autoWriteTimestamp = true;

    //添加公告
    public function AddNotice($data){
        $result=$this->save($data);
        if($result){
            writelog('用户【'.session('admin.loginname').'】添加公告成功',200);
            return 1;
        }else{
            return '添加失败';
        }
    }

    //批量删除公告
    public function batchDelNotice($param){
        try{
            SysNotice::destroy($param);
            writelog('公告批量删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '批量删除成功'];
        }catch( PDOException $e){
            writelog('公告批量删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '批量删除失败'];
        }
    }

    //删除公告
    public function delNotice($notice_id){
        try{
            $this->where('id', $notice_id)->delete();
            writelog('公告【ID='.$notice_id.'】删除成功',200,'','','true');
            return ['code' => 200, 'data' => '', 'msg' => '删除公告成功'];
        }catch( PDOException $e){
            writelog('公告【ID='.$notice_id.'】删除失败',100,'','','true');
            return ['code' => 100, 'data' => '', 'msg' => '删除公告失败'];
        }
    }

    //更新公告
    public function UpdateNotice($data){
        Db::startTrans();// 启动事务
        try{
            $this->save($data,['id' => $data['id']]);
            Db::commit();// 提交事务
            writelog('公告【'.$data['title'].'】更新成功',200);
            return 1;
        }catch( \Exception $e){
            Db::rollback();// 回滚事务
            writelog('公告【'.$data['title'].'】更新失败',100);
            return '公告更新失败！';
        }
    }

}
