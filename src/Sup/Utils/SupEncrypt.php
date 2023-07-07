<?php 
namespace Sup\Utils;

use Sup\Encrypt\AesEncrypt;

class SupEncrypt{

    public static function encrypt($str,$type="aes"){
        if($type=="aes"){
            $res=AesEncrypt::encrypt($str);
        }
        return $res;
    }

    public static function decrypt($str,$type="aes"){
        if($type=="aes"){
            $res=AesEncrypt::decrypt($str);
        }
        return $res;
    }
}

?>