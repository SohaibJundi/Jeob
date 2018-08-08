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

if(!isset($_REQUEST["type"], $_REQUEST["id"]) || ($_REQUEST["type"] != "offers" && $_REQUEST["type"] != "requests") || !preg_match("/\d+/", $_REQUEST["id"])):
	echo "Invaild request";
else:
	require_once("DB.php");
	$info = $DB->query("SELECT * FROM {$_REQUEST["type"]} WHERE id={$_REQUEST["id"]}")->fetch(PDO::FETCH_ASSOC);
	$user = $DB->query("SELECT id,full_name FROM users WHERE id={$info["user_id"]}")->fetch(PDO::FETCH_ASSOC);
	
	echo "Name: <a href=\"viewuser.php?id={$user["id"]}\">{$user["full_name"]}</a><br />";
	echo "Domain: ".$DB->query("SELECT name FROM domains WHERE id={$info["domain_id"]}")->fetch(PDO::FETCH_ASSOC)["name"]."<br />";
	echo "Experience: {$info["experience"]} years<br />";
	echo "Salary: {$info["salary"]}<br />";
	
	if($_REQUEST["type"] == "offers"):
		echo "Description: {$info["description"]}<br />";
	else:
		echo "Expectations: {$info["expectations"]}<br />";
		if($info["cv"] != ""):
			echo "CV: <a href=\"cvs/{$info["cv"]}.pdf\"> Click to view</a><br />";
		endif;
	endif;
endif;

?>
	</body>
</html>