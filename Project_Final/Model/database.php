<?php

//information to log into MySQL database
$servername = "devweb2016.cis.strath.ac.uk";
$username = "wyb13132";
$password = "iePhee3otur5";
$dbname = "wyb13132";



// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

$mysqli->query('SET NAMES utf8');
