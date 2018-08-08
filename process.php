<?php
session_start();
if(!isset($_SESSION["id"])):
	header("Location: ./");
endif;

require_once("DB.php");

header("Content-Type: application/json");
$response = new \stdClass();
$response->status = "fail";
$response->message = [];

if(!isset($_POST["type"],$_POST["lon"], $_POST["lat"], $_POST["experience"], $_POST["salary"], $_POST["domain"], $_POST["description"])):
	$response->message[] = "Invalid request";
endif;

if(!preg_match("/^\d{1,3}(\.\d+)?$/", $_POST["lon"]) || !preg_match("/^\d{1,3}(\.\d+)?$/", $_POST["lat"])):
	$response->message[] = "Invalid coordinates";
endif;

if(!preg_match("/^\d+$/", $_POST["experience"])):
	$response->message[] = "Experience must be in years";
endif;

if(!preg_match("/\d+-\d+/", $_POST["salary"])):
	$response->message[] = "Salary must be a range (Form-To)";
endif;

if(count($response->message) == 0):
	extract($_POST);
	if(strtolower($_POST["type"]) == "offer"):
		$DB->exec("INSERT INTO offers (user_id, domain_id, longitude, latitude, experience, salary, description) VALUES ({$_SESSION["id"]}, (SELECT id FROM domains WHERE name={$DB->quote($domain)} LIMIT 1), $lon, $lat, $experience, '$salary', {$DB->quote($description)})");
		if($DB->errorCode() != 0):
			$response->message[] = "Invalid domian";
		else:
			$response->status = "success";
			$response->message[] = "Offer added successfully";
		endif;
	elseif(strtolower($_POST["type"]) == "request"):
		$hash = "";
		if(isset($_FILES["cv"]) && is_uploaded_file($_FILES["cv"]["tmp_name"])):
			$hash = sha1("$lon$lat$experience$salary$domain".file_get_contents($_FILES["cv"]["tmp_name"]).rand(-999999, 999999));
			move_uploaded_file($_FILES["cv"]["tmp_name"], "./cvs/$hash.pdf");
		endif;
		$DB->exec("INSERT INTO requests (user_id, domain_id, longitude, latitude, experience, salary, expectations, cv) VALUES ({$_SESSION["id"]}, (SELECT id FROM domains WHERE name={$DB->quote($domain)} LIMIT 1), $lon, $lat, $experience, '$salary', {$DB->quote($description)}, '$hash')");
		if($DB->errorCode() != 0):
			$response->message[] = "Invalid domian";
			unlink("./cvs/$hash.pdf");
		else:
			$response->status = "success";
			$response->message[] = "Request added successfully";
		endif;
	else:
		$response->message[] = "Invalid request";
	endif;
endif;

echo json_encode($response);