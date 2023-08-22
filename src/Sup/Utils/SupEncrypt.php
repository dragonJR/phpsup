<?php 
namespace Sup\Utils;

use Sup\Utils\Encrypt\AesEncrypt;
use Sup\Utils\Encrypt\RsaEncrypt;

class SupEncrypt{

    public static function encrypt($str,$secret_key='',$iv=''){
        if($secret_key!=''){
            AesEncrypt::setSecretKey($secret_key);
        }
        if($iv!=''){
            AesEncrypt::setIv($iv);
        }

        $res=AesEncrypt::encrypt($str);
        return $res;
    }

    public static function decrypt($str,$secret_key='',$iv=''){
        if($secret_key!=''){
            AesEncrypt::setSecretKey($secret_key);
        }
        if($iv!=''){
            AesEncrypt::setIv($iv);
        }
        $res=AesEncrypt::decrypt($str);
        return $res;
    }

    public static function ras_encrypt($data,$public_key='',$private_key=''){
        if(!empty($public_key)){
            RsaEncrypt::setRsaPublic($public_key);
        }
        if(!empty($private_key)){
            RsaEncrypt::setRsaPrivate($private_key);
        }
        $res=RsaEncrypt::encrypt($data);
        return $res;
    }

    public static  function ras_decrypt($str,$public_key='',$private_key=''){
        if(!empty($public_key)){
            RsaEncrypt::setRsaPublic($public_key);
        }
        if(!empty($private_key)){
            RsaEncrypt::setRsaPrivate($private_key);
        }
        $res=RsaEncrypt::decrypt($str);
        return $res;
    }

}

?>