<?php

namespace heart;
//路由文件
class route
{
    public $module='index';//模块
    public $controller='index';//控制器
    public $action='index';//方法
    public function __construct()
    {
        if(isset($_SERVER['REDIRECT_URL'])&&$_SERVER['REDIRECT_URL']!='/'){
            $url=explode('/',trim($_SERVER['REDIRECT_URL'],'/'));
            //解析出模块名
            if(isset($url[0])){
                $this->module=$url[0];
                unset($url[0]);
            }
            //解析出控制器名
            if(isset($url[1])){
                $this->controller=$url[1];                unset($url[0]);
                unset($url[1]);
            }
            //解析出方法名
            if(isset($url[2])){
                $this->action=$url[2];
                unset($url[2]);
            }
            //解析出参数,存入GET
            $n=count($url)+3;
            $i=3;
            while ($i<$n){
                if(isset($url[$i+1])){
                    $_GET[$url[$i]]=$url[$i+1];
                }
                $i=$i+2;
            }
        }
    }



}