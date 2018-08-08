<?php
require_once("DB.php");
session_start();
header("Content-Type: application/json");
$response = new \stdClass();
$response->status = "fail";
$response->message = "";

if(!isset($_POST["username"], $_POST["password"])):
	$response->message[] = "Invalid request";
else:
	extract($_POST);
	
	$query = $DB->query("SELECT * FROM users WHERE email={$DB->quote($username)} AND password={$DB->quote($password)}");
	
	if($query->rowCount() == 0):
		$response->message = "Invalid credentials";
	else:
		$user = $query->fetch(PDO::FETCH_ASSOC);
		$_SESSION["id"] = $user["id"];
		$_SESSION["full_name"] = $user["full_name"];
		$_SESSION["email"] = $user["email"];
		$_SESSION["phone"] = $user["phone"];
		$_SESSION["image"] = $user["image"];
		$response->status = "success";
		$response->message = "Logged in successfully";
	endif;
endif;

echo json_encode($response);