<?php
require_once("validator.php");
if(!isset($_SESSION["id"])):
	header("Location: ./");
endif;




if(count($response->message) == 0):
	extract($_POST);
	$picName = "images/";

	if(isset($_FILES["profPic"]) && is_uploaded_file($_FILES["profPic"]["tmp_name"])):
		$picName = $picName."{$_SESSION["id"]}.jpg";
		move_uploaded_file($_FILES["profPic"]["tmp_name"], $picName);
	else:
		$picName = $picName.explode("/", $_SESSION["image"])[1];
	endif;
	$DB->exec("UPDATE users SET full_name='$fullName', email={$DB->quote($email)}, phone=$phone, password={$DB->quote($_POST["passwd"])}, image='$picName' WHERE id={$_SESSION["id"]}");
	if($DB->errorCode() != 0):
		$response->message[] = "Server error update";
	else:
		$_SESSION["full_name"] = $fullName;
		$_SESSION["email"] = $email;
		$_SESSION["phone"] = $phone;
		$_SESSION["image"] = $picName;
		$response->status = "success";
		$response->message[] = "Changed successfully";
	endif;
endif;

echo json_encode($response);