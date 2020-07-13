<?php

require_once "config.php";

if(isset($_POST['email']) && isset($_POST['password'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){

		$email = $_POST['email'];
		$password = $_POST['password'];

		$cached_pass = md5(sha1($password));
		$users_res = $mysqli->query("SELECT COUNT(*) FROM `ms_users` WHERE `email`='$email' AND `password`='$cached_pass'");

		$exist_user_count = $users_res->fetch_row()[0];

		if($exist_user_count == 1){
			setcookie("email", $email, time()+3600*12);
			setcookie("key", md5(sha1($email)), time()+3600*12);
			header("Location: dashboard.php");
		}

	}else{
		echo "Some of the fields are empty. <a href='index.php#login'>Back</a>";
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : LawnLike 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131202

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mask Show</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><span class="fa fa-mask"></span><a href="#">Mask Show</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="#" accesskey="1" title="">Главная</a></li>
				<li><a href="#" accesskey="3" title="">О нас</a></li>
				<li><a href="#" accesskey="4" title="">Наши приемущества</a></li>
				<li><a href="#" accesskey="5" title="">Контакты</a></li>
				<li class="current_page_item"><a href="#login" accesskey="5" title="">Регистрация и Вход</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="wrapper">
	<div id="login" />
	<div id="featured-wrapper">
		<div id="featured" class="extra2 margin-btm container">
			<div class="main-title">
				<h2>Вход</h2>
			</div>
	
			<div>
				<form method="POST" action="login.php">
					<input class="vm-field" type="email" name="email" placeholder="E-mail" /><br />
					<input class="vm-field" type="password" name="password" placeholder="Password" /><br />
					<input class="button vm-button" type="submit" name="submit" value="Вход" />
					<p><a href="index.php#login">Регистрация</a></p>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Mask Show. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
</body>
</html>
