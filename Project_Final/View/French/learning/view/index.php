<?php
//To connect to database
include '../../../../Model/database.php';
?>
<?php
//Session Start
session_start();
?>
<?php
//Store userID session variable
$user = $_SESSION['userID'];

//Get users incorrect words from overallIncorrect using userID
$query = "SELECT * FROM overallIncorrect WHERE userID = $user";
$results = $mysqli->query($query);
$incorrect = $results->num_rows;

//Get list of all Spanish words, from here they will not have been words from
//user inputs
$query = "SELECT * FROM testFrenchWord WHERE wordID <= 53";
$words = $mysqli->query($query);

//Session variables set
$_SESSION['counter'] = 0;

$_SESSION['score'] = 0;

$_SESSION['learning'] = 0;

$_SESSION['text_entry'] = 0;

//Get start and last numbers from URL
$start = (int) $_GET['start'];

$last = (int) $_GET['last'];

$_SESSION['correctanswer'] = 0;

//Set variable
$firstnumber = 1;

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
        <title>TLL- Beginner French Learning Environment</title>
        <link rel="stylesheet" href="../../../../Model/Style/css.css" type="text/css" />
        <link rel="icon" sizes="192x192" href="../../../Start/world.png" />
        <link rel="apple-touch-icon" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../../../Start/icon.png"/>
        <link rel="shortcut icon" href="../../../Start/world.png" type="image/x-icon" />
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
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Languages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../../../French/frenchhome.php">French</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>

                        <li><a href="../../../../Model/Logout/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!--Wrapper used to hold all page content-->
        <div class="wrapper">
            <div class="container-fluid text-center">    
                <div class="row content">
                    <div class="col-sm-12">
                        <div class="jumbotron">
                            <h1>Welcome to the Basic French Learning Environment</h1>
                            <p>Here you will be tested on basic French words and phrases through different techniques</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
             <!--Randomising words from start and last being ranges-->
            <?php
            $random = range($start, $last);
            shuffle($random);
            $_SESSION['random'] = $random;
//                shuffle($_SESSION['random']);
            ?>
             <!--Randomising incorrect words from start and last being ranges-->
            <?php
            if ($incorrect <= 1) {
                $_SESSION['incorrect'] = array();
            } else {
                $randoms = range($firstnumber, $incorrect);
                shuffle($randoms);
                $_SESSION['incorrect'] = $randoms;
            }
            ?>


            <div class="container-fluid text-center">
                <div class="raw content">
                    <div class="col-sm-4 text-center">
                        <h2>Test yourself</h2>
                        <br>

                        <p>This is an un-timed multiple choice quiz</p>
                        <br>
                        <ul>
                            <li><strong>Number of questions: </strong>10</li> 
                            <li><strong>Multiple Choice and Text Entry Questions</strong></li>
                            <li><strong>Estimated time: </strong>5 Minutes</li>
                        </ul>
                        <br>

                    </div> 

                    <div class="col-sm-4">
                        <!--User will be forwarded to question page when started-->
                        <a href="question.php?n=<?php echo ($_SESSION['random'][0]); ?>" class="start">Start</a>  
                    </div>
                    <div class="col-sm-4">
                        <div class="pre-scrollable">
                            <h3>Total French Words</h3>
                            <br>
                            <!--List of all words from language, with tool tip translation-->
                            <?php
                            if ($words->num_rows > 0) {
                                // output data of each row
                                while ($row = $words->fetch_assoc()) {
                                    echo "<p data-toggle='tooltip' title='" . $row['word'] . "' onclick='talk()'> Word- " . $row["translation"] . "</p><br>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>




                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--For testing-->
        <?php // print_r(array_values($_SESSION['random'])); ?>
        
        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>


        <script>
            //tooltip function, used to show information when user hovers
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
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

