<?php
session_start();
if(!isset($_SESSION["id"])):
	header("Location: ./");
endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script src="settings.js" type="text/javascript"></script>
		<link href="settings.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<div id="container">
			<div class="topnav" id="myTopnav">
				<a href="index.php">Login</a>
				<a href="dashboard.php">Dashboard</a>
				<a href="settings.php">Settings</a>
				<a href="map.php">Map</a>
				<a href="signout.php">Sign out</a>
				<h3>Jeob</h3>
			</div>

			
		</div>

		<fieldset id="field2">
			<ul id="result">
						
			</ul>
			<h3>Update your personal information: </h3>
			<form id="settingsForm"  enctype="multipart/form-data" action="update.php">
				<a href="#" class="profile-pic">
					<div class="profile-pic" id="pro" style="background-image: url('<?= $_SESSION["image"] ?>')">
						<span id="updateProfile">Change Image</span>
						<input name="profPic" id="profPic" class="file-upload" type="file" accept="image/*"/>
					</div>
				</a>
				<input name="fullName" id="fname" type="text" placeholder="Full Name" value="<?= $_SESSION["full_name"] ?>" /> <br>
				<input name="email" id="email" type="email" placeholder="Email" value="<?= $_SESSION["email"] ?>" /> <br>
				<input name="phone" id="phone" type="text" placeholder="phone number" value="<?= $_SESSION["phone"] ?>" /> <br>
				<input name="passwd" id="passwd" type="password" placeholder="password" /> <br>
				<input name="pswRepeat" id="pswRepeat" type="password" placeholder="Repeat Password"/> <br>
				
				<div class="buttons">
					<input name="change" class="btnstyle" id="change" type="submit" value="Submit changes" />
					<input name="discard" class="btnstyle" id="discard" type="reset" value="Discard changes"/>
				</div>
			</form>
		</fieldset>

		</div>
	</body>
</html>