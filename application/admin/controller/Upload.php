<?php

namespace app\admin\controller;

use think\Controller;
//require 'vendor/qiniu/php-sdk/autoload.php';
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
class Upload extends Controller
{
    /**
     * 上传图片到七牛云
     */
    public function upload(){
        // 初始化签权对象
        $accessKey = 'aCkUJAiPfA_bOw94wobzIk9jQzIOTEggP8cjc0M9';
        $secretKey = 'c3RE3kb4G68-LNyRhbRK939olpCyxqTLZjnmupog';
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传Token
        $bucket = 'warehousegoodsimage';//七牛云上的存储空间名
        $token = $auth->uploadToken($bucket);
        //接受前端传过来的文件
        $data = $this->request->file();
        $info = $data['file']->getInfo();
        //获得图片的后缀名
        $ext=pathinfo($info['name'], PATHINFO_EXTENSION);  //后缀
        //组装图片名
        $key = date('Ymd').uuid().'.'.$ext;
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $info['tmp_name']);
        if ($err !== null) {
            return ['err' => 0,  'data' => '上传失败'];
        } else {
            //返回图片的完整URL
            return ['code' => 1, 'msg' => '上传成功', 'data' => ($ret['key'])];
        }
    }
}
