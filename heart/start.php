<?php

namespace heart;
class start
{
    public static $class_map=[];//存储加载的类
    //启动路由方法
    static public function run(){
        $route=new route();
        $module=$route->module;
        $controller=$route->controller;
        $action=$route->action;
        $class_file=APP.'/'.$module.'/'.CONTROLLER.'/'.$controller.'.php';
        $class_action='\\'.APP_NAME.'\\'.$module.'\\'.CONTROLLER.'\\'.$controller;
        if(is_file($class_file)){
            include $class_file;
            (new $class_action())->$action();
        }
    }
    //自动加载方法
    static public function autoload($class){
        //判断是否已经加载过
        if(isset(self::$class_map[$class])){
            return true;
        }else{
            //没有加载的类,就包含进来
            $class_file=ROOT_DIR.'/'.str_replace('\\','/',$class).'.php';
            if(is_file($class_file)){
                include $class_file;
                self::$class_map[$class]=$class_file;
            }
        }
    }

}