
$(document).ready(function() {
    var change = function(inp) {
        if (inp.files && inp.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
			   $('.profile-pic').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(inp.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        change(this);
    });
    
    $("#updateProfile").on('click', function() {
       $("#profPic").click();
    });
	
	$("#settingsForm").submit(function(e) {
		e.preventDefault();    
		var formData = new FormData(this);
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
				url: "update.php",
				type: "POST",
				data: formData,
				success: function (data) {
					for(var i = 0; i < data.message.length; i++) {
						result += "<li>"+data.message[i]+"</li>";
					}
					
					$("#result").html(result);
				},
				error: function(xhr, textStatus, errorThrown){
					$("#result").html("<li>Error proccessing the request, Please try again</li>");
				},
				cache: false,
				contentType: false,
				processData: false
			});
		}
		else {
			$("#result").html(result);
		}
	});
});