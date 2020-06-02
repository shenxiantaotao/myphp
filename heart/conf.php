<?php


namespace heart;
//获取配置文件信息

class conf
{
    static public $config=[];

    //获取单个配置项
    static public function get($name,$file=''){
        $config=self::$config;
        if(empty($file)){
            $file='config';
            $file_path=APP_CONFIG;
        }else{
            $file_path=APP.'/'.$file.'.php';
        }
        try{
            //判断是否已经存在配置了
            if(!empty($config)&&isset($config[$file][$name])){
                return $config[$file][$name];
            }else{
                //没有加载过配置时
                if(is_file($file_path)){
                    $conf=include $file_path;
                    self::$config[$file]=$conf;
                    if(isset(self::$config[$file][$name])){
                        return $conf[$name];
                    }else{
                        throw new \Exception('没有该配置项'.$name);
                    }
                }else{
                    throw new \Exception('配置文件路径不推'.$file_path);
                }
            }
        }catch (\Exception $e){
            return '';
        }
    }

    //获取所有配置
    static function all($file){
        $config=self::$config;
        if(empty($file)){
            $file='config';
            $file_path=APP_CONFIG;
        }else{
            $file_path=APP.'/'.$file.'.php';
        }
        try{
            //判断是否已经存在配置了
            if(!empty($config)&&isset($config[$file])){
                return $config[$file];
            }else{
                //没有加载过配置时
                if(is_file($file_path)){
                    $conf=include $file_path;
                    self::$config[$file]=$conf;
                    if(isset(self::$config[$file])){
                        return $conf;
                    }else{
                        throw new \Exception('没有该配置文件');
                    }
                }else{
                    throw new \Exception('配置文件路径不推'.$file_path);
                }
            }
        }catch (\Exception $e){
            return '';
        }
    }
}