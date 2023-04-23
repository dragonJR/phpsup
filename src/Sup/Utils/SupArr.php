<?php

namespace Sup\Utils;

class SupArr
{
    /**
     * 删除数组的空白元素
     */
    public static function removeArrEmpty($arr,$trim = TRUE){
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                self::removeArrEmpty($arr[$key]);
            } else {
                $value = trim($value);
                if ($value == '') {
                    unset($arr[$key]);
                } elseif ($trim) {
                    $arr[$key] = $value;
                }
            }
        }
        return $arr;
    }

    /**
     * 数组去掉重复值
     */
    public static function removeArrDuplicate($arr){
        $result=array();
        for($i=0;$i<count($arr);$i++){
            $source=$arr[$i];
            if(array_search($source,$arr)==$i && $source<>"" ){
                $result[]=$source;
            }
        }
        return $result;
    }

    /**
     * 数组根据字段进行排序
     */
    public static function arrSort($arr, $keys, $type = 'desc'){
        $key_value = $new_array = array();
        foreach ($arr as $k => $v) {
            $key_value[$k] = $v[$keys];
        }
        if ($type == 'asc') {
            asort($key_value);
        } else {
            arsort($key_value);
        }
        reset($key_value);
        foreach ($key_value as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }

    /**
     * 数组转为树形结构
     */
    public static function arrToTree($arr,$pk='id',$pid='parent_id',$child='_child',$root=0){
        // 创建Tree
        $tree=array();
        if(is_array($arr)){
            // 创建基于主键的数组引用
            $refer=array();
            foreach($arr as $key=>$data){
                $refer[$data[$pk]]=& $arr[$key];
            }
            foreach($arr as $key=>$data){
                // 判断是否存在parent
                $parentId=$data[$pid];
                if($root==$parentId){
                    $tree[]=& $arr[$key];
                }else{
                    if(isset($refer[$parentId])){
                        $parent=& $refer[$parentId];
                        $parent[$child][]=& $arr[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * 树形结构转为数组
     */
    public static function treeToArr($tree, $keyChildrens = 'childrens'){
        $ret = array();
        if (isset($tree[$keyChildrens]) && is_array($tree[$keyChildrens]))
        {
            foreach ($tree[$keyChildrens] as $child)
            {
                $ret = array_merge($ret, self::treeToArr($child, $keyChildrens));
            }
            unset($node[$keyChildrens]);
            $ret[] = $tree;
        }
        else
        {
            $ret[] = $tree;
        }
        return $ret;
    }

     /**
     * 数组转换对象
     */
    public static function arrToObj($arr){
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)self::arrToObj($v);
            }
        }
        return (object)$arr;
    }
}
