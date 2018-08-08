$(document).ready(function(){
	$("#login-trigger").click(function() {
		$(this).next("#login-content").slideToggle();
		$(this).toggleClass("active");
	});
	
	$("#signUpForm").submit(function(ev) {
		ev.preventDefault();
		$("#result").html("");
		var result ="";
		
		if(!/^[a-z]{2,}(\ [a-z]{2,})+$/i.test($("#fname").val())) {
			result +="<li>The name is too short or have invalid characters</li>";
		}
		
		if(!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i.test($("#email").val())) {
			result +="<li>Invalid email</li>";
		}
		
		if(!/^\d{8}$/.test($("#phone").val())) {
			result +="<li>The phone number must be 8 digits</li>";
		}
		
		if(!/(?=.*[^a-zA-Z\d])(?=.*[A-Z])(?=.*\d)(?=.*[a-z]).{8,16}/.test($("#passwd").val())) {
			result +="<li>The password must contain at least one uppercase, one lowercase, one digit and one symbol</li>";
		}
		
		if($("#passwd").val() != $("#pswRepeat").val()) {
			result +="</li>The passwords does not match</li>";
		}
		
		if(result == "") {
			$.ajax({
				type: "POST",
				url: "signup.php",
				data:  $("#signUpForm").serializeArray(), 
				success: function(data, status) {
					if(data.status == "success") {
						$("#username").val($("#email").val());
						$("#password").val($("#passwd").val());
						$("#login-trigger").click();
					}
					
					for(var i = 0; i < data.message.length; i++) {
						result += "<li>"+data.message[i]+"</li>";
					}
					
					$("#result").html(result);
				},
				error: function(xhr, textStatus, errorThrown){
					$("#result").html("<li>Error proccessing the request, Please try again</li>");
				}
			});
		}
		else {
			$("#result").html(result);
		}
	});
	
	$("#loginForm").submit(function(ev) {
		ev.preventDefault();
		$.ajax({
				type: "POST",
				url: "login.php",
				data:  $("#loginForm").serializeArray(), 
				success: function(data, status) {
					if(data.status == "success") {
						location.reload();
					}
					else {
						alert(data.message);
					}
				},
				error: function(xhr, textStatus, errorThrown){
					alert("Error proccessing the request, Please try again");
				}
		});
	});
});