<?php
namespace Sup\Utils\Encrypt;

class RsaEncrypt{

    protected static $rsa_private = '';

    protected static $rsa_public = '';

    // 设置公钥
    public static function setRsaPublic($public_key){
        self::$rsa_public=$public_key;
    }
    // 设置私钥
    public static function setRsaPrivate($private_key){
        self::$rsa_private=$private_key;
    }

    public static function encrypt($data) {
        $public_key = "-----BEGIN PUBLIC KEY-----\n" . wordwrap(self::$rsa_public, 64, "\n", true) . "\n-----END PUBLIC KEY-----";

        $key = openssl_pkey_get_public($public_key);
        if (!$key) {
            return '';
        } 
        $return_en = openssl_public_encrypt($data, $crypt_str, $key);
        if (!$return_en) {
            return '';
        }
        return base64_encode($crypt_str);
    }
    
    public static function decrypt($data) { 
        $private_key = "-----BEGIN PRIVATE KEY-----\n" . wordwrap(self::$rsa_private, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
        $key = openssl_pkey_get_private($private_key);
        if (!$key) {
            return '';
        }
        $return_de = openssl_private_decrypt(base64_decode($data), $decrypted, $key);
        if (!$return_de) {
            return '';
        }
        return $decrypted;
    }
}