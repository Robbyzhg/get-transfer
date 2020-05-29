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

			<button class="btn btn-success rounded-pill mb-3" id="btnAddDestination">
				<?php if ( $_SESSION["lang"] == "id" ): ?>
					Tambah Titik Tujuan
				<?php else: ?>
					Add more Destinations
				<?php endif ?>
			</button>
			
			<div id="destinationsarea">
			</div>
			
			<form method="post" action="" id="frmorder">
				<div class="form-group">
					<label><b>
						<?php if ( $_SESSION["lang"] == "id" ): ?>
							Catatan untuk Driver : 
						<?php else: ?>
							Notes for Driver :
						<?php endif ?>
					</b></label>
					<input class="form-control" required type="text" name="note" id="txtcatatan">
				</div>
				<div class="form-group">
					<label><b>
						<?php if ( $_SESSION["lang"] == "id" ): ?>
							No Telpon : 
						<?php else: ?>
							Phone Number :
						<?php endif ?>
					</b></label>
					<input class="form-control" required type="text" name="notelp" id="txtnohp">
				</div>
				<div class="form-group">
					<label><b>Email : </b></label>
					<input class="form-control" required type="email" name="email" id="txtemail">
				</div>
				<div class="form-group">
					<button class="btn btn-outline-success rounded-pill form-control" type="submit"
					name="submit">
						<?php if ( $_SESSION["lang"] == "id" ): ?>
							Pesan Sekarang
						<?php else: ?>
							Order Now
						<?php endif ?>
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-6">
		  <div id="map-box" style="width:100%;height:710px;"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="destinationmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        	<?php if ( $_SESSION["lang"] == "id" ): ?>
	        	Tambah Titik Tujuan
			<?php else: ?>
				Add new Destinations
			<?php endif ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAddDestination">
        	<div class="form-group">
		        <label>
		        	<?php if ( $_SESSION["lang"] == "id" ): ?>
			        	Titik Tujuan
					<?php else: ?>
						Destination
					<?php endif ?>
		        </label>
		        <select class="form-control" name="destination" id="cmbdestination">
		        	<option value="0">
		        		<?php if ( $_SESSION["lang"] == "id" ): ?>
			        		--- Pilih Satu ---
						<?php else: ?>
							--- Choose One ---
						<?php endif ?>
		        	</option>
		        	<?php foreach ($destinations as $destination): ?>
		        		<option value="<?= $destination ?>"><?= $destination ?></option>
		        	<?php endforeach ?>
		        </select>
        	</div>
        	<div class="form-group">
        		<label>
        			<?php if ( $_SESSION["lang"] == "id" ): ?>
	        			Tanggal Berangkat
					<?php else: ?>
						Date of Departure
					<?php endif ?>
        		</label>
        		<input class="form-control" required type="date" name="tglberangkat" id="txtdate">
        	</div>
        	<div class="form-group">
        		<label>
        			<?php if ( $_SESSION["lang"] == "id" ): ?>
	        			Waktu Berangkat
					<?php else: ?>
						Time of Departure
					<?php endif ?>
        		</label>
        		<input class="form-control" required type="time" name="waktuberangkat" id="txttime">
        	</div>
      </div>
      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">
	        	<?php if ( $_SESSION["lang"] == "id" ): ?>
		        	Tutup
				<?php else: ?>
					Close
				<?php endif ?>
	        </button>
	        <button type="submit" class="btn btn-success">
	        	<?php if ( $_SESSION["lang"] == "id" ): ?>
		        	Simpan
				<?php else: ?>
					Save
				<?php endif ?>
	        </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
	var selectedDestinations = [];
	var selectedCoordinate = [];
	var countdestination = 0;

	function showdestinations()
	{
		var loc = $("#destinationsarea");
		loc.html("");
		$.each(selectedDestinations, function(index){
			<?php if ( $_SESSION["lang"] == "id" ): ?>
			loc.append("<div class='card mb-3'> <div class='card-body'> <h4><button class='btn btn-danger btn-sm' id='btnCancelDestination' data-id='"+ index +"'>X</button> Tujuan # "+ (index + 1) +"</h4> <div class='row'> <div class='col-md-4 col-5'>Tujuan</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].destination +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Tanggal</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].date +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Waktu</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].time +"</div> </div> <h4>"+ selectedDestinations[index].cost +"</h4> </div> </div>")
			<?php else: ?>
				loc.append("<div class='card mb-3'> <div class='card-body'> <h4><button class='btn btn-danger btn-sm' id='btnCancelDestination' data-id='"+ index +"'>X</button> Destination # "+ (index + 1) +"</h4> <div class='row'> <div class='col-md-4 col-5'>Destination</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].destination +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Date</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].date +"</div> </div> <div class='row'> <div class='col-md-4 col-5'>Time</div> <div class='col-md-8 col-7'>: "+ selectedDestinations[index].time +"</div> </div> <h4>"+ selectedDestinations[index].cost +"</h4> </div> </div>")
	  		<?php endif ?>
		});
	}

	var peta;
	function mapInitialize() 
	{
		var propertiPeta = {
			center:new google.maps.LatLng(-8.4102025,115.0926971),
			zoom:9,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		peta = new google.maps.Map(document.getElementById("map-box"), propertiPeta);

		if ( selectedCoordinate.length > 0 ) {
			$.each(selectedCoordinate, function(index){
				var coordinate = selectedCoordinate[index].split(",");
				new google.maps.Marker({
					position: new google.maps.LatLng(coordinate[0],coordinate[1]),
					map: peta,
					icon: "assets/img/titikjemput.png"
				});
			});
		}
	}

	function markOnMap(coordinate)
	{
		selectedCoordinate.push(coordinate);
	}
	mapInitialize()

	$("#btnAddDestination").on("click",function(){
		$("#destinationmodal").modal("show");
	});

	$("#frmAddDestination").on("submit",function(e){
		e.preventDefault();

		var destination = $("#cmbdestination").val();
		var date = $("#txtdate").val();
		var time = $("#txttime").val();
		var cost = 0;

		if ( destination == 0 ) {
			<?php if ( $_SESSION["lang"] == "id" ): ?>
				alert("Pilih Tujuan Terlebih Dahulu!");
			<?php else: ?>
				alert("Choose the Destination!");
	  		<?php endif ?>
		} else {
			if ( selectedDestinations.length > 0 ) {
				var previousDestination = selectedDestinations[countdestination - 1].destination;
				if ( previousDestination == destination ) {
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						alert("Pilih Tujuan yang Berbeda!");
					<?php else: ?>
						alert("Choose the different Destination!");
			  		<?php endif ?>
					return;
				}
			}

			$.ajax({
				url: "<?= $myfunc->baseurl ?>config/request.php",
				data : { destination : destination, get_destination_cost : true },
				type : "post",
				dataType : "text",
				success : function(result){
					var data = {
						destination: destination,
						date: date,
						time: time,
						cost: result
					}
					selectedDestinations.push(data);

					$.ajax({
						url: "<?= $myfunc->baseurl ?>config/request.php",
						data : { destination : destination, get_destination_coordinate : true },
						type : "post",
						dataType : "text",
						success : function(result) {
							markOnMap(result);
							showdestinations();
							countdestination += 1;
							mapInitialize();
						}
					});
				}
			});
		}

		$("#frmAddDestination").trigger("reset");
		$("#destinationmodal").modal("hide");
	});

	$("#destinationsarea").on("click","#btnCancelDestination",function(){
		var index = $(this).attr("data-id");
		selectedDestinations.splice(index,1);
		selectedCoordinate.splice(index,1);
		showdestinations();
		mapInitialize();
		countdestination -= 1;
	});

	$("#frmorder").on("submit",function(e){
		e.preventDefault();
		var catatan = $("#txtcatatan").val(),
			nohp = $("#txtnohp").val(),
			email = $("#txtemail").val();
		if ( countdestination == 0 ) {
			<?php if ( $_SESSION["lang"] == "id" ): ?>
				alert("Pilih Tujuan Terlebih Dahulu!");
			<?php else: ?>
				alert("Choose the Destination!");
	  		<?php endif ?>
		} else {
			$.ajax({
				url : "<?= $myfunc->baseurl ?>pesan.php",
				data : { note : catatan, no_telp : nohp, email : email, destinations : selectedDestinations, order:true },
				type : "post",
				dataType : "text",
				success: function(result) {
					window.location = "<?= $myfunc->baseurl ?>wait.php";
				}
			});
		}
	});
</script>