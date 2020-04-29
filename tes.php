<?php 

include 'config/functions.php';

$myfunc = new functions();
$destination = [
	["destination" => "kuta", "date" => "02-02-2020", "cost" => "$10-$20"],
	["destination" => "lembang", "date" => "02-02-2020", "cost" => "$10-$20"],
	["destination" => "seminyak", "date" => "02-02-2020", "cost" => "$10-$20"]
];
$myfunc->send_mail("d9firmansyah@gmail.com", $destination);
?>
