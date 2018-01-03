<?php
//Session start
session_start();
//To connect to database
include '../../Model/database.php';

//get username from signin.php
$username = $_POST['username'];

//get password from signin.php
$password = $_POST['password'];

//check if user has correct username password
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$results = $mysqli->query($query);

if (!$row = $results->fetch_assoc()) {
    echo"Your username or password is incorrect";
} else {
    //authentication for user
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['login'] = true;
}
//user passed on to home page
header("Location: ../../View/Home/home.php");
?>        

