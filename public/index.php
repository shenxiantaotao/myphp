<?php
/**
 * 1、入口文件
 * 2、定义常量
 * 3、加载函数库
 * 4、启动框架
 */
include '../define.php';
include '../heart/common/function.php';

include HERT.'/start.php';
spl_autoload_register('\heart\start::autoload');//自动加载类
\heart\start::run();

