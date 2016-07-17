
<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/

//package - controllers/math.php


// A class which will display user infromation

class Users
{

	function main()
	{
		$model = routes::getModel('usersmodel');
		$model->getusers();
		routes::render('userlist');
	}
	function login()
	{
		if(isset($_POST['up'])) {
			if(empty($_POST['up'])||empty($_POST['uname'])) {
				$response['type']=0;
				$response['message']="Username or Password can't be empty";
			}
			else {
				$model = routes::getModel('usersmodel');
				if($model->IsValidUser($_POST['uname'],$_POST['up'])) {
					$response['type']=-1;
					$response['message']="http://localhost/mvcp/dashboard";
					session_start();
					$_SESSION['username']=$_POST['uname'];
				}
				else {
					$response['type']=0;
					$response['message']="Username or Password not valid";
				}
			}
			echo json_encode($response);
			die;
		}
		else
			routes::render('userlogin');
	}

	function forgotPassword() 
	{
		if(isset($_POST['em'])) {
			$email=$_POST['em'];
			$model = routes::getModel('usersmodel');
			if($id=$model->isEmailExist($email)) {
				//sendEmailForPasswordRecovery($email,$link);
				//echo md5(300*$id);die;
				$link='http://localhost/mvcp/users/reset-password?id='.md5(300*$id);
				//echo $link;die;
				$from='yaseensheikh.7777@gmail.com';
				$message="Please click on this link to reset your password ".$link;
				$headers = 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
				mail($email, 'Reset Password', $message,$headers);
				$response['type']=1;
				$response['message']='We have sent you an email with instructions to reset your password';
			}
			else {
				$response['type']=0;
				$response['message']='The email does not exist. Please make sure the email is correct';
			}
			echo json_encode($response);
			die;
		}
		else
			routes::render('forgotPassword');
	}

	function resetPassword() 
	{
		if(isset($_POST['pw1'])) {
			$pw=$_POST['pw1'];
			$id=$_GET['id'];
			$model = routes::getModel('usersmodel');
			if($db_id=$model->isEncryptedIdValid($id)) {
				$rows=$model->updatePassword($db_id,$pw);
				if($rows) {
					$response['type']=1;
					$response['message']='Your password has been reset. <a href="login" >Click here</a> to login';
				}
				else {
					$response['type']=0;
					$response['message']='Please try later';
				}
				
			}
			else {
				$response['type']=0;
				$response['message']='Please try later';
			}
			echo json_encode($response);
			die;
			
		}
		else if(isset($_GET['id'])) {
			$id=$_GET['id'];
			$model = routes::getModel('usersmodel');
			if($model->isEncryptedIdValid($id)) {
				routes::render('resetPassword');
			}
			else {
				echo "The link does not exist";
			}

		}
	}


}
?>