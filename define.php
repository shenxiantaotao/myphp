<?php
//define('ROOT_DIR',$_SERVER['DOCUMENT_ROOT']);
include 'heart/conf.php';

define('ROOT_DIR',str_replace('\\','/',__DIR__));
define('APP_NAME','app');
define('APP',ROOT_DIR.'/'.APP_NAME);//应用路径
define('HERT',ROOT_DIR.'/heart');//核心类库文件夹
define('PUBLIC',ROOT_DIR.'/public');//外部访问文件夹
define('CONTROLLER','controller');//控制器存放目录名
define('APP_CONFIG',APP.'/config.php');//应用配置目录文件
define('LOG_PATH',ROOT_DIR.'/runlog');//日志存放目录
//调试模式
define('DEBUG',true);//调试模式
$debug=\heart\conf::get('debug');
if(DEBUG&&$debug){
    ini_set('display_errors',1);//输出错误到屏幕
}else{
    ini_set('display_errors',0);//关闭错误输出到屏幕
}
