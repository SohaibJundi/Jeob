<?php
require_once("DB.php");

$querySuffix = "";
session_start();

if(isset($_SESSION["id"])):
	$querySuffix = " AND id<>".$_SESSION["id"];
endif;

header("Content-Type: application/json");
$response = new \stdClass();
$response->status = "fail";
$response->message = [];
		
if(!isset($_POST["fullName"], $_POST["email"], $_POST["phone"], $_POST["passwd"], $_POST["pswRepeat"])):
	$response->message[] = "Invalid request";
else:
	if(!preg_match("/^[a-z]{2,}(\ [a-z]{2,})+$/i", $_POST["fullName"])):
		$response->message[] = "The name is too short or have invalid characters";
	endif;
	
	if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)):
		$response->message[] = "Invalid email";
	endif;
	
	if(!preg_match("/^\d{8}$/", $_POST["phone"])):
		$response->message[] = "The phone number must be 8 digits";
	endif;
	
	if(!preg_match("/(?=.*[^a-zA-Z\d])(?=.*[A-Z])(?=.*\d)(?=.*[a-z]).{8,16}/", $_POST["passwd"])):
		$response->message[] = "The password must contain at least one uppercase, one lowercase, one digit and one symbol";
	endif;
	
	if($_POST["passwd"] != $_POST["pswRepeat"]):
		$response->message[] = "The passwords does not match";
	endif;
	
	$emailExists = false;
	$phoneExists = false;
	
	$sameEmailOrPhone = $DB->query("SELECT email, phone FROM users WHERE (email={$DB->quote($_POST["email"])} OR phone={$_POST["phone"]})$querySuffix");
	
	if($sameEmailOrPhone):
		foreach($sameEmailOrPhone as $row):
			if(!$emailExists && ($row["email"] == $_POST["email"])):
				$response->message[] = "Email number already exists";
			endif;
			if(!$phoneExists && ($row["phone"] == $_POST["phone"])):
				$response->message[] = "Phone number already exists";
			endif;
			if($emailExists && $phoneExists):
				break;
			endif;
		endforeach;
	endif;
	
	if(count($response->message) == 0):
		if(!$sameEmailOrPhone):
			$response->message[] = "Server error select";
		endif;
	endif;
endif;