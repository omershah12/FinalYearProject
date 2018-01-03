<?php
//Start Session
session_start();

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location:../../View/Start/signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TLL-Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <link rel="stylesheet" href="../../Model/Style/css.css" type="text/css" />
        <link rel="icon" sizes="192x192" href="world.png" />
        <link rel="apple-touch-icon" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../Start/icon.png"/>
        <link rel="shortcut icon" href="../Start/world.png" type="image/x-icon" />
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
                    <!--User will be returned to home.php when clicked-->
                    <a class="navbar-brand" href="home.php">TLL</a>
                </div>
                <!--User will be shown languages when clicked-->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Languages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../../View/French/frenchhome.php">French</a></li>
                                <li><a href="../../View/Spanish/spanishhome.php">Spanish</a></li>
                            </ul>
                        </li>
                        <!--User will be logged out when clicked-->
                        <li><a href="../../Model/Logout/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!--Wrapper used to hold all page content-->
        <div class='wrapper'>
            <div class="container">
                <!--Jumbotron class-->
                <div class="jumbotron">
                   <h1>Need help <?php echo $_SESSION['firstname']; ?>...?</h1>
                   <p>TLL is used to provide interactive learning for you. Simply check out the languages on offer by clicking
                   languages in the top menu bar to start!</p>
                        <hr>
                        <h3></h3>
                        <p>If you are still unsure, please do not hesitate to contact us at
                        wyb13132@uni.strath.ac.uk</p>
                </div>

            </div>

        </div> 
        
        <!--Footer Class-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>

    </body>
</html>
