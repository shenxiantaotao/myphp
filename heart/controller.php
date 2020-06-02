<?php


namespace heart;
//控制器方法

class controller
{
    public $assign=[];

    //输出视图变量
    public function assign($name,$value=''){
        $this->assign[$name]=$value;
    }

    //输出视图界面，带变量
    public function display($file){
        $file=APP.'/'.$file;
        if(is_file($file)){
            extract($this->assign);
            include $file;
        }
    }

}