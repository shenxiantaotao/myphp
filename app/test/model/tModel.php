<?php


namespace app\test\model;


class tModel extends \heart\db\model
{
    public $table='t1';
    public function list(){
        $sql='select * from '.$this->table;
        $r=$this->query($sql);
        return $r->fetchAll();
    }

}