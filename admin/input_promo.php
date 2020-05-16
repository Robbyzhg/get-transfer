<?php
include '../config/functions.php';

$myfunc = new functions();

include 'templates/header.php';

$get = $myfunc->promo_get();

if (isset($_GET['selesai'])) {
	$myfunc->promo_delete($_GET['selesai']);
}

if (isset($_POST['submit'])) {
	// var_dump($_FILES); die;
	$myfunc->inputpromo_add($_POST);
}

 ?>

 <style>
	body{
		background-color: #2ecc71;
	}
</style>
	<div class="col-9 ml-5 mt-5">
		<div class="card">
			<div class="card-header">
				Input Promo
			</div>
			<div class="card-body">
				<?php if ( isset($_SESSION["flash_data"]) ): ?>
					<div class="alert alert-<?= $_SESSION["flash_data"]['status'] ?>" role="alert">
						<?= $_SESSION["flash_data"]['message'] ?>
					</div>
					<?php unset($_SESSION["flash_data"]) ?>
				<?php endif ?>
				<form method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label>Gambar Promo</label>
						<input type="file" name="gambar_promo" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" value="Input" name="submit" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
		<br><br>
		<table class="table table-hover text-center" border="1">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Gambar</th>
		      <th scope="col">Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($get as $row): ?>
			    <tr>
			      <td><img src="../assets/promo/<?= $row['gambar_promo'] ?>" height="100" class="d-block w-50"></td>
			      <td><a href="<?= $myfunc->baseurl ?>admin/input_promo.php?selesai=<?= $row['id_promo'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Selesai</a></td>
			    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
	</div>
	