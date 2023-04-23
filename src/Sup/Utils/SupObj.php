<?php 
namespace Sup\Utils;

class SupObj{
    /**
     * 对象转为数组
     */
    public static function objToArr($obj){
        $_arr=is_object($obj)?get_object_vars($obj):$obj;
        $arr = null;
        foreach($_arr as $key=>$val){
            $val=(is_array($val))||is_object($val)?self::objToArr($val):$val;
            $arr[$key]=$val;
        }
        return $arr;
    }
}

?>