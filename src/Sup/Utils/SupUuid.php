<?php 
namespace Sup\Utils;

class SupUuid{
    /**
     * 生成随机的uuid编码
     */
    public static function create_uuid($type=4,$name_space='', $string=''){
        switch ($type) {
            case '3':
                $uuid=self::v3_uuid($name_space,$string);
                break;
            case '4':
                $uuid=self::v4_uuid();
                break;
            case '5':
                $uuid=self::v5_uuid($name_space,$string);
                break;
            default:
                $uuid=self::v4_uuid();
                break;
        }
        return $uuid;
    }
    /**
     * v3 (namespace)
     * 原理：基于 namespace + 输入内容 进行 MD5。
     */
    public static function v3_uuid($name_space, $string){
        $n_hex = str_replace(array('-','{','}'), '', $name_space); // Getting hexadecimal components of namespace
        $binary_str = ''; // Binary Value
        //Namespace UUID to bits conversion
        for($i = 0; $i < strlen($n_hex); $i+=2) {
          $binary_str .= chr(hexdec($n_hex[$i].$n_hex[$i+1]));
        }
        //hash value
        $hashing = md5($binary_str . $string);
        return sprintf('%08s-%04s-%04x-%04x-%12s',
          // 32 bits for the time low
          substr($hashing, 0, 8),
          // 16 bits for the time mid
          substr($hashing, 8, 4),
          // 16 bits for the time hi,
          (hexdec(substr($hashing, 12, 4)) & 0x0fff) | 0x3000,
          // 8 bits and 16 bits for the clk_seq_hi_res,
          // 8 bits for the clk_seq_low,
          (hexdec(substr($hashing, 16, 4)) & 0x3fff) | 0x8000,
          // 48 bits for the node
          substr($hashing, 20, 12)
        );
    }
    /**
     * v4 (random)
     * 原理：基于随机数。
     * 这个版本的UUID是使用最多的。
     */
    public static function v4_uuid(){
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for the time_low
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        // 16 bits for the time_mid
        mt_rand(0, 0xffff),
        // 16 bits for the time_hi,
        mt_rand(0, 0x0fff) | 0x4000,
        // 8 bits and 16 bits for the clk_seq_hi_res,
        // 8 bits for the clk_seq_low,
        mt_rand(0, 0x3fff) | 0x8000,
        // 48 bits for the node
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
      );
    }
    /**
     * v5 (namespace)
     * 原理：跟 V3 差不多，只是把散列算法的 MD5 变成 SHA1。
     */
    public static function v5_uuid($name_space, $string){
        $n_hex = str_replace(array('-','{','}'), '', $name_space); // Getting hexadecimal components of namespace
        $binray_str = ''; // Binary value string
        //Namespace UUID to bits conversion
        for($i = 0; $i < strlen($n_hex); $i+=2) {
          $binray_str .= chr(hexdec($n_hex[$i].$n_hex[$i+1]));
        }
        //hash value
        $hashing = sha1($binray_str . $string);
        return sprintf('%08s-%04s-%04x-%04x-%12s',
          // 32 bits for the time_low
          substr($hashing, 0, 8),
          // 16 bits for the time_mid
          substr($hashing, 8, 4),
          // 16 bits for the time_hi,
          (hexdec(substr($hashing, 12, 4)) & 0x0fff) | 0x5000,
          // 8 bits and 16 bits for the clk_seq_hi_res,
          // 8 bits for the clk_seq_low,
          (hexdec(substr($hashing, 16, 4)) & 0x3fff) | 0x8000,
          // 48 bits for the node
          substr($hashing, 20, 12)
        );
    }


}

?>