<?php

include 'templates/header.php';




$destinations = $myfunc->get_destinations();

if (isset($_POST['submit'])) {
	$myfunc->pesan_add($_POST);
}


?>
<br><br>
<div class="container mb-5">
	<div class="row">
		<div class="col-md-6">

			<!-- <button class="btn btn-success rounded-pill mb-3" id="btnAddDestination" data-toggle="modal" data-target="#destinationmodal">Add more Destinations</button> -->
			
			<!-- <div id="destinationsarea">
			</div> -->
			
			<form method="post" action="" id="frmorder">
				<div class="form-group">
					<label><b>Pickup :</b></label>
					<select class="form-control" name="jemput" id="cmbpickup">
						<option value="0">--- Choose One ---</option>
						<?php foreach ($destinations as $destination): ?>
							<option value="<?= $destination ?>"><?= $destination ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label><b>Destination :</b></label>
					<select class="form-control" name="antar" id="cmbdestination" disabled>
						<option value="0">--- Choose One ---</option>
					</select>
				</div>
				<div class="form-group">
	        		<label>Date of Departure</label>
	        		<input class="form-control" required type="date" name="tglberangkat" id="txtdate">
	        	</div>
	        	<div class="form-group">
	        		<label>Time of Departure</label>
	        		<input class="form-control" required type="time" name="waktuberangkat" id="txttime">
	        	</div>
				<div class="form-group">
					<label><b>Notes for Driver :</b></label>
					<input class="form-control" required type="text" name="note" id="txtcatatan">
				</div>
				<div class="form-group">
					<label><b>Phone Number :</b></label>
					<input class="form-control" required type="text" name="notelp" id="txtnohp">
				</div>
				<div class="form-group">
					<label><b>Email : </b></label>
					<input class="form-control" required type="email" name="email" id="txtemail">
				</div>
				<p>
					Price : $<b id="lblprice">0</b>
				</p>
				<div class="form-group">
					<button class="btn btn-outline-success rounded-pill form-control" type="submit"
					name="submit">Order Now</button>
				</div>
			</form>
		</div>
		<div class="col-md-6">
		  <div id="map-box" style="width:100%;height:710px;"></div>
		</div>
	</div>
</div>


<!-- <div class="modal fade" id="destinationmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Destinations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAddDestination">
        	<div class="form-group">
		        <label>Destination</label>
		        <select class="form-control" name="destination" id="cmbdestination">
		        	<option value="0">--- Choose One ---</option>
		        	<?php foreach ($destinations as $destination): ?>
		        		<option value="<?= $destination ?>"><?= $destination ?></option>
		        	<?php endforeach ?>
		        </select>
        	</div>
        	<div class="form-group">
        		<label>Date of Departure</label>
        		<input class="form-control" required type="date" name="tglberangkat" id="txtdate">
        	</div>
        	<div class="form-group">
        		<label>Time of Departure</label>
        		<input class="form-control" required type="time" name="waktuberangkat" id="txttime">
        	</div>
      </div>
      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div> -->


