<?php 
namespace Sup\Utils;

class SupRandom{
    /**
     * 生成数字和字母(包含大小写)
     *
     * @param int $len 长度
     * @param int $is_letter_type 0表示包含字母大小写 1表示只有小写 2表示只有大写
     * @return string
     */
    public static function alnum($len = 8,$is_letter_type=0)
    {
        $alnum_str='';
        switch ($is_letter_type) {
            case 0:
                $alnum_str=self::build('alnum', $len);
                break;
            case 1:
                $alnum_str=self::build('alnumlower', $len);
                break;
            case 2:
                $alnum_str=self::build('alnumupper', $len);
                break;
            default:
                $alnum_str=self::build('alnum', $len);
                break;
        }
        return $alnum_str;
        
    }
     /**
     * 仅生成字符(包含大小写)
     *
     * @param int $len 长度
     * @param int $is_letter_type 0表示包含字母大小写 1表示只有小写 2表示只有大写
     * @return string
     */
    public static function alpha($len = 6,$is_letter_type=0)
    {
        $alpha_str='';
        switch ($is_letter_type) {
            case 0:
                $alpha_str=self::build('alpha', $len);
                break;
            case 1:
                $alpha_str=self::build('alphalower', $len);
                break;
            case 2:
                $alpha_str=self::build('alphaupper', $len);
                break;
            default:
                $alpha_str=self::build('alpha', $len);
                break;
        }
        return $alpha_str;
    }
    /**
     * 生成指定长度的随机数字
     *
     * @param int $len 长度
     * @return string
     */
    public static function numeric($len = 4)
    {
        return self::build('numeric', $len);
    }
    /**
     * 生成指定长度的无0随机数字
     *
     * @param int $len 长度
     * @return string
     */
    public static function nozero($len = 4)
    {
        return self::build('nozero', $len);
    }
    /**
     * 能用的随机数生成
     * @param string $type 类型 alpha/alnum/numeric/nozero/unique/md5/encrypt/sha1
     * @param int $len 长度
     * @return string
     */
    public static function build($type = 'alnum', $len = 8)
    {
        $str='';
        switch ($type) {
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alphalower':
                $pool = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'alphaupper':
                $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;        
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alnumlower':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyz';
                break;
            case 'alnumupper':
                $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;        
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;       
            default:
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }
        $strRepeat = str_repeat($pool, intval(ceil($len / strlen($pool))));
        $str=substr(str_shuffle($strRepeat), 0, $len);
        return $str;
    }
}

?>