<?php


namespace heart\log;


use heart\conf;
use heart\log\file;

class log
{
    static $logclass;

    static private function init(){
        $driver = conf::get('log_driver');//获取配置的存储方式
        $logclass = '\heart\log\\' . $driver;
        if(empty(self::$logclass)){
            self::$logclass = new $logclass();
        }
    }
    /**
     * 写入日志方法
     * @param $name
     * @return bool
     */
    static function log($name,$file='',$lerver='log')
    {
        try{
            self::init();
            if (self::$logclass && conf::get('start_log')) {//判断日志是否开启
                self::$logclass->log($name,$file,$lerver);
            } else {
                throw new \Exception('没开启日志');
            }
        }catch (\Exception $e){
            return false;
        }

    }

}