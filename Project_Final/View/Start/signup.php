<?php
//Session Start
session_start();

//Check if user is logged in
if (isset($_SESSION['userID'])) {
    header("Location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TLL-Sign Up</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <link rel="stylesheet" href="../../Model/Style/css.css" type="text/css" />
        <link rel="icon" sizes="192x192" href="world.png" />
        <link rel="apple-touch-icon" href="icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="icon.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="icon.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="icon.png"/>
        <link rel="shortcut icon" href="world.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <!--Main Body for Page-->
    <body>
        <!--NavBar-->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="signin.php">TLL</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="signup.php">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!--Wrapper to hold page content-->
        <div class='wrapper'>   
            <div class="col-sm-20">
                <div class="container">
                    <div class="jumbotron" >
                        <!--Input boxes for signing up-->
                        <center> <h2>Sign up for Free</h2></center>
                        <br>
                        <!--Form, which calls an action to sign up-->
                        <form name="form" action="../../Controller/Start/signup_process.php" method="POST" onsubmit="return validateForm()" class="text-center">
                            <input type="text" name="firstname" placeholder="First Name" autocomplete="off">
                            <br> <br>
                            <input type="text" name="secondname" placeholder="Second Name" autocomplete="off">
                            <br> <br>
                            <input type="email" name="email" placeholder="Email" autocomplete="off">
                            <br> <br>
                            <input type="text" name="username" placeholder="Username" autocomplete="off">
                            <br> <br>
                            <input type="password" name="password" placeholder="Password" autocomplete="off">
                            <br> <br>
                            <!--Submit, once pressed form action is called-->
                            <button type="submit">Sign up</button>
                        </form>

                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 text-center" style="background-color:#cccccc;">TLL provides fast and easy to use system</div>
                <div class="col-sm-4 text-center" style="background-color:#cccccc;">Join FREE today!</div>
                <div class="col-sm-4 text-center" style="background-color:#cccccc;">Accessable mobile phones, laptops and tablets</div>
            </div>
        </div>  

        <script>
            //Validation for all input fields
            function validateForm() {
                var x = document.forms["form"]["firstname"].value;
                if (x == "") {
                    alert("Field(s) empty");
                    return false;
                }
                var y = document.forms["form"]["secondname"].value;
                if (y == "") {
                    alert("Field(s) empty");
                    return false;
                }
                var e = document.forms["form"]["email"].value;
                if (e == "") {
                    alert("Field(s) empty");
                    return false;
                }
                var u = document.forms["form"]["username"].value;
                if (u == "") {
                    alert("Field(s) empty");
                    return false;
                }
                var p = document.forms["form"]["password"].value;
                if (e == "") {
                    alert("Field(s) empty");
                    return false;
                }
            }
        </script>
        
        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>


    </body>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