<script>
	// var selectedDestinations = [];
	// var selectedCoordinate = [];
	// var countdestination = 0;

	// function showdestinations()
	// {
	// 	var loc = $("#destinationsarea");
	// 	loc.html("");
	// 	$.each(selectedDestinations, function(index){
	// 		<?php if ( $_SESSION["lang"] == "id" ): ?>
	// 		loc.append("<div class='card mb-3'> <div class='card-body'> <h4><button class='btn btn-danger btn-sm' id='btnCancelDestination' data-id='"+ index +"'>X</button> Tujuan # "+ (index + 1) +"</h4> <div class='row'> <div class='col-md-4 col-5'>Tujuan</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].destination +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Tanggal</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].date +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Waktu</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].time +"</div> </div> <h4>"+ selectedDestinations[index].cost +"</h4> </div> </div>")
	// 		<?php else: ?>
	// 			loc.append("<div class='card mb-3'> <div class='card-body'> <h4><button class='btn btn-danger btn-sm' id='btnCancelDestination' data-id='"+ index +"'>X</button> Destination # "+ (index + 1) +"</h4> <div class='row'> <div class='col-md-4 col-5'>Destination</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].destination +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Date</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].date +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Time</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].time +"</div> </div> <h4>"+ selectedDestinations[index].cost +"</h4> </div> </div>")
	//   		<?php endif ?>
	// 	});
	// }

	var pickup = null;
	var destination = null;
	var price = 0;

	function mapInitialize() 
	{
		var propertiPeta = {
			center:new google.maps.LatLng(-8.4102025,115.0926971),
			zoom:9,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var peta = new google.maps.Map(document.getElementById("map-box"), propertiPeta);

		if ( pickup != null ) {
			var coordinate = pickup.split(",");
			new google.maps.Marker({
				position: new google.maps.LatLng(coordinate[0],coordinate[1]),
				map: peta,
				icon: "assets/img/titikjemput.png"
			});
		}

		if ( destination != null ) {
			var coordinate = destination.split(",");
			new google.maps.Marker({
				position: new google.maps.LatLng(coordinate[0],coordinate[1]),
				map: peta,
				icon: "assets/img/titikantar.png"
			});
		}
		// new google.maps.Marker({
		// 	position: new google.maps.LatLng("-8.746928", "115.165099"),
		// 	map: peta,
		// 	icon: "assets/img/titikjemput.png"
		// });

		// if ( selectedCoordinate.length > 0 ) {
		// 	$.each(selectedCoordinate, function(index){
		// 		var coordinate = selectedCoordinate[index].split(",");
		// 		new google.maps.Marker({
		// 			position: new google.maps.LatLng(coordinate[0],coordinate[1]),
		// 			map: peta,
		// 			icon: "assets/img/titikantar.png"
		// 		});
		// 	});
		// }
	}
	mapInitialize()

	$("#cmbpickup").on("change",function(){
		$("#cmbdestination").html("");
		$("#cmbdestination").append(new Option("--- Choose One ---","0"))
		$("#lblprice").html("0");
		price = 0;
		var previous = $(this).val();
		if ( previous == "0" ) {
			$("#cmbdestination option").eq(0).prop("selected",true);
			$("#cmbdestination").attr("disabled","disabled");
			pickup = null;
			destination = null;
			mapInitialize();
		} else {
			$.ajax({
				url : "<?= $myfunc->baseurl ?>config/request.php",
				data : { previous : previous, get_destination : true },
				type : "post",
				dataType : "json",
				success : function(result) {
					$("#cmbdestination").removeAttr("disabled");
				    $.each(result, function(val, txt) {
				       $('#cmbdestination').append(new Option(txt, txt));
				    });

				    $.ajax({
						url : "<?= $myfunc->baseurl ?>config/request.php",
						data : { destination : previous, get_destination_coordinate : true },
						type : "post",
						dataType : "text",
						success : function(result) {
							pickup = result;
							mapInitialize();
						}
					});
				}
			});
		}
	});

	$("#cmbdestination").on("change",function(){
		var previous = $(this).val();
		if ( previous == "0" ) {
			$("#lblprice").html("0");
			price = 0;
			destination = null;
			mapInitialize();
		} else {
		    $.ajax({
				url : "<?= $myfunc->baseurl ?>config/request.php",
				data : { destination : previous, get_destination_coordinate : true },
				type : "post",
				dataType : "text",
				success : function(result) {
					destination = result;
					mapInitialize();

					var pickupname = $("#cmbpickup").val();
					var destinationname = $("#cmbdestination").val();
					$.ajax({
						url : "<?= $myfunc->baseurl ?>config/request.php",
						data : { pickup : pickupname, destination : destinationname, get_destination_cost : true },
						type : "post",
						dataType : "text",
						success : function(result) {
							$("#lblprice").html(result);
							price = result;
						}
					});
				}
			});
		}
	});

	$("#frmorder").on("submit",function(e){
		e.preventDefault();
		if ( pickup == null ) {
			alert("Please choose pickup point");
		} else if ( destination == null ) {
			alert("Please choose destination point");
		} else {
			var jemput = $("#cmbpickup").val();
			var antar = $("#cmbdestination").val();
			var waktu = $("#txtdate").val() + " " + $("#txttime").val();
			var price = price;
			var note = $("#txtcatatan").val();
			var no_telp = $("#txtnohp").val();
			var email = $("#email").val();
			$.ajax({
				url : "<?= $myfunc->baseurl ?>pesan.php",
				data : { jemput: jemput, antar: antar, waktu: waktu, price: price, note: note, no_telp: no_telp, email: email, order:true },
				type : "post",
				dataType : "text",
				success: function(result) {
					window.location = "<?= $myfunc->baseurl ?>wait.php";
				}
			});
		}
	});

	// function markOnMap(coordinate)
	// {
	// 	selectedCoordinate.push(coordinate);
	// }

	// $("#btnAddDestination").on("click",function(){
	// 	$("#destinationmodal").modal("show");
	// });

	// $("#frmAddDestination").on("submit",function(e){
	// 	e.preventDefault();

	// 	var destination = $("#cmbdestination").val();
	// 	var date = $("#txtdate").val();
	// 	var time = $("#txttime").val();
	// 	var cost = 0;

	// 	if ( destination == 0 ) {
	// 		<?php if ( $_SESSION["lang"] == "id" ): ?>
	// 			alert("Pilih Tujuan Terlebih Dahulu!");
	// 		<?php else: ?>
	// 			alert("Choose the Destination!");
	//   		<?php endif ?>
	// 	} else {
	// 		if ( selectedDestinations.length > 0 ) {
	// 			var previousDestination = selectedDestinations[countdestination - 1].destination;
	// 			if ( previousDestination == destination ) {
	// 				<?php if ( $_SESSION["lang"] == "id" ): ?>
	// 					alert("Pilih Tujuan yang Berbeda!");
	// 				<?php else: ?>
	// 					alert("Choose the different Destination!");
	// 		  		<?php endif ?>
	// 				return;
	// 			}
	// 		}

	// 		$.ajax({
	// 			url: "<?= $myfunc->baseurl ?>config/request.php",
	// 			data : { destination : destination, get_destination_cost : true },
	// 			type : "post",
	// 			dataType : "text",
	// 			success : function(result){
	// 				var data = {
	// 					destination: destination,
	// 					date: date,
	// 					time: time,
	// 					cost: result
	// 				}
	// 				selectedDestinations.push(data);

	// 				$.ajax({
	// 					url: "<?= $myfunc->baseurl ?>config/request.php",
	// 					data : { destination : destination, get_destination_coordinate : true },
	// 					type : "post",
	// 					dataType : "text",
	// 					success : function(result) {
	// 						markOnMap(result);
	// 						showdestinations();
	// 						countdestination += 1;
	// 						mapInitialize();
	// 					}
	// 				});
	// 			}
	// 		});
	// 	}

	// 	$("#frmAddDestination").trigger("reset");
	// 	$("#destinationmodal").modal("hide");
	// });

	// $("#destinationsarea").on("click","#btnCancelDestination",function(){
	// 	var index = $(this).attr("data-id");
	// 	selectedDestinations.splice(index,1);
	// 	selectedCoordinate.splice(index,1);
	// 	showdestinations();
	// 	mapInitialize();
	// 	countdestination -= 1;
	// });

	// $("#frmorder").on("submit",function(e){
	// 	e.preventDefault();
	// 	var catatan = $("#txtcatatan").val(),
	// 		nohp = $("#txtnohp").val(),
	// 		email = $("#txtemail").val();
	// 	if ( countdestination == 0 ) {
	// 		<?php if ( $_SESSION["lang"] == "id" ): ?>
	// 			alert("Pilih Tujuan Terlebih Dahulu!");
	// 		<?php else: ?>
	// 			alert("Choose the Destination!");
	//   		<?php endif ?>
	// 	} else {
	// 		$.ajax({
	// 			url : "<?= $myfunc->baseurl ?>pesan.php",
	// 			data : { note : catatan, no_telp : nohp, email : email, destinations : selectedDestinations, order:true },
	// 			type : "post",
	// 			dataType : "text",
	// 			success: function(result) {
	// 				window.location = "<?= $myfunc->baseurl ?>wait.php";
	// 			}
	// 		});
	// 	}
	// });
</script>


    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.min.js.map"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&v=3.exp&sensor=true&libraries=places"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>