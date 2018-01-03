<?php
//Session Start
session_start();

//To check if user is logged in
if (isset($_SESSION['userID'])) {
    header("Location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Welcome to TLL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
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

    <!--Main Body of Page-->
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
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
                        <li><a href="signup.php">Sign up</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Wrapper to hold page content-->
        <div class='wrapper'>
            <div class="container">
                <br>
                <!--Carousel for displaying images-->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">

                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Class to hold text/image-->
                    <div class="carousel-inner" role="listbox">
                        <!--Image 1-->
                        <div class="item active">
                            <img src="world.jpg" alt="Chania" width="1000" height="345">
                            <div class="carousel-caption">
                                <h3>Welcome to TLL</h3>
                                <p>Embark on a new journey and learn a new language!</p>
                            </div>
                        </div>
                        <!--Image 2-->
                        <div class="item">
                            <img src="france.jpg" alt="France" width="1000" height="345">
                            <div class="carousel-caption">
                                <h3>French</h3>
                                <p>Learn basic words and phrases in different languages!</p>
                            </div>
                        </div>

                        <!--Image 3-->
                        <div class="item">
                            <img src="spain.jpg" alt="France" width="1000" height="345">
                            <div class="carousel-caption">
                                <h3>Spanish</h3>
                                <p>Why not give Spanish a try?</p>
                            </div>
                        </div>
                        <!--Left Button-->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <!--Right button-->
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>


                    </div>
                </div>
            </div>
            <br>
            <div class="container">

                <!-- Modal for login modal -->
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="myBtn">Login</button>
                    </div>
                </div>
                
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!--Content of modal-->
                        <div class="modal-content">
                            <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <!--Form for login, action signin_process caled-->
                                <form action="../../Controller/Start/signin_process.php" method="POST" role="form">
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                        <input type="text" class="form-control"  name="username" id="username" placeholder="Enter username" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off">
                                    </div>
                                    <!--Form action called when user clicks submit-->
                                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--User will be forwarded to signup page-->
                                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <p>Not a member? <a href="../../View/Start/signup.php">Sign Up</a></p>

                            </div>
                        </div>

                    </div>
                </div> 
            </div>
        </div>

        <br>
        
        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>
        
        <script>
            //jQuery used to activate signin modal
            $(document).ready(function () {
                $("#myBtn").click(function () {
                    $("#myModal").modal();
                });
            });
        </script>
    </body>
</html>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

