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
		$this->conn = mysqli_connect("localhost","dimas","dimas","db_rentalmobil");
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

	public function get_destination_coordinate($destination)
	{
		$data = [
			"Kuta" => "-8.7263223,115.1365133",
			"Legian" => "-8.7043754,115.1629892",
			"Seminyak" => "-8.6899114,115.1566542",
			"Kerobokan" => "-8.6522444,115.1541187",
			"Jimbaran" => "-8.790609,115.14525",
			"Nusa Dua" => "-8.8190521,115.2155797",
			"Uluwatu" => "-8.8235708,115.0790143",
			"Canggu" => "-8.6425819,115.1269695",
			"Tanahlot" => "-8.6212118,115.0846145",
			"Ubud" => "-8.4961096,115.2310197",
			"Tegalalang" => "-8.4441428,115.2707482",
			"Kintamani" => "-8.2499984,115.274953",
			"Candidasa" => "-8.5013214,115.5443327",
			"Amed" => "-8.335439,115.6422827",
			"Lovina" => "-8.1609538,115.0209923",
			"Pemuteran" => "-8.170573,114.6140583",
			"Gilimanuk" => "-8.1971895,114.4264948",
			"Tabanan" => "-8.4392037,114.9259631",
			"Negara" => "-8.3145408,114.5189401",
			"DPS" => "-8.7173875,115.1448732",
			"Sanur" => "-8.6958047,115.2420168"
		];

		return $data[$destination];
	}

	public function order_now($data)
	{
		$id_pesan = $this->get_last_id("pesan","id_pesan") + 1;
		$note = $data['note'];
		$no_telp = $data['no_telp'];
		$email = $data['email'];
		$destinations = $data['destinations'];

		$insert = $this->exe("INSERT INTO pesan VALUES ('$id_pesan','$note','$no_telp','$email')");
		if ( $insert > 0 ) {
			$this->notif("PESANAN BERHASIL!","success");
		} else {
			$this->notif("PESANAN GAGAL!","danger");
			return "0";
		}


		foreach ($destinations as $destination) {
			$id_detail = $this->get_last_id("pesandetail","id_detail") + 1;
			$antar = $destination['destination'];
			$waktu = $destination['date'] . " " . $destination['time'];
			$price = $destination['cost'];
			$this->exe("INSERT INTO pesandetail VALUES ('$id_detail','$id_pesan','$antar','$waktu','$price')");
		}

		$this->send_mail($email,$destinations);

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
			$this->notif("INPUT BERHASIL!","success");
			$this->redirect("input_mobil.php");
		} else {
			$this->notif(mysqli_error($this->conn),"danger");
			return "0";
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
				$this->notif("REGISTER BERHASIL!","success");
			} else {
				$this->notif("REGISTER GAGAL!","danger");
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
	    				<thead>
	    					<tr>
	    						<th width="50">#</th>
	    						<th>Destination</th>
	    						<th>Time</th>
	    						<th>Price</th>
	    					</tr>
	    				</thead>
	    				<tbody>';
		$i = 1;	    				
	    foreach ($order_details as $order) {
	    	$content .= '
	    		<tr>
					<td>'. $i++ .'</td>
					<td>'. $order['destination'] .'</td>
					<td>'. $order['date'] . " " . $order['time'] .'</td>
					<td>'. $order['cost'] .'</td>
				</tr>
	    	';
	    }

	    $content .= '</tbody>
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