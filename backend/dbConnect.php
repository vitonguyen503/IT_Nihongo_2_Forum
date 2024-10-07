<?php

$host = "localhost";
$username = "root";
$dbName = "forum";
$password = "Zuka03@*";

$conn = mysqli_connect($host, $username, $password, $dbName);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else
{
    // echo "Connect successfully";
}
