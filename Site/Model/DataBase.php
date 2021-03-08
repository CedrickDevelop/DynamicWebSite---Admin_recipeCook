<?php

namespace site\model;
use PDO;

Class Database{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;


    public function __construct($db_name = ''.DBNAME.'', $db_user = ''.CNX_LOGIN.'', $db_pass = ''.CNX_PASS.'', $db_host = ''.HOST.'' ){
        $this->$db_name = $db_name;
        $this->$db_user = $db_user;
        $this->$db_pass = $db_pass;
        $this->$db_host = $db_host;
    }

    private function setPDO(){
        //if ($this->pdo === null){
            try {
                $pdo = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', ''.CNX_LOGIN.'', ''.CNX_PASS.'');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            } catch (Throwable $t){
                echo 'Problème erreur '.$t->getMessage();
            } catch (Exception $e){
                echo 'Problème exception'.$e->getMessage();
            }


    }

    public function getPDO(){
        return $this->pdo;
    }

}

