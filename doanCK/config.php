<?php
session_start();
class Provider{
	private $db = null;
	# Khoi tao ket noi pdo
	function __construct($dbName = 'mxhdoan', $user = 'root', $password=''){
		try{
			$this->db = new PDO("mysql:host=localhost;dbname=$dbName", $user, $password);
			$this->db->exec("set names utf8");
		}
		catch(\Exception $e){
			echo $e -> getMessage();
			die;
		}
	}
	#Provider
	function ExecuteQuerry($sql, $data=[]){
		$sttm = $this->db->prepare($sql);
		return $sttm->execute($data);
	}
	function ExecuteNonQuerry($sql,$data=[]){
		$this->sttm = $this->db->prepare($sql);
		for($i = 1; $i <= count($data);$i++)
		{
			$this->sttm->bindValue($i,$data[$i-1]);
		}
		return $this->sttm->execute();
	}
	//for Select 1 row
	function Load($sql, $data=[]){
		$check = $this->ExecuteNonQuerry($sql,$data);
		if($check)
		{
			return $this->sttm->fetch(PDO::FETCH_OBJ);
		}
		return false;
	}
	//for select > 1 row
	function LoadMore($sql,$data=[]){
		$check = $this->ExecuteNonQuerry($sql,$data);
		if($check)
		{
			return $this->sttm->fetchAll(PDO::FETCH_OBJ);
		}
		return false;
	}
}
?>