<?php
namespace Sup\Utils\Encrypt;

class AesEncrypt{

    protected static $secret_key = 'uucenter';

    protected static $iv = 'w2wJCnctEG09danPPI7SxQ==';


    // 设置公钥
    public static function setSecretKey($secret_key){
        self::$secret_key=$secret_key;
    }
    // 设置私钥
    public static function setIv($iv){
        self::$iv=$iv;
    }

    public static function encrypt($str) {
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', base64_decode(self::$secret_key), OPENSSL_RAW_DATA,base64_decode(self::$iv));
        return $encrypted;
    }
    
    public static function decrypt($str) {
        $decrypted = openssl_decrypt($str, 'aes-256-cbc', base64_decode(self::$secret_key), OPENSSL_RAW_DATA,base64_decode(self::$iv));
        return $decrypted;
    }
}