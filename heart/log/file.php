<?php


namespace heart\log;


use heart\conf;

class file
{
    public $log_path='';
    public function __construct()
    {
        $config_path=conf::get('log_path');
        $this->log_path=empty($config_path)?LOG_PATH:LOG_PATH.'/'.$config_path;
    }

    //文件中写入
    public function log($message,$file='log',$lerver='log'){
        $message="[".$lerver."]--".date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])."---".(!is_array($message)?$message:json_encode($message));
        $log_path=$this->log_path.'/'.date('Ym',$_SERVER['REQUEST_TIME']);
        if($file){
            $log_file=$log_path.'/'.$file.'_'.date('d',$_SERVER['REQUEST_TIME']).'.txt';
        }else{
            $log_file=$log_path.'/log_'.date('d',$_SERVER['REQUEST_TIME']).'.txt';
        }
        if(!is_dir($log_path)){
            mkdir($log_path,0777,true);
        }
        $f=fopen($log_file,'a');
        fwrite($f,$message."\r\n");
        fclose($f);
        return;
    }
}