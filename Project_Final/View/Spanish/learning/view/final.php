<?php
//Session Start
session_start();
//Set counter to 0
$_SESSION['counter'] = 0;
?>
<?php
//Used to get quiz answers
include '../controller/correctanswers.php';

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}
//set session variables
$userid = $_SESSION['userID'];
$score = $_SESSION['score'];

//query, finds user scores for language
$query = "INSERT INTO spanishScores(userID, score) VALUES ($userid, $score)";
$results = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
        <title>Quiz-Results</title>
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

                    <a class="navbar-brand">TLL</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                </div>
            </div>
        </nav>
        <br>
        
         <!--Wrapper used to hold all page content-->
        <div class="wrapper"> 
            <div class="container-fluid">
                <div class="row-content">
                    <div class="col-sm-4 text-center">
                        <div class="well">
                            <p><u>Correct Words</u></p>
                             <!--Correct words displayed here-->
                            <p><?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "Word: " . $row["word"] . " - Translation: " . $row["translation"] . "<br> Counts- " . $row["COUNT(testSpanishQuizCorrect.wordID)"] . "<br><br>";
                                    }
                                } else {
                                    echo "No correct answers";
                                }
                                ?></p>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="jumbotron">
                            <h2>You are done</h2>
                             <!--User score printed here-->
                            <p><?php echo $_SESSION['firstname']; ?> congrats you have completed the quiz</p>
                            <p>Final Score: <?php echo $_SESSION['score']; ?></p>

                             <!--Form, user has no option but to click home-->
                            <form method="post" action="../controller/correctanswers.php">
                                <input type="submit" id='delete' class='delete' name="delete" value='Home'>
                            </form> 
                        </div>
                    </div>
                    <br>
                    <!--Incorrect words displayed here-->
                    <div class="col-sm-4 text-center">
                        <div class="well">

                            <p><u>Incorrect Words</u></p>
                            <br>
                            <p><?php
                                if ($incorrecrtResult->num_rows > 0) {
                                    while ($rows = $incorrecrtResult->fetch_assoc()) {
                                        echo "Word: " . $rows["word"] . " - Translation: " . $rows["translation"] . "<br> Counts- " . $rows["COUNT(testSpanishQuizIncorrect.wordID)"] . "<br>";
                                    }
                                } else {
                                    echo "No incorrect answers";
                                }
                                ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>
        
         <!--If user presses back button-->
        <script>
            jQuery(document).ready(function ($) {

                if (window.history && window.history.pushState) {

                    $(window).on('popstate', function () {
                        var hashLocation = location.hash;
                        var hashSplit = hashLocation.split("#!/");
                        var hashName = hashSplit[1];

                        if (hashName !== '') {
                            var hash = window.location.hash;
                            if (hash === '') {
                                //user will be displayed alert that they will be returned to index
                                alert('You will be returned to the French home page');
                                window.location = 'index.php?start=1&last=10';
                                return false;
                            }
                        }
                    });

                    window.history.pushState('forward', null, './#forward');
                }

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


