<?php 
include 'config/functions.php';

$myfunc = new functions();



if (isset($_POST['submit'])) {
	$myfunc->pesan_add($_POST);
} elseif ( isset($_POST['origins']) ) {
	echo json_encode($myfunc->get_distance($_POST['origins'],$_POST['destinations']));
	die;
}

include 'templates/header.php';

?>
<script>
	// AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4
	var kelas = $("#kelas").val();
	var maps_data = 0;

	console.log(document.getElementById("catas").value);

	setInterval(function(){
		// console.log(kelas);
		// console.log(maps_data);
		if ( kelas != 0 && maps_data != 0 ) {
			console.log(1);
			console.log(kelas);
			if ( kelas == "economy" ) {
				$("#biaya").val(maps_data.price.economy);
			} else if ( kelas == "business" ) {
				$("#biaya").val(maps_data.price.business);
			} else if ( kelas == "exclusive" ) {
				$("#biaya").val(maps_data.price.exclusive);
			}
		}
	},1000);

	function mapInitialize() {
		var propertiPeta = {
			center:new google.maps.LatLng(-6.2251205,106.848388),
			zoom:5,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var peta = new google.maps.Map(document.getElementById("map-box"), propertiPeta);

	}
	google.maps.event.addDomListener(window, 'load', mapInitialize);

	function autocompleteTextbox() {
		var input1 = document.getElementById('titikjemput');
		var autocomplete1 = new google.maps.places.Autocomplete(input1);

		var input2 = document.getElementById('titikantar');
		var autocomplete2 = new google.maps.places.Autocomplete(input2);
	}
	google.maps.event.addDomListener(window, 'load', autocompleteTextbox);

	function getcoordinates() {
		var peta;
		var coordinateJemput = 0;
		var coordinateAntar = 0;

		var input1 = document.getElementById('titikjemput');
		var autocomplete1 = new google.maps.places.Autocomplete(input1);
		google.maps.event.addListener(autocomplete1, 'place_changed', function () {
		    var place = autocomplete1.getPlace();
		    var lat = place.geometry.location.lat();
		    var lng = place.geometry.location.lng();
			coordinateJemput = lat + "," + lng;

			var propertiPeta = {
				center:new google.maps.LatLng(lat,lng),
				zoom:15,
				mapTypeId:google.maps.MapTypeId.ROADMAP
			};

			peta = new google.maps.Map(document.getElementById("map-box"), propertiPeta);

			var marker=new google.maps.Marker({
				position: new google.maps.LatLng(lat,lng),
				map: peta,
				icon: "assets/img/titikjemput.png"
			});

			if ( coordinateAntar != 0 ) {
				$.ajax({
					url : "<?= $myfunc->baseurl ?>pesan.php",
					data : { origins : coordinateJemput, destinations : coordinateAntar },
					type : "post",
					dataType : "json",
					success : function(data) {
						$("#jarak").val(data.distance);
						maps_data = data;
					}
				});
			}
		});

		var input2 = document.getElementById('titikantar');
		var autocomplete2 = new google.maps.places.Autocomplete(input2);
		google.maps.event.addListener(autocomplete2, 'place_changed', function () {
		    var place = autocomplete2.getPlace();
		    var lat = place.geometry.location.lat();
		    var lng = place.geometry.location.lng();
			coordinateAntar = lat + "," + lng;

			var marker=new google.maps.Marker({
				position: new google.maps.LatLng(lat,lng),
				map: peta,
				icon: "assets/img/titikantar.png"
			});

			if ( coordinateJemput != 0 ) {
				$.ajax({
					url : "<?= $myfunc->baseurl ?>pesan.php",
					data : { origins : coordinateJemput, destinations : coordinateAntar },
					type : "post",
					dataType : "json",
					success : function(data) {
						$("#jarak").val(data.distance);
						maps_data = data;
					}
				});
			}
		});

	}
	google.maps.event.addDomListener(window, 'load', getcoordinates);

	
</script>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form method="post" action="">
			<div class="form-group">
				<label><b>Titik Penjemputan : </b></label>
				<input class="form-control" required type="text" name="titikjemput" id="titikjemput">
			</div>
			<div class="form-group">
				<label><b>Titik Pengantaran : </b></label>
				<input class="form-control" required type="text" name="titikantar"  id="titikantar">
			</div>
			<div class="form-group">
				<label><b>Jarak : </b></label>
				<input class="form-control" readonly type="text" name="jarak" value="0" id="jarak">
			</div>
			<div class="form-group">
				<label><b>Tanggal Penjemputan : </b></label>
				<input class="form-control" required type="date" name="tglpenjemputan">
			</div>
			<div class="form-group">
				<label><b>Waktu Penjemputan : </b></label>
				<input class="form-control" required type="time" name="waktupenjemputan">
			</div>
			<div class="form-group">
				<label><b>Kelas Mobil : </b></label>
				<select class="form-control" required name="kelasmobil" id="cmbkelas">
					<option value="0">-</option>
					<option value="economy">Economy</option>
					<option value="business">Business</option>
					<option value="exclusive">Exclusive</option>
				</select>
			</div>
			<div class="form-group">
				<label><b>Catatan untuk Driver : </b></label>
				<input class="form-control" required type="text" name="note" value="asdasdas" id="catas">
			</div>
			<div class="form-group">
				<label><b>No Telpon : </b></label>
				<input class="form-control" required type="text" name="notelp">
			</div>
			<div class="form-group">
				<label><b>Email : </b></label>
				<input class="form-control" required type="text" name="email">
			</div>
			<div class="form-group">
				<label><b>Tarif : </b></label>
				<input class="form-control" readonly type="number" name="biaya" value="0" id="biaya">
			</div>
			<div class="form-group">
				<button class="btn btn-outline-success rounded-pill form-control" required type="submit"
				name="submit">Pesan Sekarang</button>
			</div>
		</div>
		<div class="col-md-6">
		  <div id="map-box" style="width:100%;height:710px;"></div>
		</div>
	</div>
</div>
