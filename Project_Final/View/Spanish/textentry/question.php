<?php
//Connect to database
include '../../../Model/database.php';
//Used to get information on question
include '../../../Controller/Spanish/multiplechoice/questiondatabase.php';
?>

<?php
//Session Start
session_start();

//if counter not set, set to 0
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

//if score not set, set to 0
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../View/Start/signin.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>TLL- Basic Spanish 1- <?php echo $_SESSION['firstname']; ?></title>
        <link rel="stylesheet" href="../../../Model/Style/frenchmultiple.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script>
            //used to hide multiple choice values when page loaded
            $(document).ready(function () {

                $("main").hide();
                //choices shown when user click show
                $("#show").click(function () {
                    $("main").show();
                    $("#word").hide();
                });
            });
        </script>
    </head>
    
    <body>
        <header>
            <div class="container">
                <h1>Quiz</h1>
            </div>
        </header>


        <div id = "word" class="container">
             <!--Used to print translation for word-->
            <div class="current">English Word <?php echo $question['translation']; ?> </div>
        </div>

        <main>
            <div class="container">
                <!--To try get question out of-->
                <div class="current">Question <?php // echo $question['question_number'];       ?> of <?php echo $total; ?> <?php echo $_SESSION['score']; ?></div>
                <p class="question">

                    <br>
                    <!--For testing-->
                    <?php // echo $question['question'];?>
                    <?php
                    //  if($userChoices->num_rows>=0){
//                        echo ("Empty");
//                    }
//                    else{
//                        echo ("failed");
//                    }
                    ?>
                </p>
                <!--Form, process called when user clicks submit-->
                <form method="post" action="../../../Controller/Spanish/textentry/process.php">
                    <!--Input for user input-->
                    <input type ="text" value="" name="user_answer"/>
                    <input type="submit"  value="Submit"/>
                    <!--For testing-->
                    <p><?php echo $correct_choice ?></p>


                    <!--Hidden inputs-->
                    <input type="hidden" name="number" value="<?php echo $number; ?>" />
                    <input type="hidden" name="text" value="<?php echo $question['answer']; ?>" />
                    <input type ="hidden" name="question" value="<?php
                    $_SESSION['counter'] ++;
                    echo $_SESSION['counter']
                    ?>" />

                    <p id="demo"></p>
                </form>
            </div>

        </main>
        <!--Hide and show buttons-->
        <button id="hide">Hide</button>
        <button id="show">Show</button>
        
        <!--Score-->
        <p><?php echo $_SESSION['score']; ?></p>

        <!--Footer-->
        <footer>
            <div class="container">
                Copyright &COPY; 2017 TLL
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





