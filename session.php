<?php
// mysqli_connect() function opens a new connection to the MySQL server.
//$conn = mysqli_connect("localhost", "id17042954_userdpwh", "bMm[vBDY|[3K_?Gk", "id17042954_dpwh");
$conn = mysqli_connect("localhost", "root", "", "dpwh");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT username from tbl_admin where username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
?>