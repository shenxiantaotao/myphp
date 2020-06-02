<?php


namespace app\test\controller;


use app\test\model\tModel;
use heart\conf;
use heart\controller;
use heart\db\model;
use heart\log\log;

class test extends controller
{
    public function index(){
        echo '第一个控制器方法调用了';
        $m=new model('t1');
        //$r=$m->getAllFields();
        $r=$m->where(['ee'=>['like','%2']])->field('t,ee')->limit(1,12)->order('t DESC')->select();

        var_dump($r);
        echo $m->getLastSql();
//        echo json_encode($r->fetchAll());
//        $this->assign('data','shenxiantao');
//        $this->display('test/view/login.html');
//        $r=conf::all('config');
//        var_dump($r);
//        $r=new tModel();
//        if($r instanceof tModel){
//            echo 'yes';
//        }else{
//            echo 'no';
//        }
//
//        $r=(new tModel())->list();
//        var_dump($r);
//        log::log(['shen'=>123],'cache_log','error');
    }

}