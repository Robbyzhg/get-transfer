<?php 

$get = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&origins=1.1768156,104.0210475&destinations=1.1683977,104.0155569");

var_dump(json_decode($get));

$tes = json_decode($get)->rows[0]->elements[0]->distance->value / 1000;
echo floor($tes);