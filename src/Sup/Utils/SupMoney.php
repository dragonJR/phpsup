<?php 
namespace Sup\Utils;

class SupMoney{
    /**
     * 金额的格式转换
     */
    public static function format_money($number,$min_value=1000,$decimal=1,$config=[]){
        if($number<$min_value){
            return $min_value;
        }
        if(!empty($config)){
            $alphabets=$config;
        }else{
            $alphabets = array( 100000000 => 'y', 10000 => 'w', 1000 => 'k' );
        }
       
        foreach( $alphabets as $key => $value ){
            if( $number >= $key ) {
                return round( $number / $key, $decimal ) . '' . $value;
            }
        }
    }
}

?>