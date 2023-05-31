<?php 
namespace Sup\Utils;

class SupCurl{
    
    /**
     * 发送post请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $timeout 请求时间
     * @param  array $header 请求头
     * @param  bool $data_type 数据提交类型
     * @return array  $data   响应数据
    */
    public static function curlPost($url, $post_data = array(), $timeout = 30, $header = "", $data_type = ""){
        $header = empty($header) ? '' : $header;
        //支持json数据数据提交
        if($data_type == 'json'){
            $post_string = json_encode($post_data);
        }else if($data_type == 'array') {
            $post_string = $post_data;
        }else if(is_array($post_data)){
            $post_string = http_build_query($post_data, '', '&');
        }
        
        $ch = curl_init();    // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);     // 要访问的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查   // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        //curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($ch, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);     // Post提交的数据包
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // 获取的信息以文件流的形式返回 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //模拟的header头
        $result = curl_exec($ch);
     
        // 打印请求的header信息
        //$a = curl_getinfo($ch);
        //var_dump($a);
     
        curl_close($ch);
        return $result;
    
    }
    
    /**
     * 发送GET请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $timeout 请求时间
     * @param  array $header 请求头
     * @return array  $data   响应数据
    */
    public static function curlGet($url, $post_data = array(), $timeout = 30, $header = ""){
        $header = empty($header) ? '' : $header;
        $url=$url . '?' . http_build_query($post_data);
        
        $ch = curl_init();    // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);     // 要访问的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查   // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // 获取的信息以文件流的形式返回 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //模拟的header头
        $result = curl_exec($ch);
     
        // 打印请求的header信息
        //$a = curl_getinfo($ch);
        //var_dump($a);
     
        curl_close($ch);
        return $result;
    }
}

?>