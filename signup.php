<?php
require_once("validator.php");

if(count($response->message) == 0):
	extract($_POST);
	$DB->exec("INSERT INTO users (full_name, email, phone, password) VALUES ('$fullName', {$DB->quote($email)}, $phone, {$DB->quote($_POST["passwd"])})");
	if($DB->errorCode() != 0):
		$response->message[] = "Server error insert";
	else:
		$response->status = "success";
		$response->message[] = "Regestered successfully";
	endif;
endif;

echo json_encode($response);