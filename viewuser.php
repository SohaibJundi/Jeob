<!DOCTYPE html>

<html>
	<head>
		<title>View</title>
		<style>
			body {
				background-color: black;
				color: white;
			}
		</style>
	</head>
	
	<body>
<?php

if(!isset($_REQUEST["id"]) || !preg_match("/\d+/", $_REQUEST["id"])):
	echo "Invaild request";
else:
	require_once("DB.php");
	$info = $DB->query("SELECT full_name,email,phone FROM users WHERE id={$_REQUEST["id"]}")->fetch(PDO::FETCH_ASSOC);
	
	echo "Name: {$info["full_name"]}<br />";
	echo "Email: {$info["email"]}<br />";
	echo "Phone: {$info["phone"]}<br />";
endif;
?>
	</body>
</html>