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
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="Map.js" type="text/javascript"></script>
<link href="Map.css" type="text/css" rel="stylesheet"/>
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
    <div id="map"></div>
	<div id= "choices">
		<form id= "filtration" action="get.php" method="POST">
		<h3>Choose Your Domain: </h3>
		<select name="domain" id="domain">
			<?php
			foreach($DB->query("SELECT name FROM domains") as $domain):
			?>
			<option value="<?= $domain["name"] ?>"><?= $domain["name"] ?></option>
			<?php endforeach; ?>
		</select>
		<h3>Requests Or Offers?</h3>
			<input type="radio" name="type" value="offers" checked="checked" />Offers
			<input type="radio" name="type" value="requests"/>Requests<br>
			<input type="submit" id="search" value="Search">
		</form>
	
	</div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK0cgP65JH_EJULHhIgbTRvAQZ81ZOxR4">
    </script>
	</div>
  </body>
</html>
