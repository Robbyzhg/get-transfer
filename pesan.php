<?php 
include 'config/functions.php';

$myfunc = new functions();

include 'templates/header.php';


if (isset($_POST['submit'])) {
	$myfunc->pesan_add($_POST);
}


?>

<br><br>
<div class="container">
	<div class="row">
		<div class="col-6">
			<form method="post" action="">
			<div class="form-group">
				<label><b>Titik Penjemputan : </b></label>
				<input class="form-control" type="text" name="titikjemput">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
		<div class="form-group">
			<label><b>Titik Pengantaran : </b></label>
			<input class="form-control" type="text" name="titikantar"
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label><b>Tanggal Penjemputan : </b></label>
				<input class="form-control" type="date" name="tglpenjemputan">
			</div>
			<div class="form-group">
				<label><b>Waktu Penjemputan : </b></label>
				<input class="form-control" type="time" name="waktupenjemputan">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label><b>Kelas Mobil : </b></label>
				<select class="form-control" name="kelasmobil">
					<option>-</option>
					<option>Economy</option>
					<option>Business</option>
					<option>Exclusive</option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label><b>Catatan untuk Driver : </b></label>
				<input class="form-control" type="text" name="note">
			</div>
		</div>
	</div>
</div>		
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label><b>No Telpon : </b></label>
				<input class="form-control" type="text" name="notelp">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label><b>Email : </b></label>
				<input class="form-control" type="text" name="email">
			</div>
		</div>
	</div>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-6">
				<div class="form-group">
					<button class="btn btn-outline-success rounded-pill form-control" type="submit"
					name="submit">Pesan Sekarang</button>
				</div>
			</form>
		</div>
	</div>
</div>
