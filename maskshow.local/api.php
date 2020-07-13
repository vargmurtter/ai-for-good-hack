<?php
	
	header("Content-Type: application/json");

	error_reporting(E_ERROR | E_PARSE);

	require_once "config.php";

	if(isset($_GET['key'])) $key = $_GET['key'];
	if(isset($_GET['img_url'])) $img_url = $_GET['img_url'];

	if(isset($key) && isset($img_url)){

		$key_res = $mysqli->query("SELECT COUNT(*) FROM `ms_users` WHERE `api_key`='$key'");

		$res = $key_res->fetch_row()[0];

		if($res == 1) {

			$url = $config['azure_endpoint_url'];

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"Url\": \"$img_url\"}"); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Prediction-Key: 9d1531f209b74bbb8e74a3fbdedbf892', 'Content-Type: application/json']); 

			$result = curl_exec ($ch);

			$data = json_decode($result, true);

			for ($i=0; $i < count($data["predictions"]); $i++) { 
				unset($data["predictions"][$i]['tagId']);
				unset($data["predictions"][$i]['tagName']);
			}

			echo json_encode(["result" => $data["predictions"]]);
		}else{
			echo json_encode(['result' => ['error' => 'incorrect key']]);
		}

	}else{

		echo json_encode(['result' => ['error' => 'some parameters are missing']]);

	}

?>