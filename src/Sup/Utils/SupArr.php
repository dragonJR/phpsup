<?php
namespace Sup\Utils;

class SupArr
{
   /** 
   * 从数组中删除空白的元素（包括只有空白字符的元素） 
   * 
   * 用法： 
   * @code php 
   * $arr = array('', 'test', '  '); 
   * SupArr::removeEmpty($arr); 
   * 
   * dump($arr); 
   *  // 输出结果中将只有 'test' 
   * @endcode 
   * 
   * @param array $arr 要处理的数组 
   * @param boolean $trim 是否对数组元素调用 trim 函数 
   */ 
  public static function removeEmpty(&$arr, $trim = TRUE) 
  { 
    foreach ($arr as $key => $value) 
    { 
      if (is_array($value)) 
      { 
        self::removeEmpty($arr[$key]); 
      } 
      else 
      { 
        $value = trim($value); 
        if ($value == '') 
        { 
          unset($arr[$key]); 
        } 
        elseif ($trim) 
        { 
          $arr[$key] = $value; 
        } 
      } 
    } 
  } 
}
