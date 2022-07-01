<?php
$servername = "localhost";
//$username = "id17042954_userdpwh";
//$password = "bMm[vBDY|[3K_?Gk";
//$dbname = "id17042954_dpwh";
$username = "root";
$password = "";
$dbname = "dpwh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>