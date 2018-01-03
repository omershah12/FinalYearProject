<?php
//Start Session
session_start();
//Session counter set to 0
$_SESSION['counter'] = 0;
?>
<?php
//Including correcttruncatefile.php file, which provides all the information
//concerning truncation of quiz results
include '../../../Controller/French/multiplechoice/correcttruncate.php';
?>
<?php

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
        <title>Quiz</title>
        <link rel="stylesheet" href="../../Model/Style/fenchmultiple.css" type="text/css" />
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

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../../Model/Logout/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
            </div>
        </nav>

        <header>
            <div class="container">
                <h1>Quiz</h1>
            </div>
        </header>
        <main>
            <!--Container displaying user result-->
            <div class="container">
                <h2>You are done</h2>
                <p><?php echo $_SESSION['firstname']; ?> congrats you have completed the test</p>
                <p>Final Score: <?php echo $_SESSION['score']; ?></p>
                <p>Correct Words</p>
                <br>
                <p><?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "Word: " . $row["word"] . " - Translation: " . $row["translation"] . "<br><br>";
                        }
                    } else {
                        echo "No correct answers";
                    }
                    ?></p>
                <!--Form processes truncates quiz result when sumbitted-->
                <form method="post" action="../../../Controller/French/timed/correcttruncate.php">
                    <input type="submit" id='delete' class='delete' name="delete" value='Truncate'>
                </form>

            </div>
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


