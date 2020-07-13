<?php

require_once "config.php";

$api_key = "";

$email = $_COOKIE['email'];
$cookie_key = $_COOKIE['key'];
if(md5(sha1($email)) == $cookie_key){
	
	$users_res = $mysqli->query("SELECT * FROM `ms_users` WHERE `email`='$email'");
	$api_key = $users_res->fetch_row()[3];


}else{
	header("Location: login.php");
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
				<h2>Дашборд</h2>
			</div>
	
			<div>
				<p>Привет, <?=$email?>! Вот ваш API-ключ: </p>
				<p><b><?=$api_key?></b></p>
				<br />
				<p>Как пользоваться API:</p>
				<p>Отправьте GET-запрос на адрес <b><?=$_SERVER['HTTP_HOST']?>/api.php?key=<?=$api_key?>&img_url={IMAGE_URL}</b></p>
			</div>
		</div>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Mask Show. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
</body>
</html>
