window.onload=function(){
	initMap();
	$("#filtration").submit(function(e) {e.preventDefault(); initMap();});
}

function initMap() {
	$.getJSON('https://ipapi.co/json/', function(data) {
		var myLatLng = new google.maps.LatLng(data.latitude,data.longitude);
		var map = new google.maps.Map(document.getElementById("map"), {
			zoom: 10,
			center: myLatLng
		});
		var info = $("#filtration").serializeArray();
		$.ajax({
			type: "POST",
			url: "get.php",
			data:  info, 
			success: function(data, status) {
				if(data.status == "success") {
					for(var i = 0; i < data.message.length; i++) {
						var marker = new google.maps.Marker({
							position: {lat: parseFloat(data.message[i].lat), lng: parseFloat(data.message[i].lon)},
							map: map,
						});
						marker.id = data.message[i].id;
						marker.addListener("click", function() {
							window.open("view.php?type=" + info[1].value + "&id=" + this.id, "_blank");
						});
					}
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
	
}
