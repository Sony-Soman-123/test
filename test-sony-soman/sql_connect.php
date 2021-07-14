<?php
$mysqli = new mysqli("localhost","root","","test_sony_soman");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>