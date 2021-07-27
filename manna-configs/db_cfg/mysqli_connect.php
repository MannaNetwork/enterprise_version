<?php

$mysqli = new mysqli($servername, $username, $password, $dbname);
if($mysqli->connect_error) {
  exit('<br>Error connecting to database mysqli connect'); //Should be a message a typical user could understand in production
}
$mysqli->set_charset("utf8mb4");


?> 
