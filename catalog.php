<?php
include 'config/functions.php';

$myfunc = new functions();

include 'templates/header.php';

$get = $myfunc->mobil_get();
 ?>

<style>
	body{
		background-color: #34495e;
	}
</style>

<div class="container">
	<div class="row text-center">
		<?php foreach($get as $row): ?>
			<div class="col-4 mt-5">
				<div class="card" style="width: 18rem;">
				  <img src="assets/mobil/<?= $row['gambar']; ?>" class="card-img-top">
				  <div class="card-body">
				    <h5 class="card-title"><?= $row['merk'] ?></h5>
				    <p class="card-text"><?= $row['jenis'] ?></p>
				    <p class="card-text"><?= $row['plat'] ?></p>
				  </div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>