<?php
$hostName = '127.0.0.1';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'web_uas';

// Create connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
