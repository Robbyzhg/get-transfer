<?php 
class functions {
	public $conn;
	public $baseurl;

	public function __construct()
	{
		$this->conn = mysqli_connect("localhost","root","","db_rentalmobil");
		$this->baseurl = "http://localhost/rental-mobil/";
	}

	public function get_data($query)
	{
		$query = mysql_query($this->conn, $query);
		return mysqli_fetch_assoc($query);
	}

	public function query($query)
	{
		$row = [];
		$get = mysqli_query($this->conn, $query);
		while ( $row = mysqli_fetch_assoc($get) ) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function num_rows($query)
	{
		$get = mysqli_query($this->conn, $query);
		return mysqli_num_rows($get);
	}

	public function exe($query)
	{
		$exe = mysqli_query($this->conn, $query);
		return mysqli_affected_rows($this->conn);
	}

	public function notif($msg,$status)
	{
		$_SESSION["flash_data"] = ["message" => $msg, "status" => $status];
	}

	public function redirect($link)
	{
		header("Location: $link");
	}

	public function pesan_add($data)
	{
		$titikjemput = $data['titikjemput'];
		$titikantar = $data['titikantar'];
		$tglpenjemputan = $data['tglpenjemputan'];
		$waktupenjemputan = $data['waktupenjemputan'];
		$kelasmobil = $data['kelasmobil'];
		$note = $data['note'];
		$notelp = $data['notelp'];
		$email = $data['email'];

		$insert = $this->exe("INSERT INTO pesan VALUES ('', '$titikjemput', '$titikantar', '$tglpenjemputan',
			'$waktupenjemputan', '$kelasmobil', '$note', '$notelp', '$email')");
		if ( $insert > 0 ) {
				$this->notif("PESANAN BERHASIL!","success");
				$this->redirect($this->baseurl . "wait.php");
			} else {
				$this->notif("PESANAN GAGAL!","danger");
				$this->redirect($this->baseurl . "pesan.php");
		}
	}

	public function pesan_get($id_pesan = null)
	{
		if ($id_pesan == null) {
			$query = "SELECT * FROM pesan";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM pesan WHERE id_pesan = '$id_pesan'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
		}
	}
}

	public function pesan_delete($id_pesan)
	{
		$this->exe("DELETE FROM pesan WHERE id_pesan = '$id_pesan'");
		if ( $delete > 0 ) {
			$this->notif("Pesanan Selesai","success");
			$this->redirect($this->baseurl . "admin/cek_pesanan.php");
		} else {
			$this->notif("Gagal! Kesalahan pada query","danger");
			$this->redirect($this->baseurl . "admin/cek_pesanan.php");
		}
	}

}