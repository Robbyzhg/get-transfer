<?php 

include 'config/functions.php';

$myfunc = new functions();

echo $myfunc->get_last_id("pesan","id_pesan");