<?php
session_start();
if(!isset($_SESSION["id"])):
	header("Location: ./");
endif;

require_once("DB.php");

?>
<!DOCTYPE html>
<html>
<head>

<link href="dashboard.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="dashboard.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
	<div class="topnav" id="myTopnav">
		<a href="index.php">Login</a>
		<a href="dashboard.php">Dashboard</a>
		<a href="settings.php">Settings</a>
		<a href="map.php">Map</a>
		<a href="signout.php">Signout</a>
		<h3>Jeob</h3>
	</div>
	<div id="cont2">
		<form id="specifications">
		<h3>Choose Your Domain: </h3>
		<select id="domain">
			<?php
			foreach($DB->query("SELECT name FROM domains") as $domain):
			?>
			<option value="<?= $domain["name"] ?>"><?= $domain["name"] ?></option>
			<?php endforeach; ?>
		</select> <br>
		<label>Location: </label><br>
		<input type="text" name="lon" id="lon" placeholder="Longitude" /><br>
		<input type="text" name="lat" id="lat" placeholder="latitude" /><br>
		</form>
	<div id="offer">
		<button id ="make">Make Offer</button>
		<div id= "modal1">
			<form id="offerConditions">
				<label>Experience: </label><br><input name="experience" id="experience" type="text" placeholder="experience"/><br>
				<label>Salary: </label><br><input name= "salary" id="salary" type="text" placeholder="salary"/><br>
				<label>Job Description: </label><br><textarea name= "description" id="description" cols="30" rows="4" ></textarea><br>
				<input type="submit" name="submitOffer" id="submitOffer" class="btns" value ="post offer"/>
				<input type="hidden" name="type" value="offer" />
				<input type="hidden" name="lon" id="olon" />
				<input type="hidden" name="lat" id="olat" />
				<input type="hidden" name="domain" id="odomain" />
			</form>
		</div>

	</div>
	<div id= "req">
		<button id= "request"> Request</button> 
		<div id= "modal2">
		<form method="POST" action="process.php" id="requestConditions"  enctype="multipart/form-data">
			<label>Experience: </label><br><input name="experience" id="Experience" type="text"/><br>
			<label>Salary: </label><br><input name="salary" id="Salary" type="text"/><br>
			<label>Expectations: </label><br><textarea name= "description" id="expectations" cols="30" rows="4" ></textarea><br>
			<label>CV: </label><br><input type="file" name="cv" id="cv" accept=".pdf"/><br>
			<input type="submit" name="submitOffer" id="submitOffer" class="btns" value="post request"/>
				<input type="hidden" name="type" value="request" />
				<input type="hidden" name="lon" id="rlon" />
				<input type="hidden" name="lat" id="rlat" />
				<input type="hidden" name="domain" id="rdomain" />
		</form>
		</div>
	</div>
	</div>
	<h3>Click on the map to select location</h3>
	<div id="map"></div>
	<div id="offers"><h3>your job offers are:</h3>
	<ul>
	<?php
	foreach($DB->query("SELECT id FROM offers WHERE user_id={$_SESSION["id"]}")->fetchAll(PDO::FETCH_ASSOC) as $offer):
	?>
		<li>Offer id - <?= $offer["id"] ?></li>
	<?php endforeach; ?>
	</ul>
	</div> <br>
	<div id="requests"><h3>your job requests are:</h3>
	<ul>
	<?php
	foreach($DB->query("SELECT id FROM requests WHERE user_id={$_SESSION["id"]}")->fetchAll(PDO::FETCH_ASSOC) as $request):
	?>
		<li>Request id - <?= $request["id"] ?></li>
	<?php endforeach; ?>
	</ul>
	</div>
</div>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK0cgP65JH_EJULHhIgbTRvAQZ81ZOxR4">
    </script>
</body>
</html>