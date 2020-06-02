<?php
//数据库配置
$database=[
    'DB_HOST'=>'127.0.0.1',
    'DB_PORT'=>'3306',
    'DB_NAME'=>'test',
    'DB_USERNAME'=>'root',
    'DB_PASSWORD'=>'',
    'DB_OPTIONS'=>null
];

return array(
    'database'=>$database,//数据库配置
    'debug'=>true, //调试模式
    'log_driver'=>'file',//日志存储方式
    'start_log'=>true,//配置是否开启日志
    'log_path'=>'',//配置runlog下的日志文件夹路径
);