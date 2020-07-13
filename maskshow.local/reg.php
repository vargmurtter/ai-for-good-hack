<?php

require_once "config.php";

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repeat_password'])){

	$email = $_POST['email'];
	$password = $_POST['password'];
	$r_password = $_POST['repeat_password'];

	if($password == $r_password){

		$users_res = $mysqli->query("SELECT COUNT(*) FROM `ms_users` WHERE `email`='$email'");

		$exist_user_count = $users_res->fetch_row()[0];

		if($exist_user_count == 0){

			$cached_pass = md5(sha1($password));
			$key = GUID();

			$insert_row = $mysqli->query("INSERT INTO `ms_users` (`email`, `password`, `api_key`) VALUES ('$email', '$cached_pass', '$key')");

			if($insert_row){
			    header("Location: login.php");
			}else{
			    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
			}

		}else{
			echo "User with this email is exist. <a href='index.php#login'>Back</a>";
		}

	}else{
		echo "You need to enter the same passwords. <a href='index.php#login'>Back</a>";

	}
}else{
	echo "Some of the fields are empty. <a href='index.php#login'>Back</a>";
}
?>