<?php
//公共的函数文件
/**
 * 接口输出方法
 * @param string $result
 * @param int $code
 * @param string $message
 */
function R($result='',$code=0,$message=''){
    $arr=array(
        'code'=>$code,
        'message'=>$message,
        'result'=>$result
    );
   exit(json_encode($arr,256));
}


/**
 * 接收请求参数
 * @param string $param
 * @param string $method
 * @return mixed
 */
function Req($param='',$method=''){
    if(strtolower($method)=='get'){
        if(isset($_GET[$param])){
            return $_GET[$param];
        }else{
            return '';
        }
    }
    if(strtolower($method)=='post'){
         if(isset($_POST[$param])){
             return $_POST[$param];
         }else{
             return '';
         }
    }
    if(isset($_REQUEST[$param])){
        return $_REQUEST[$param];
    }else{
        return '';
    }
}

