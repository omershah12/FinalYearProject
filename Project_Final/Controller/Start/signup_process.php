<?php
//Session Start
session_start();

//To connect to database
include '../../Model/database.php';

//get firstname from signup.php
$firstname = $_POST['firstname'];

//get secondname from signup.php
$secondname = $_POST['secondname'];

//get email from signup.php
$email = $_POST['email'];

//get username from signup.php
$username = $_POST['username'];

//get password from signup.php
$password = $_POST['password'];

//insert into mysql table
$query = "INSERT INTO user(firstname, secondname, email, username, password) "
        . "VALUES ('$firstname', '$secondname', '$email', '$username', '$password')";

$results = $mysqli->query($query);

//user taken back to signin page to signin
header("Location: ../../View/Start/signin.php");
?>        

