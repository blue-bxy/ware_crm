<?php
/*
 * 淘宝接口：根据ip获取所在城市名称
 */
function get_ip_area($ip){
    if($ip == '127.0.0.1'){
        return '内网IP';
    }
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
    $ret = https_request($url);
    $arr = json_decode($ret,true);
    if($arr['code'] == 1){
        return '';
    }else{
        return $arr['data']['country'].$arr['data']['region'].$arr['data']['city'].$arr['data']['isp'];
    }
}

