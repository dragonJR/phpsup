<?php 
namespace Sup\Utils;

class SupStr{
    
    public static function removeStr($original_str,$remove_str,$symbol=","){
        $original_arr=explode($symbol,$original_str);
        if(!empty($original_arr)){
            foreach ($original_arr as $key => $value) {
                if($value==$remove_str){
                    unset($original_arr[$key]);
                }
            }
        }
        return implode($symbol,array_values($original_arr));
    }

}

?>