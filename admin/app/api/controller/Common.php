<?php
namespace app\api\controller;
use think\Controller;
class Common extends Controller{
    //获取客户端真实ip
    static public function getIp() {
        $unknown = 'unknown';
        if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp  ($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        /*
        处理多层代理的情况
        或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
        */
        if (false !== strpos($ip, ','))
            $ip = reset(explode(',', $ip));
        return $ip;
    }
    //生成推荐码
    static public function getSort($length = 15){
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
    }
    //验证银行卡号
    static public function check_bankCard($card_number){
        $arr_no = str_split($card_number);
        $last_n = $arr_no[count($arr_no)-1];
        krsort($arr_no);
        $i = 1;
        $total = 0;
        foreach ($arr_no as $n){
            if($i%2==0){
                $ix = $n*2;
                if($ix>=10){
                    $nx = 1 + ($ix % 10);
                    $total += $nx;
                }else{
                    $total += $ix;
                }
            }else{
                $total += $n;
            }
            $i++;
        }
        $total -= $last_n;
        $x = 10 - ($total % 10);
        if($x == $last_n){
            return 'true';
        }else{
            return 'false';
        }
    }
    //验证身份证号
    static public function validation_filter_id_card($id_card){
        if(strlen($id_card)==18){
            return self::idcard_checksum18($id_card);
        }elseif((strlen($id_card)==15)){
            $id_card=self::idcard_15to18($id_card);
            return self::idcard_checksum18($id_card);
        }else{
            return false;
        }
    }
// 计算身份证校验码，根据国家标准GB 11643-1999
    static public  function idcard_verify_number($idcard_base){
        if(strlen($idcard_base)!=17){
            return false;
        }
        //加权因子
        $factor=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        //校验码对应值
        $verify_number_list=array('1','0','X','9','8','7','6','5','4','3','2');
        $checksum=0;
        for($i=0;$i<strlen($idcard_base);$i++){
            $checksum += substr($idcard_base,$i,1) * $factor[$i];
        }
        $mod=$checksum % 11;
        $verify_number=$verify_number_list[$mod];
        return $verify_number;
    }
// 将15位身份证升级到18位
    static public function idcard_15to18($idcard){
        if(strlen($idcard)!=15){
            return false;
        }else{
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if(array_search(substr($idcard,12,3),array('996','997','998','999')) !== false){
                $idcard=substr($idcard,0,6).'18'.substr($idcard,6,9);
            }else{
                $idcard=substr($idcard,0,6).'19'.substr($idcard,6,9);
            }
        }
        $idcard=$idcard.self::idcard_verify_number($idcard);
        return $idcard;
    }
// 18位身份证校验码有效性检查
    static public function idcard_checksum18($idcard){
        if(strlen($idcard)!=18){
            return false;
        }
        $idcard_base=substr($idcard,0,17);
        if(self::idcard_verify_number($idcard_base)!=strtoupper(substr($idcard,17,1))){
            return false;
        }else{
            return true;
        }
    }
}