<?php
include '../config/functions.php';

$myfunc = new functions();

include 'templates/header.php';

$get = $myfunc->pesan_get();

if (isset($_GET['selesai'])) {
	$myfunc->pesan_delete($_GET['selesai']);
}

?>

<div class="content-section col-12 text-center mt-5">
	<div class="card">
		<div class="card-header bg-success text-white">
			List Pesanan
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-success text-white">
						<tr>
							<td>Catatan</td>
							<td>No Telpon</td>
							<td>Email</td>
							<td>Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($get as $row): ?>
							 <tr>
							 	<td><?= $row['note']; ?></td>
							 	<td><?= $row['no_telp']; ?></td>
							 	<td><?= $row['email']; ?></td>
							 	<td>
							 		<a href="<?= $myfunc->baseurl ?>admin/payment_edit.php?id=<?= $row['id_pesan'] ?>" class="btn btn-primary">Terima</a>
							 		<a href="<?= $myfunc->baseurl ?>admin/cek_pesanan.php?selesai=<?= $row['id_pesan'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Selesai</a>
							 	</td>
							 </tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
