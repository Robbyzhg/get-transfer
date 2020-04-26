<?php 
class functions {
	public $conn;
	public $baseurl;

	public function __construct()
	{
		$this->conn = mysqli_connect("localhost","root","","db_rentalmobil");
		$this->baseurl = "http://localhost/get-transfer/";
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

	public function get_distance($origins,$destinations)
	{
		$get = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&origins=". $origins ."&destinations=". $destinations);
		$data = json_decode($get);
		$result = [
			"distance" => $data->rows[0]->elements[0]->distance->text,
			"duration" => $data->rows[0]->elements[0]->duration->text,
			"price" => [
				"economy" => 10000 * floor($data->rows[0]->elements[0]->distance->text),
				"business" => 20000 * floor($data->rows[0]->elements[0]->distance->text),
				"exclusive" => 30000 * floor($data->rows[0]->elements[0]->distance->text)
			]
		];

		return $result;
	}

	public function get_destinations()
	{
		return ["Kuta","Legian","Seminyak","Kerobokan","Jimbaran","Nusa Dua","Uluwatu","Canggu","Tanahlot","Ubud","Tegalalang","Kintamani","Candidasa","Amed","Lovina","Pemuteran","Gilimanuk","Tabanan","Negara","DPS","Sanur"];
	}

	public function get_destination_cost($destination)
	{
		$data = [
			"Kuta" => "$10 - $15",
			"Legian" => "$12 - $17",
			"Seminyak" => "$15 - $20",
			"Kerobokan" => "$16 - $21",
			"Jimbaran" => "$11 - $16",
			"Nusa Dua" => "$17 - $22",
			"Uluwatu" => "$20 - $25",
			"Canggu" => "$18 - $23",
			"Tanahlot" => "$25 - $30",
			"Ubud" => "$26 - $31",
			"Tegalalang" => "$30 - $35",
			"Kintamani" => "$32 - $37",
			"Candidasa" => "$32 - $37",
			"Amed" => "$45 - $50",
			"Lovina" => "$60 - $70",
			"Pemuteran" => "$75 - $85",
			"Gilimanuk" => "$70 - $75",
			"Tabanan" => "$50 - $55",
			"Negara" => "$66 - $71",
			"DPS" => "$20 - $25",
			"Sanur" => "$18 - $23"
		];

		return $data[$destination];
	}
}