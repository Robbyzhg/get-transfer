<?php 
session_start();
require('PHPMailer/class.phpmailer.php');
class functions {
	public $conn;
	public $baseurl;
	public $mail;

	public function __construct()
	{
		$this->mail = new PHPMailer();
		$this->conn = mysqli_connect("localhost","root","","db_rentalmobil");
		$this->baseurl = "http://localhost/get-transfer/";
	}

	public function get_last_id($table,$column)
	{
		$query = mysqli_query($this->conn, "SELECT * FROM $table ORDER BY $column DESC");
		$fetch = mysqli_fetch_assoc($query);
		$numrow = mysqli_num_rows($query);

		if ( $numrow > 0 ) {
			return $fetch[$column];
		} else {
			return 0;
		}

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

	public function promo_delete($id_promo)
	{
		$this->exe("DELETE FROM promo WHERE id_promo = '$id_promo'");
		if ( $delete > 0 ) {
			$this->notif("Promo di Delete","success");
			$this->redirect($this->baseurl . "admin/input_promo.php");
		} else {
			$this->notif("Gagal! Kesalahan pada query","danger");
			$this->redirect($this->baseurl . "admin/input_promo.php");
		}
	}

	public function get_destinations($previous = null)
	{
		$destinations = ["Airport","Legian","Seminyak","Kerobokan","Jimbaran","Nusa Dua","Uluwatu","Canggu","Tanahlot","Ubud","Payangan","Tegalalang","Kintamani","Candidasa","Amed","Lovina","Pemuteran","Gilimanuk","Tabanan","Negara","Kuta"];
		if ( $previous == null ) {
			return $destinations;
		} else {
			$result = [];
			foreach ($destinations as $destination) {
				if ( $destination != $previous ) {
					array_push($result, $destination);
				}
			}

			return $result;
		}
	}

	// public function get_destination_cost($destination)
	// {
	// 	$data = [
	// 		"Kuta" => "$10 - $15",
	// 		"Legian" => "$12 - $17",
	// 		"Seminyak" => "$15 - $20",
	// 		"Kerobokan" => "$16 - $21",
	// 		"Jimbaran" => "$11 - $16",
	// 		"Nusa Dua" => "$17 - $22",
	// 		"Uluwatu" => "$20 - $25",
	// 		"Canggu" => "$18 - $23",
	// 		"Tanahlot" => "$25 - $30",
	// 		"Ubud" => "$26 - $31",
	// 		"Tegalalang" => "$30 - $35",
	// 		"Kintamani" => "$32 - $37",
	// 		"Candidasa" => "$32 - $37",
	// 		"Amed" => "$45 - $50",
	// 		"Lovina" => "$60 - $70",
	// 		"Pemuteran" => "$75 - $85",
	// 		"Gilimanuk" => "$70 - $75",
	// 		"Tabanan" => "$50 - $55",
	// 		"Negara" => "$66 - $71",
	// 		"DPS" => "$20 - $25",
	// 		"Sanur" => "$18 - $23"
	// 	];

	// 	return $data[$destination];
	// }
	public function get_destination_cost($pickup, $destination)
	{
		// $data = [
		// 		"Airport" => "",
		// 		"Legian" => "",
		// 		"Seminyak" => "",
		// 		"Kerobokan" => "",
		// 		"Jimbaran" => "",
		// 		"Nusa Dua" => "",
		// 		"Uluwatu" => "",
		// 		"Canggu" => "",
		// 		"Tanahlot" => "",
		// 		"Ubud" => "",
		// 		"Payangan" => "",
		// 		"Tegalalang" => "",
		// 		"Kintamani" => "",
		// 		"Candidasa" => "",
		// 		"Amed" => "",
		// 		"Lovina" => "",
		// 		"Pemuteran" => "",
		// 		"Gilimanuk" => "",
		// 		"Tabanan" => "",
		// 		"Negara" => "",
		// 		"Kuta" => ""
		// 	];
		if ( $pickup == "Airport" ) {
			$data = [
				"Legian" => "13.20",
				"Seminyak" => "15.00",
				"Kerobokan" => "22.20",
				"Jimbaran" => "16.05",
				"Nusa Dua" => "22.05",
				"Uluwatu" => "32.25",
				"Canggu" => "30.30",
				"Tanahlot" => "40.35",
				"Ubud" => "57.15",
				"Payangan" => "78.30",
				"Tegalalang" => "76.35",
				"Kintamani" => "108.30",
				"Candidasa" => "97.05",
				"Amed" => "134.40",
				"Lovina" => "138.75",
				"Pemuteran" => "204.00",
				"Gilimanuk" => "208.50",
				"Tabanan" => "51.06",
				"Negara" => "160.50",
				"Kuta" => "7.20"
			];
		} elseif ( $pickup == "Tegalalang" ) {
			$data = [
				"Airport" => "76.35",
				"Legian" => "64.35",
				"Seminyak" => "65.70",
				"Kerobokan" => "60.00",
				"Jimbaran" => "83.70",
				"Nusa Dua" => "83.40",
				"Uluwatu" => "101.70",
				"Canggu" => "62.55",
				"Tanahlot" => "68.85",
				"Ubud" => "22.35",
				"Payangan" => "23.85",
				"Kintamani" => "30.30",
				"Candidasa" => "86.85",
				"Amed" => "109.35",
				"Lovina" => "113.25",
				"Pemuteran" => "184.50",
				"Gilimanuk" => "216.00",
				"Tabanan" => "58.50",
				"Negara" => "166.50",
				"Kuta" => "77.40"
			];
		} elseif ( $pickup == "Legian" ) {
			$data = [
				"Airport" => "13.20",
				"Seminyak" => "3.30",
				"Kerobokan" => "10.65",
				"Jimbaran" => "20.85",
				"Nusa Dua" => "26.40",
				"Uluwatu" => "38.55",
				"Canggu" => "18.60",
				"Tanahlot" => "28.65",
				"Ubud" => "43.95",
				"Payangan" => "61.35",
				"Tegalalang" => "64.35",
				"Kintamani" => "92.40",
				"Candidasa" => "87.00",
				"Amed" => "124.20",
				"Lovina" => "128.55",
				"Pemuteran" => "139.50",
				"Gilimanuk" => "198.00",
				"Tabanan" => "41.40",
				"Negara" => "149.70",
				"Kuta" => "5.55"
			];
		} elseif ( $pickup == "Kintamani" ) {
			$data = [
				"Airport" => "108.30",
				"Legian" => "92.40",
				"Seminyak" => "63.15",
				"Kerobokan" => "87.60",
				"Jimbaran" => "115.65",
				"Nusa Dua" => "115.35",
				"Uluwatu" => "133.50",
				"Canggu" => "89.85",
				"Tanahlot" => "96.45",
				"Ubud" => "52.50",
				"Payangan" => "35.70",
				"Tegalalang" => "30.35",
				"Candidasa" => "75.45",
				"Amed" => "89.85",
				"Lovina" => "92.40",
				"Pemuteran" => "163.50",
				"Gilimanuk" => "243.00",
				"Tabanan" => "85.65",
				"Negara" => "193.50",
				"Kuta" => "112.35"
			];
		} elseif ( $pickup == "Seminyak" ) {
			$data = [
				"Airport" => "15.00",
				"Legian" => "2.55",
				"Kerobokan" => "7.65",
				"Jimbaran" => "23.10",
				"Nusa Dua" => "28.65",
				"Uluwatu" => "40.80",
				"Canggu" => "16.05",
				"Tanahlot" => "26.10",
				"Ubud" => "45.30",
				"Payangan" => "62.10",
				"Tegalalang" => "65.70",
				"Kintamani" => "63.15",
				"Candidasa" => "88.80",
				"Amed" => "81.45",
				"Lovina" => "124.20",
				"Pemuteran" => "193.50",
				"Gilimanuk" => "36.90",
				"Tabanan" => "36.90",
				"Negara" => "145.35",
				"Kuta" => "8.10"
			];
		} elseif ( $pickup == "Candidasa" ) {
			$data = [
				"Airport" => "97.05",
				"Legian" => "87.00",
				"Seminyak" => "88.80",
				"Kerobokan" => "85.50",
				"Jimbaran" => "83.70",
				"Nusa Dua" => "104.10",
				"Uluwatu" => "122.40",
				"Canggu" => "89.95",
				"Tanahlot" => "100.80",
				"Ubud" => "68.40",
				"Payangan" => "103.65",
				"Tegalalang" => "86.85",
				"Kintamani" => "75.45",
				"Amed" => "49.95",
				"Lovina" => "166.50",
				"Pemuteran" => "237.00",
				"Gilimanuk" => "252.00",
				"Tabanan" => "94.80",
				"Negara" => "202.50",
				"Kuta" => "96.45"
			];
		} elseif ( $pickup == "Kerobokan" ) {
			$data = [
				"Airport" => "22.20",
				"Legian" => "10.50",
				"Seminyak" => "7.80",
				"Jimbaran" => "29.55",
				"Nusa Dua" => "35.10",
				"Uluwatu" => "47.40",
				"Canggu" => "8.10",
				"Tanahlot" => "18.15",
				"Ubud" => "39.60",
				"Payangan" => "56.55",
				"Tegalalang" => "60.00",
				"Kintamani" => "87.60",
				"Candidasa" => "85.50",
				"Amed" => "122.70",
				"Lovina" => "118.50",
				"Pemuteran" => "183.00",
				"Gilimanuk" => "186.00",
				"Tabanan" => "27.15",
				"Negara" => "137.85",
				"Kuta" => "15.00"
			];
		} elseif ( $pickup == "Amed" ) {
			$data = [
				"Airport" => "134.40",
				"Legian" => "124.20",
				"Seminyak" => "81.45",
				"Kerobokan" => "122.70",
				"Jimbaran" => "141.75",
				"Nusa Dua" => "141.45",
				"Uluwatu" => "159.00",
				"Canggu" => "127.20",
				"Tanahlot" => "138.00",
				"Ubud" => "105.75",
				"Payangan" => "119.85",
				"Tegalalang" => "109.35",
				"Kintamani" => "85.95",
				"Candidasa" => "49.95",
				"Lovina" => "132.45",
				"Pemuteran" => "202.50",
				"Gilimanuk" => "250.50",
				"Tabanan" => "132.15",
				"Negara" => "240.00",
				"Kuta" => "133.80"
			];
		} elseif ( $pickup == "Jimbaran" ) {
			$data = [
				"Airport" => "16.05",
				"Legian" => "20.55",
				"Seminyak" => "22.35",
				"Kerobokan" => "29.55",
				"Nusa Dua" => "16.65",
				"Uluwatu" => "23.40",
				"Canggu" => "37.65",
				"Tanahlot" => "47.70",
				"Ubud" => "63.30",
				"Payangan" => "84.60",
				"Tegalalang" => "83.70",
				"Kintamani" => "115.65",
				"Candidasa" => "104.40",
				"Amed" => "141.75",
				"Lovina" => "146.10",
				"Pemuteran" => "211.50",
				"Gilimanuk" => "216.00",
				"Tabanan" => "58.95",
				"Negara" => "168.00",
				"Kuta" => "15.45"
			];
		} elseif ( $pickup == "Lovina" ) {
			$data = [
				"Airport" => "138.75",
				"Legian" => "128.55",
				"Seminyak" => "124.20",
				"Kerobokan" => "118.50",
				"Jimbaran" => "146.10",
				"Nusa Dua" => "150.00",
				"Uluwatu" => "163.50",
				"Canggu" => "117.75",
				"Tanahlot" => "117.15",
				"Ubud" => "109.35",
				"Payangan" => "118.65",
				"Tegalalang" => "113.25",
				"Kintamani" => "92.40",
				"Candidasa" => "166.50",
				"Amed" => "132.45",
				"Pemuteran" => "71.25",
				"Gilimanuk" => "118.20",
				"Tabanan" => "98.40",
				"Negara" => "120.75",
				"Kuta" => "129.90"
			];
		} elseif ( $pickup == "Nusa Dua" ) {
			$data = [
				"Airport" => "22.05",
				"Legian" => "26.40",
				"Seminyak" => "28.65",
				"Kerobokan" => "35.10",
				"Jimbaran" => "16.65",
				"Uluwatu" => "33.45",
				"Canggu" => "41.85",
				"Tanahlot" => "52.05",
				"Ubud" => "63.00",
				"Payangan" => "84.30",
				"Tegalalang" => "83.40",
				"Kintamani" => "115.35",
				"Candidasa" => "104.10",
				"Amed" => "141.45",
				"Lovina" => "150.00",
				"Pemuteran" => "216.00",
				"Gilimanuk" => "220.50",
				"Tabanan" => "62.55",
				"Negara" => "171.00",
				"Kuta" => "19.80"
			];
		} elseif ( $pickup == "Pemuteran" ) {
			$data = [
				"Airport" => "204.00",
				"Legian" => "193.50",
				"Seminyak" => "189.00",
				"Kerobokan" => "183.00",
				"Jimbaran" => "211.50",
				"Nusa Dua" => "216.00",
				"Uluwatu" => "229.50",
				"Canggu" => "181.50",
				"Tanahlot" => "172.50",
				"Ubud" => "174.00",
				"Payangan" => "189.00",
				"Tegalalang" => "184.50",
				"Kintamani" => "163.50",
				"Candidasa" => "237.00",
				"Amed" => "202.50",
				"Lovina" => "71.25",
				"Gilimanuk" => "50.70",
				"Tabanan" => "156.00",
				"Negara" => "90.75",
				"Kuta" => "195.00"
			];
		} elseif ( $pickup == "Uluwatu" ) {
			$data = [
				"Airport" => "32.25",
				"Legian" => "38.55",
				"Seminyak" => "40.80",
				"Kerobokan" => "47.40",
				"Jimbaran" => "23.40",
				"Nusa Dua" => "33.45",
				"Canggu" => "55.65",
				"Tanahlot" => "65.70",
				"Ubud" => "81.30",
				"Payangan" => "102.60",
				"Tegalalang" => "101.70",
				"Kintamani" => "133.50",
				"Candidasa" => "122.40",
				"Amed" => "159.00",
				"Lovina" => "163.50",
				"Pemuteran" => "229.50",
				"Gilimanuk" => "234.00",
				"Tabanan" => "76.95",
				"Negara" => "186.00",
				"Kuta" => "33.45"
			];
		} elseif ( $pickup == "Gilimanuk" ) {
			$data = [
				"Airport" => "208.50",
				"Legian" => "198.00",
				"Seminyak" => "193.50",
				"Kerobokan" => "186.00",
				"Jimbaran" => "216.00",
				"Nusa Dua" => "220.50",
				"Uluwatu" => "234.00",
				"Canggu" => "184.50",
				"Tanahlot" => "178.50",
				"Ubud" => "195.00",
				"Payangan" => "222.00",
				"Tegalalang" => "216.00",
				"Kintamani" => "243.00",
				"Candidasa" => "252.00",
				"Amed" => "250.50",
				"Lovina" => "118.20",
				"Pemuteran" => "50.70",
				"Tabanan" => "157.50",
				"Negara" => "47.55",
				"Kuta" => "184.50"
			];
		} elseif ( $pickup == "Canggu" ) {
			$data = [
				"Airport" => "30.30",
				"Legian" => "18.60",
				"Seminyak" => "16.05",
				"Kerobokan" => "8.10",
				"Jimbaran" => "37.65",
				"Nusa Dua" => "44.55",
				"Uluwatu" => "55.65",
				"Tanahlot" => "16.35",
				"Ubud" => "41.40",
				"Payangan" => "58.80",
				"Tegalalang" => "62.55",
				"Kintamani" => "89.85",
				"Candidasa" => "89.85",
				"Amed" => "127.20",
				"Lovina" => "117.75",
				"Pemuteran" => "181.50",
				"Gilimanuk" => "184.50",
				"Tabanan" => "27.60",
				"Negara" => "136.05",
				"Kuta" => "21.60"
			];
		} elseif ( $pickup == "Tabanan" ) {
			$data = [
				"Airport" => "51.60",
				"Legian" => "41.40",
				"Seminyak" => "36.90",
				"Kerobokan" => "27.15",
				"Jimbaran" => "58.95",
				"Nusa Dua" => "62.55",
				"Uluwatu" => "76.95",
				"Canggu" => "27.60",
				"Tanahlot" => "18.60",
				"Ubud" => "37.65",
				"Payangan" => "65.85",
				"Tegalalang" => "58.50",
				"Kintamani" => "85.65",
				"Candidasa" => "94.80",
				"Amed" => "132.15",
				"Lovina" => "98.40",
				"Pemuteran" => "156.00",
				"Gilimanuk" => "157.50",
				"Negara" => "111.75",
				"Kuta" => "44.85"
			];
		} elseif ( $pickup == "Tanahlot" ) {
			$data = [
				"Airport" => "40.35",
				"Legian" => "28.65",
				"Seminyak" => "26.10",
				"Kerobokan" => "18.15",
				"Jimbaran" => "47.70",
				"Nusa Dua" => "52.05",
				"Uluwatu" => "65.70",
				"Canggu" => "16.35",
				"Ubud" => "48.60",
				"Payangan" => "65.10",
				"Tegalalang" => "68.85",
				"Kintamani" => "96.45",
				"Candidasa" => "100.80",
				"Amed" => "138.00",
				"Lovina" => "117.15",
				"Pemuteran" => "172.50",
				"Gilimanuk" => "178.50",
				"Tabanan" => "18.60",
				"Negara" => "130.00",
				"Kuta" => "32.55"
			];
		}elseif ( $pickup == "Negara" ) {
			$data = [
				"Airport" => "160.50",
				"Legian" => "149.70",
				"Seminyak" => "145.35",
				"Kerobokan" => "137.85",
				"Jimbaran" => "168.00",
				"Nusa Dua" => "171.00",
				"Uluwatu" => "186.00",
				"Canggu" => "136.05",
				"Tanahlot" => "130.50",
				"Ubud" => "146.10",
				"Payangan" => "174.00",
				"Tegalalang" => "166.50",
				"Kintamani" => "193.50",
				"Candidasa" => "202.50",
				"Amed" => "240.00",
				"Lovina" => "120.75",
				"Pemuteran" => "90.75",
				"Gilimanuk" => "47.55",
				"Tabanan" => "111.75",
				"Kuta" => "137.25"
			];
		} elseif ( $pickup == "Ubud" ) {
			$data = [
				"Airport" => "57.15",
				"Legian" => "43.95",
				"Seminyak" => "45.30",
				"Kerobokan" => "39.60",
				"Jimbaran" => "63.30",
				"Nusa Dua" => "63.00",
				"Uluwatu" => "81.30",
				"Canggu" => "41.40",
				"Tanahlot" => "48.60",
				"Payangan" => "24.00",
				"Tegalalang" => "22.35",
				"Kintamani" => "52.50",
				"Candidasa" => "68.40",
				"Amed" => "105.75",
				"Lovina" => "109.35",
				"Pemuteran" => "174.00",
				"Gilimanuk" => "195.00",
				"Tabanan" => "37.65",
				"Negara" => "146.10",
				"Kuta" => "53.40"
			];
		} elseif ( $pickup == "Kuta" ) {
			$data = [
				"Airport" => "7.20",
				"Legian" => "5.55",
				"Seminyak" => "8.10",
				"Kerobokan" => "15.00",
				"Jimbaran" => "15.45",
				"Nusa Dua" => "19.80",
				"Uluwatu" => "33.45",
				"Canggu" => "21.60",
				"Tanahlot" => "32.55",
				"Ubud" => "53.40",
				"Payangan" => "76.65",
				"Tegalalang" => "77.40",
				"Kintamani" => "112.35",
				"Candidasa" => "96.45",
				"Amed" => "133.80",
				"Lovina" => "129.90",
				"Pemuteran" => "195.00",
				"Gilimanuk" => "184.50",
				"Tabanan" => "44.85",
				"Negara" => "137.25"
			];
		} elseif ( $pickup == "Payangan" ) {
			$data = [
				"Airport" => "78.30",
				"Legian" => "61.35",
				"Seminyak" => "62.10",
				"Kerobokan" => "56.55",
				"Jimbaran" => "84.60",
				"Nusa Dua" => "84.30",
				"Uluwatu" => "102.60",
				"Canggu" => "58.80",
				"Tanahlot" => "65.10",
				"Ubud" => "24.00",
				"Tegalalang" => "23.85",
				"Kintamani" => "35.70",
				"Candidasa" => "103.65",
				"Amed" => "119.85",
				"Lovina" => "118.65",
				"Pemuteran" => "189.00",
				"Gilimanuk" => "222.00",
				"Tabanan" => "65.85",
				"Negara" => "174.00",
				"Kuta" => "76.65"
			];
		}

		return $data[$destination];
	}

	public function get_destination_coordinate($destination)
	{
		$data = [
			"Airport" => "-8.748325,115.1648349",
			"Legian" => "-8.7043754,115.1629892",
			"Seminyak" => "-8.6899114,115.1566542",
			"Kerobokan" => "-8.6522444,115.1541187",
			"Jimbaran" => "-8.790609,115.14525",
			"Nusa Dua" => "-8.8190521,115.2155797",
			"Uluwatu" => "-8.8235708,115.0790143",
			"Canggu" => "-8.6425819,115.1269695",
			"Tanahlot" => "-8.6212118,115.0846145",
			"Ubud" => "-8.4961096,115.2310197",
			"Payangan" => "-8.4257655,115.1301082",
			"Tegalalang" => "-8.4441428,115.2707482",
			"Kintamani" => "-8.2499984,115.274953",
			"Candidasa" => "-8.5013214,115.5443327",
			"Amed" => "-8.335439,115.6422827",
			"Lovina" => "-8.1609538,115.0209923",
			"Pemuteran" => "-8.170573,114.6140583",
			"Gilimanuk" => "-8.1971895,114.4264948",
			"Tabanan" => "-8.4392037,114.9259631",
			"Negara" => "-8.3145408,114.5189401",
			"Kuta" => "-8.7263223,115.1365133"
		];

		return $data[$destination];
	}

	public function order_now($data)
	{
		$id_pesan = $this->get_last_id("pesan","id_pesan") + 1;
		$jemput = $data['jemput'];
		$antar = $data['antar'];
		$waktu = $data['waktu'];
		$price = $data['price'];
		$note = $data['note'];
		$no_telp = $data['no_telp'];
		$email = $data['email'];
		$insert = $this->exe("INSERT INTO pesan VALUES ('$id_pesan','$jemput','$antar','$waktu','$price','$note','$no_telp','$email')");
		if ( $insert > 0 ) {
			$this->notif("SUCCESS ORDER!","success");
		} else {
			$this->notif("FAIL TO ORDER!","danger");
			return mysqli_error($this->conn);
		}


		// foreach ($destinations as $destination) {
		// 	$id_detail = $this->get_last_id("pesandetail","id_detail") + 1;
		// 	$antar = $destination['destination'];
		// 	$waktu = $destination['date'] . " " . $destination['time'];
		// 	$price = $destination['cost'];
		// 	$this->exe("INSERT INTO pesandetail VALUES ('$id_detail','$id_pesan','$antar','$waktu','$price')");
		// }

		$order_details = [
			"pickup" => $jemput,
			"destination" => $antar,
			"price" => $price
		];
		$this->send_mail($email,$order_details);

		return "1";
	}

	public function pesandetail_get($id_pesan = null)
	{
		if ($id_pesan == null) {
			$query = "SELECT * FROM pesandetail";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM pesandetail WHERE id_pesan = '$id_pesan'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function inputmobil_add($data)
	{
		$merk = $data['merk'];
		$jenis = $data ['jenis'];
		$plat = $data['plat'];
		$gambar = $_FILES['gambar']['name'];
		$gambar_tmp = $_FILES['gambar']['tmp_name'];

		move_uploaded_file($gambar_tmp, "../assets/mobil/" . $gambar);

		$insert = $this->exe("INSERT INTO mobil(merk,jenis,plat,gambar) VALUES ('$merk','$jenis','$plat', '$gambar')");

		if ( $insert > 0 ) {
			$this->notif("SUCCESS TO INPUT!","success");
			$this->redirect("input_mobil.php");
		} else {
			$this->notif(mysqli_error($this->conn),"danger");
			return "0";
		}

	}
	
	public function inputpromo_add($data)
	{
		$gambar = $_FILES['gambar_promo']['name'];
		$gambar_tmp = $_FILES['gambar_promo']['tmp_name'];

		move_uploaded_file($gambar_tmp, "../assets/promo/" . $gambar);

		$insert = $this->exe("INSERT INTO promo(gambar_promo) VALUES ('$gambar')");

		if ( $insert > 0 ) {
			$this->notif("SUCCESS TO INPUT!","success");
			$this->redirect("input_promo.php");
		} else {
			$this->notif(mysqli_error($this->conn),"danger");
			return "0";
		}

	}

	public function promo_get($id_pesan = null)
	{
		if ($id_pesan == null) {
			$query = "SELECT * FROM promo";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM promo WHERE id_promo = '$id_promo'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function register($data)
	{
		$username = $data['username'];
		$password = $data['password'];

		$query = "SELECT * FROM users WHERE username = '$username'";
		if ( $this->num_rows($query) > 0 ) {
			$this->notif("Pick another Username","danger");
		} else {
			$insert = $this->exe("INSERT INTO users(username,password,level) VALUES ('$username','$password','user')");

			if ( $insert > 0 ) {
				$this->notif("REGISTRATION SUCCESSFULLY!","success");
			} else {
				$this->notif("REGISTRATION FAILED!","danger");
			}
		}

		$this->redirect($this->baseurl . "register.php");	
	}

	public function mobil_get($id_mobil = null)
	{
		if ($id_mobil == null) {
			$query = "SELECT * FROM mobil";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->query($query);
			}
		} else {
			$query = "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'";
			if ( $this->num_rows($query) < 1 ) {
				return 3;
			} else {
				return $this->get_data($query);
			}
		}
	}

	public function set_lang($lang = "id")
	{
		if ( $lang == "en" ) {
			$_SESSION["lang"] = "en";
		} else {
			$_SESSION["lang"] = "id";
		}
	}

	public function send_mail($email, $order_details)
	{

		$content = '<style>
      html,
      body {
          margin: 0 auto !important;
          padding: 0 !important;
          height: 100% !important;
          width: 100% !important;
          background: #f1f1f1;
      }
      * {
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
      }

      div[style*="margin: 16px 0"] {
          margin: 0 !important;
      }
      table,
      td {
          mso-table-lspace: 0pt !important;
          mso-table-rspace: 0pt !important;
      }
      table {
          border-spacing: 0 !important;
          border-collapse: collapse !important;
          table-layout: fixed !important;
          margin: 0 auto !important;
      }
      img {
          -ms-interpolation-mode:bicubic;
      }
      a {
          text-decoration: none;
      }
      *[x-apple-data-detectors],  /* iOS */
      .unstyle-auto-detected-links *,
      .aBn {
          border-bottom: 0 !important;
          cursor: default !important;
          color: inherit !important;
          text-decoration: none !important;
          font-size: inherit !important;
          font-family: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
      }
      .a6S {
          display: none !important;
          opacity: 0.01 !important;
      }
      .im {
          color: inherit !important;
      }
      img.g-img + div {
          display: none !important;
      }
      @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
          u ~ div .email-container {
              min-width: 320px !important;
          }
      }
      @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
          u ~ div .email-container {
              min-width: 375px !important;
          }
      }
      @media only screen and (min-device-width: 414px) {
          u ~ div .email-container {
              min-width: 414px !important;
          }
      }

      	    .primary{
      	background: #2f89fc;
      }
      .bg_white{
      	background: #ffffff;
      }
      .bg_light{
      	background: #fafafa;
      }
      .bg_black{
      	background: #000000;
      }
      .bg_dark{
      	background: rgba(0,0,0,.8);
      }
      .email-section{
      	padding:2.5em;
      }

      .btn{
      	padding: 5px 15px;
      	display: inline-block;
      }
      .btn.btn-primary{
      	border-radius: 5px;
      	background: #2f89fc;
      	color: #ffffff;
      }
      .btn.btn-white{
      	border-radius: 5px;
      	background: #ffffff;
      	color: #000000;
      }
      .btn.btn-white-outline{
      	border-radius: 5px;
      	background: transparent;
      	border: 1px solid #fff;
      	color: #fff;
      }

      h1,h2,h3,h4,h5,h6{
      	font-family: "Work Sans", sans-serif;
      	color: #000000;
      	margin-top: 0;
      	font-weight: 400;
      }

      body{
      	font-family: "Work Sans", sans-serif;
      	font-weight: 400;
      	font-size: 15px;
      	line-height: 1.8;
      	color: #000;
      }

      a{
      	color: #2f89fc;
      }

      table{
      }
      /*LOGO*/

      .logo h1{
      	margin: 0;
      }
      .logo h1 a{
      	color: #000000;
      	font-size: 20px;
      	font-weight: 700;
      	text-transform: uppercase;
      	font-family: "Poppins", sans-serif;
      }

      .navigation{
      	padding: 0;
      }
      .navigation li{
      	list-style: none;
      	display: inline-block;;
      	margin-left: 5px;
      	font-size: 13px;
      	font-weight: 500;
      }
      .navigation li a{
      	color: rgba(0,0,0,.4);
      }

      .hero{
      	position: relative;
      	z-index: 0;
      }

      .hero .text{
      	color: rgba(0,0,0,.3);
      }
      .hero .text h2{
      	color: #000;
      	font-size: 30px;
      	margin-bottom: 0;
      	font-weight: 300;
      }
      .hero .text h2 span{
      	font-weight: 600;
      	color: #2f89fc;
      }


      .heading-section{
      }
      .heading-section h2{
      	color: #000000;
      	font-size: 28px;
      	margin-top: 0;
      	line-height: 1.4;
      	font-weight: 400;
      }
      .heading-section .subheading{
      	margin-bottom: 20px !important;
      	display: inline-block;
      	font-size: 13px;
      	text-transform: uppercase;
      	letter-spacing: 2px;
      	color: rgba(0,0,0,.4);
      	position: relative;
      }
      .heading-section .subheading::after{
      	position: absolute;
      	left: 0;
      	right: 0;
      	bottom: -10px;
      	content: "";
      	width: 100%;
      	height: 2px;
      	background: #2f89fc;
      	margin: 0 auto;
      }

      .heading-section-white{
      	color: rgba(255,255,255,.8);
      }
      .heading-section-white h2{
      	font-family: 
      	line-height: 1;
      	padding-bottom: 0;
      }
      .heading-section-white h2{
      	color: #ffffff;
      }
      .heading-section-white .subheading{
      	margin-bottom: 0;
      	display: inline-block;
      	font-size: 13px;
      	text-transform: uppercase;
      	letter-spacing: 2px;
      	color: rgba(255,255,255,.4);
      }


      @media screen and (max-width: 500px) {


      }


		    </style>
		<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly;">
			<center style="width: 100%; background-color: #f1f1f1;">
		    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
		    	<!-- BEGIN BODY -->
		      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; background: #fff;">
		      	<tr>
		          <td valign="top" class="bg_white" style="padding: 1em 2.5em;">
		          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		          		<tr>
		          			<td class="logo" style="text-align: center;">
					            <h1>GET TRANSFER</h1>
					          </td>
		          		</tr>
		          	</table>
		          </td>
			      </tr><!-- end tr -->
						<tr>
		          <td valign="middle" class="hero hero-2 bg_white" style="padding: 1em 2em;">
		            <table style="text-align: left !important;" align="left">
            	<tr>
            		<td>
            			<div class="text" style="padding: 0 3em; text-align: left;">
	            			<p>Hello, '. $email .'</p>
	            			<p>
	            				Thank you for ordering <span>Get Transfer</span> service
	            			</p>
	            			<p>Here are the details of your order:</p>
            			</div>
            		</td>
            	</tr>
            	<tr><td>&nbsp;</td></tr>
	            <tr>
	    			<table border="1" width="100%" cellspacing="0">
	    				<tr>
	    					<td>Pickup</td>
	    					<td>'. $order_details['pickup'] .'</td>
	    				</tr>
	    				<tr>
	    					<td>Destination</td>
	    					<td>'. $order_details['destination'] .'</td>
	    				</tr>
	    				<tr>
	    					<td>Price</td>
	    					<td>$'. $order_details['price'] .'</td>
	    				</tr>
	    			</table>
	            </tr>
	            <tr style="background: #fff;">
	            	<td>
            			<div class="text" style="padding: 1em 3em; text-align: left;">
	            			<p>Thank you for choosing our service. You are welcome to wait for our drivers according to the specified hours.</p>
	            			<p>Kind Regards,</p>
	            			<p>Get Transfer</p>
            			</div>
            		</td>
	            </tr>
            </table>
		          </td>
			      </tr><!-- end tr -->
		      </table>

		    </div>
		  </center>
		</body>';

		$this->mail->SMTPDebug = 0;
		$this->mail->isSMTP();                                      
		$this->mail->Host = 'smtp.gmail.com';  
		$this->mail->Mailer   = "smtp";
		$this->mail->SMTPAuth = true;                               
		$this->mail->Username = 'gettrans.rgb@gmail.com';              
		$this->mail->Password = 'gettrans123';                         
		$this->mail->SMTPSecure = 'tls';                            
		$this->mail->Port = 587;                                    

		$this->mail->setFrom('receipt@gettransfer.com', 'Get Transfer');
		$this->mail->addAddress($email, $email);
		$this->mail->isHTML(true);

		$this->mail->Subject = 'Your receipt';
		$this->mail->Body    = $content;

		if(!$this->mail->send()) {
		    echo 'Message could not be sent.';
		    return 'Mailer Error: ' . $this->mail->ErrorInfo;
		} else {
		    return '1';
		}
		
	}
}	