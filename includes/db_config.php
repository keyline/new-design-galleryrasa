<?php

$pageurl = "";

$servername = "localhost";

$username = "arijit81_demo";

$password = "india@123$$";

$dbname = "arijit81_tampernew";



// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

?>