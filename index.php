<?php
session_start();
if(isset($_SESSION["id"])):
	header("Location: dashboard.php");
endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="test.css" type="text/css" rel="stylesheet" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<script src="index.js"></script>
	</head>
	<body>
		<div id="container">
			<nav class="topnav">
				<span id="siteName">Jeob</span>
				
				<span id="login">
					<a id="login-trigger" href="#">
						Log in
					</a>
					
					<div id="login-content">
						<form id="loginForm">
							<fieldset id="inputs">
								<input name="username" id="username" type="email" placeholder="Email" />
								<input name="password" id="password" type="password" placeholder ="password" />
							</fieldset>
							
							<fieldset id="actions">
								<input type="checkbox" id="remember" checked="checked"/>Remember me<br />
								<input type="submit" id="submit" value="Log in"/>
							</fieldset>
						</form>
					</div>                     
				</span>
			</nav>
			
			<div class="division1">
				<fieldset id="field2">
					<ul id="result">
						
					</ul>
					<h3>Sign up:</h3>
						<form id="signUpForm">
							<input name="fullName" id="fname" type="text" placeholder="Full Name" />
							<input name="email" id="email" type="email" placeholder="Email" />
							<input name="phone" id="phone" type="text" placeholder="phone number" />
							<input name="passwd" id="passwd" type="password" placeholder="password" />
							<input name="pswRepeat" id="pswRepeat" type="password" placeholder="Repeat Password" />
							<button name="signup" class="btnstyle" id="signup" type="submit">Sign up</button>
						</form>
				</fieldset>
			</div>
		</div>
	</body>
</html>