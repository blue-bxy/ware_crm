<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Db;

/**
 * 整理菜单树
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    //dump($param);die;
    $parent = []; //父类
    $child = [];  //子类
    foreach ($param as $key => $vo) {
        if ($vo['pid'] == 0 && $vo['href'] == '#') {
            $vo['route'] = '#';
            $parent[] = $vo;
        } else if ($vo['pid'] == 0 && $vo['href'] != '#') {
            if (!preg_match("/^((https|http|ftp|rtsp|mms){0,1}(:\/\/){0,1})www\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/", $vo['href'])) {
                $vo['route'] = url($vo['href']); //跳转地址
            } else {
                $vo['route'] = $vo['href']; //跳转地址
            }
            $parent[] = $vo;
        } else {
            if (!preg_match("/^((https|http|ftp|rtsp|mms){0,1}(:\/\/){0,1})www\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/", $vo['href'])) {
                $vo['route'] = url($vo['href']); //跳转地址
            } else {
                $vo['route'] = $vo['href']; //跳转地址
            }
            $child[] = $vo;
        }
    }
    //判断一级菜单
    foreach ($parent as $key => $vo) {
        foreach ($child as $k => $v) {
            if ($v['pid'] == $vo['id']) {
                $parent[$key]['child'][] = $v;
            }
        }
    }
    //判断子级是否还有子菜单
    for ($i = 0; $i < count($parent); $i++) {//循环出所有的一级菜单（顶级父菜单）
        if (isset($parent[$i]['child'])) {//判断一级菜单下是否有二级菜单
            for ($j = 0; $j < count($parent[$i]['child']); $j++) {//如果有则循环出二级菜单
                if ($parent[$i]['child'][$j]['href'] == '##') {//二级菜单的href为##
                    for ($a = 0; $a < count($child); $a++) {//循环出所有的子菜单
                        if ($child[$a]['pid'] == $parent[$i]['child'][$j]['id']) {//判断子菜单中pid是否等于二级菜单中的id
                            $parent[$i]['child'][$j]['child'][] = $child[$a];//如果等于则成为三级菜单
                        }
                    }
                }
            }
        }
    }
    unset($child);
    return $parent;
}

/**
 * 记录日志
 * @param $description
 * @param $status
 * @param string $uid
 * @param string $username
 * @param string $type
 * @return bool
 */
function writelog($description, $status, $uid = '', $username = '', $type = '')
{
    $id = $uid ? $uid : session('admin.id');
    $name = $username ?: session('admin.name');
    $ip = request()->ip();
    //$ipaddr = get_ip_area($ip);//根据ip地址获取地域信息
    $ipaddr = '';
    /****************************日志存入数据库*******************************/
    $data['admin_id'] = $id;
    $data['admin_name'] = $name;
    $data['description'] = $description;
    $data['status'] = $status;
    $data['ip'] = $ip;
    $data['add_time'] = time();
    $data['ipaddr'] = $ipaddr;
    $logId = Db::table('sys_loginfo')->insertGetId($data);
    /****************************日志存入数据库*******************************/

}

/*
 * base64格式图片转图片文件
 */
function base64_img($base64url, $bool = false)
{
    //匹配出图片的格式
    $base64url = str_replace(' ', '+', $base64url);
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64url, $result)) {
        $type = $result[2];//图片格式
        $new_file = ROOT_PATH . 'public' . '/' . 'uploads/face/' . date('Ymd', time()) . "/";
        if (!file_exists($new_file)) {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700, true);
        }
        $new = md5(time() . uuid());
        $new_file = $new_file . $new . ".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64url)))) {
            $file_name = "/uploads/face/" . date('Ymd', time()) . "/" . $new . ".{$type}";
            return ['code' => 200, 'msg' => $file_name];
        } else {
            return ['code' => 100, 'msg' => '图片不是base64格式！'];
        }
    }
}

//生成类似uuid的随机字符串
function uuid($prefix = '')
{
    $chars = md5(uniqid(mt_rand(), true));
//    $uuid  = substr($chars,0,8) . '-';
//    $uuid .= substr($chars,8,4) . '-';
//    $uuid .= substr($chars,12,4) . '-';
//    $uuid .= substr($chars,16,4) . '-';
//    $uuid .= substr($chars,20,12);
    return $prefix . $chars;
}
