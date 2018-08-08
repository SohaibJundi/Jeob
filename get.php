<?php

require_once("DB.php");
header("Content-Type: application/json");
$response = new \stdClass();
$response->status = "fail";
$response->message = [];

if(!isset($_POST["type"], $_POST["domain"]) || (strtolower($_POST["type"]) != "requests" && strtolower($_POST["type"]) != "offers")):
	$response->message[] = "Invalid request";
else:
	$data = $DB->query("SELECT id,longitude,latitude FROM {$_POST["type"]} WHERE domain_id=(SELECT id FROM domains WHERE name={$DB->quote($_POST["domain"])})")->fetchAll(PDO::FETCH_ASSOC);
	$response->status = "success";
	for($i = 0; $i < count($data); $i++):
		$response->message[$i] = new \stdClass();
		$response->message[$i]->lon = $data[$i]["longitude"];
		$response->message[$i]->lat = $data[$i]["latitude"];
		$response->message[$i]->id = $data[$i]["id"];
	endfor;
endif;

echo json_encode($response);