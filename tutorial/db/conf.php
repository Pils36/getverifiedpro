<?php
$servername = "localhost";
$username = "profilr_trm";
$password = "oluwagbenga1993";
$db = "profilr_trm";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>