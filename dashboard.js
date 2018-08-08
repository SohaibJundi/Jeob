$(document).ready(function(){
	$('#make').click(function(){
		$(this).next('#modal1').slideToggle();
		$(this).toggleClass('active');          
	});

	$("#request").click(function(){
		$(this).next('#modal2').slideToggle();
		$(this).toggleClass('active');          
	});
	
	initMap();
	$('#cv').on( 'change', function() {
		var ext = $(this).val().split('.').pop();
		if(ext != "pdf") {
			$(this).val("");
			alert("File must be in pdf format");
		}
	});
	
	$("#offerConditions").submit(function(ev) {
		ev.preventDefault();
		$("#olon").val($("#lon").val());
		$("#olat").val($("#lat").val());
		$("#odomain").val($("#domain").val());
		$.ajax({
				type: "POST",
				url: "process.php",
				data:  $("#offerConditions").serializeArray(), 
				success: function(data, status) {
					if(data.status == "success") {
						alert("offer added successfully");
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
	
	$("#requestConditions").submit(function(ev) {
		ev.preventDefault();
		$("#rlon").val($("#lon").val());
		$("#rlat").val($("#lat").val());
		$("#rdomain").val($("#domain").val());
		var formData = new FormData(this);

		$.ajax({
			url: "process.php",
			type: "POST",
			data: formData,
			success: function(data, status) {
				if(data.status == "success") {
					alert("request added successfully");
				}
				else {
					alert(data.message);
				}
			},
			error: function(xhr, textStatus, errorThrown){
				alert("Error proccessing the request, Please try again");
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
});

function initMap() {
	var marker = false;
	$.getJSON('https://ipapi.co/json/', function(data) {
		var myLatLng = new google.maps.LatLng(data.latitude,data.longitude);
		var map = new google.maps.Map(document.getElementById("map"), {
			zoom: 10,
			center: myLatLng
		});
		google.maps.event.addListener(map, 'click', function(event) {                
			//Get the location that the user clicked.
			var clickedLocation = event.latLng;
			//If the marker hasn't been added.
			if(marker === false){
				//Create the marker.
				marker = new google.maps.Marker({
					position: clickedLocation,
					map: map,
					draggable: true //make it draggable
				});
				//Listen for drag events!
				google.maps.event.addListener(marker, 'dragend', function(event){
					markerLocation();
				});
			} else{
				//Marker has already been added, so just change its location.
				marker.setPosition(clickedLocation);
			}
			//Get the marker's location.
			var currentLocation = marker.getPosition();
			//Add lat and lng values to a field that we can save.
			document.getElementById('lat').value = currentLocation.lat(); //latitude
			document.getElementById('lon').value = currentLocation.lng(); //longitude
		});

	});
}