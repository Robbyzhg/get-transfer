<?php 

include 'functions.php';

$myfunc = new functions();

if ( isset($_POST['get_destination_cost']) ) {
	echo $myfunc->get_destination_cost($_POST['destination']);
} elseif ( isset($_POST['order']) ) {
	echo $myfunc->order_now($_POST);
} elseif ( isset($_POST['get_destination_coordinate']) ) {
	echo $myfunc->get_destination_coordinate($_POST['destination']);
} elseif ( isset($_POST['get_destination']) ) {
	echo json_encode($myfunc->get_destinations($_POST['previous']));
}