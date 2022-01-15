<?php

class Conn{
	private static $conn;
	public function getConn(){
		try{
			if(self::$conn == null){
				self::$conn = new PDO('mysql: host=localhost; dbname=desafio_ap_coders; charset=utf8', 'root', '');
			}
			return self::$conn;
		} catch (PDOException $e){
			return 'Error:'.$e->getMessage();
		}
	}
}