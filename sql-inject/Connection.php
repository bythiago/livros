<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('Util.php');

class ConnectDb extends Util {

	private static $instance = null;
  	private $conn;

    private function __construct()
    {
			try {
    		//$this->conn = new PDO('sqlite:livros.sqlite');
        $this->conn = new PDO('mysql:host=127.0.0.1;dbname=agenda','root','root');
			} catch(Exception $exception) {
				var_dump($exception->getMessage());
				exit();
			}
  	}

    private function __clone(){}
    private function __wakeup(){}

	public static function _connection()
	{
    	if(!self::$instance){
      		self::$instance = new ConnectDb();
    	}

    	return self::$instance;
    }

  	public function findAll($query){
  		return ConnectDb::_connection()->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
  	}

  	public function findLikeBy($query, Array $params){
  		try {
	  		$sth = ConnectDb::_connection()->conn->prepare($query);

	  		foreach ($params as $key => $param) {
					$sth->bindParam(":$key", $param);
	  		}

	  		$sth->execute();
	  		return $sth->fetchAll(PDO::FETCH_ASSOC);
  		} catch(\Exception $e){
  			exit($e->getMessage());
  		}

  	}
}

require("conteudo.php");

//links uteis
//https://www.php.net/manual/pt_BR/pdo.transactions.php
//https://www.binarytides.com/sqlmap-hacking-tutorial/

//comandos
// ./sqlmap.py -u http://localhost/t/Connection.php?id=1 --dbs
// ./sqlmap.py -u http://localhost/t/Connection.php?id=1 -D agenda_2019 --tables
// ./sqlmap.py -u http://localhost/t/Connection.php?id=1 -D agenda_2019 -T contato --columns 
// ./sqlmap.py -u http://localhost/t/Connection.php?id=1 -D agenda_2019 -T contato -C nome --dump 
// ./sqlmap.py -u http://localhost/t/Connection.php?id=1 -D agenda_2019 -T contato --dump-all