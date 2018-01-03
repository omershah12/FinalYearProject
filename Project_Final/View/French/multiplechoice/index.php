<?php
//To connect to database
include '../../../Model/database.php';
?>
<?php //Session Start
session_start(); ?>
<?php

//find max number of words for french
$query = "SELECT MAX(questionID)AS total FROM testFrenchChoice";
$result = $mysqli->query($query);
$total = $result->fetch_assoc();

//session variables set
$_SESSION['counter'] = 0;

$_SESSION['score'] = 0;

//get start numbers from url
$start = (int) $_GET['start'];

$last = (int) $_GET['last'];

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../View/Start/signin.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>TLL- Beginner French Quiz</title>
        <link rel="stylesheet" href="../../../Model/Style/frenchmultiple.css" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<!--Main Body of Page-->
    <body>
        <!--NavBar-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"></a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Languages <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
            </div>
        </nav>

        <header>
            <div class="container">
                <center><h1>Quiz- Beginner French 1</h1></center>
            </div>
        </header>
        
        <!--Randomising words from start and last being ranges-->
        <?php
        $random = range($start, $last);
        shuffle($random);
        $_SESSION['random'] = $random;
//                shuffle($_SESSION['random']);
        ?>


        <main>
            <center>
                <div class="container">

                    <h2>Test yourself</h2>

                    <p>This is an un-timed multiple choice quiz</p>

                    <p> <?php echo $test['text']; ?></p>
                    <ul>
                        <li><strong>Number of questions: </strong><?php echo $total['total']; ?></li>
                        <li><strong>Multiple Choice</strong></li>
                        <li><strong>Estimated time: </strong><?php echo $total['total'] * 0.5; ?> Minutes</li>
                    </ul>
                    <!--User will be forwarded to question page when started-->
                    <a href="question.php?n=<?php echo ($_SESSION['random'][0]); ?>" class="start">Start</a>
                </div>
                <!--Print array used to check if word array-->
                <?php print_r(array_values($_SESSION['random'])); ?>

            </center>
        </main>
         <!--Footer-->
        <footer>
            <div class="container">
                Copyright &COPY; 2017 Quiz
            </div>
        </footer>
    </body>
</html>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

