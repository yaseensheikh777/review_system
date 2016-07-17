<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/

//package - app/models/usermodel.php

//This is used to intereact with database

class usersmodel{

	function getusers()
	{
		$pdo = routes::getInstance('pdo');
		$stmt = $pdo->query("SELECT * FROM customers");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//$result=$pdo->execute();
		//print_r($result);die;
		$basket = routes::getInstance('basket');
		$basket->set('data',$result);
		 // foreach ($result as $value) 
		 // 	$basket->set($value['Id'],$value['username']);
		
	}
	
	
	function getWall()
	{
		$pdo = KITE::getInstance('pdo');
		$stmt = $pdo->query("SELECT * FROM wall ORDER BY id desc");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$basket = KITE::getInstance('basket');
		foreach ($result as $key => $value)
		$basket->set($key,$value);

		
	}
	
	function postMessage()
	{
		$request = KITE::getInstance('request');
		
		$name = $request->get('name');
		$message = $request->get('message');
		
		$pdo = KITE::getInstance('pdo');
		$pdo->exec("INSERT INTO wall(name,message) VALUES('$name','$message')");
		
	}

	function IsValidUser($username,$password) {
		$pdo = routes::getInstance('pdo');
		$query="SELECT Id FROM customers WHERE username=:user AND password=:pass ";
		$pre_query=$pdo->prepare($query);
		$pre_query->bindParam(':user', $username, PDO::PARAM_STR);
		$pre_query->bindParam(':pass', $password, PDO::PARAM_STR);
		$pre_query->execute();
		$result=$pre_query->fetchAll(PDO::FETCH_ASSOC);
		if(sizeof($result)>0) {
			//print_r($result[0]['Id']);die;
			return $result[0]['Id'];
		}
		else 
			return false;
		//print_r();die;
	}

	function isEmailExist($email) {
		$pdo = routes::getInstance('pdo');
		$query="SELECT Id FROM customers WHERE email=:email ";
		$pre_query=$pdo->prepare($query);
		$pre_query->bindParam(':email', $email, PDO::PARAM_STR);
		$pre_query->execute();
		$result=$pre_query->fetchAll(PDO::FETCH_ASSOC);
		if(sizeof($result)>0) {
			//echo $result['id'];die;
			return $result[0]['Id'];
		}
		else 
			return false;
	}

	function isEncryptedIdValid($id) {
		$pdo = routes::getInstance('pdo');
		$query="SELECT Id FROM customers WHERE md5(300*Id)=:id ";
		$pre_query=$pdo->prepare($query);
		$pre_query->bindParam(':id', $id, PDO::PARAM_INT);
		$pre_query->execute();
		$result=$pre_query->fetchAll(PDO::FETCH_ASSOC);
		if(sizeof($result)>0) {
			//echo $result[0]['Id'];die;
			return $result[0]['Id'];
		}
		else 
			return false;
	}

	function updatePassword($id,$password) {
		$pdo = routes::getInstance('pdo');
		$query="UPDATE customers SET password=:pass WHERE Id=:id ";
		$pre_query=$pdo->prepare($query);
		$pre_query->bindParam(':pass', $password, PDO::PARAM_STR);
		$pre_query->bindParam(':id', $id, PDO::PARAM_INT);
		$pre_query->execute();
		return $pre_query->rowCount();

	}

}
?>