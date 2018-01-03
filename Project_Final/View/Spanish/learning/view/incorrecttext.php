<?php
//Connect to database
include '../model/database.php';
//Used to get information on question
include '../controller/question_database.php';
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
    header("Location: ../../../Start/signin.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
        <title>TLL- Basic Spanish 1- <?php echo $_SESSION['firstname']; ?></title>
        <link rel="stylesheet" href="../../../../Model/Style/css.css" type="text/css" />
        <link rel="icon" sizes="192x192" href="../../../Start/world.png" />
        <link rel="apple-touch-icon" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../../../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../../../Start/icon.png"/>
        <link rel="shortcut icon" href="../../../Start/world.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script>
            $(document).ready(function () {
                //used to hide multiple choice values when page loaded
                $("main").hide();
                //choices shown when user click show
                $("#show").click(function () {
                    $("main").show();
                    $("#word").hide();
                    $("#show").hide();
                });
            });
        </script>

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
        
        <!--Wrapper used to hold all page content-->
        <div class="wrapper"> 
            <div class="container-fluid text-center">    
                <div class="row content">
                    <div class="col-sm-12">
                        <div class="jumbotron">
                             <!--English Word will be displayed here-->
                            <h1>Question</h1>
                            <p>English Word <?php echo $incorrect['word']; ?> </p>
                            <p>Translation...?</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row-content">
                    <div class="col-sm-12 text-center">
                        <!--Question for user-->
                        <p><strong>What is the translation for the word "<?php echo $incorrect['word'] ?>"</strong></p>
                    </div>
                </div>
            </div>
            <main>           
                <div class="container-fluid">
                    <div class="row-content">
                        <div class="col-sm-12 text-center">
                            <!--Form for text entry, process will be called when submit after validation-->
                            <form name="form" method="post" action="../controller/textentry_process.php" onsubmit="return validateForm()">
                                 <!--Text input box for user answer-->
                                <input id="user" type ="text" value="" name="user_answer" autocomplete="off"/>
                                
                                <br>
                                <br>
                                 <!--Buttons for special symbols that may not feature on traditional English keyboard-->
                                <input type='button' id='eacute' value='é' onclick="document.form.user_answer.value += 'é'">
                                <input type='button' id='agrave' value='à' onclick="document.form.user_answer.value += 'à'">
                                <input type='button' id='egrave' value='è' onclick="document.form.user_answer.value += 'è'">
                                <input type='button' id='ugrave' value='ù' onclick="document.form.user_answer.value += 'ù'">
                                <input type='button' id='acirc' value='â' onclick="document.form.user_answer.value += 'â'">
                                <input type='button' id='ecirc' value='ê' onclick="document.form.user_answer.value += 'ê'">
                                <input type='button' id='icirc' value='î' onclick="document.form.user_answer.value += 'î'">
                                <input type='button' id='ocirc' value='ô' onclick="document.form.user_answer.value += 'ô'">
                                <input type='button' id='ucirc' value='û' onclick="document.form.user_answer.value += 'û'">

                                <input type='button' id='auml' value='ä' onclick="document.form.user_answer.value += 'ä'">
                                <input type='button' id='euml' value='ë' onclick="document.form.user_answer.value += 'ë'">
                                <input type='button' id='uuml' value='ü' onclick="document.form.user_answer.value += 'ü'">
                                <input type='button' id='ccedil' value='ç' onclick="document.form.user_answer.value += 'ç'">

                                <br>

                                <br> 
                                 
                                <input type="submit"  value="Submit"/>
                                <!--For testing-->
                                <p><?php // $incorrect['word']       ?></p>
                                
                                <!--Hidden inputs which are passed on when form submit-->
                                <input type="hidden" name="number" value="<?php echo $number; ?>" />
                                <input type="hidden" name="text" value="<?php echo $question['answer']; ?>" />
                                <input type ="hidden" name="question" value="<?php
                                $_SESSION['counter'] ++;
                                echo $_SESSION['counter']
                                ?>" />

                                <p id="demo"></p>
                            </form>  
                        </div>
                    </div>
                </div>
            </main> 

            <div class="container-fluid">
                <div class="row-content">
                    <div class="col-sm-12 text-center"> 
                        <!--Show button for user to see options-->
                        <button id="show">Show</button>  
                        <br>
                        <br>
                        
                        <!--Form, if user clicks quit-->
                        <form method="post" action="../controller/correctanswers.php">
                            <input type="submit" id='delete' class='delete' name="delete" value='Quit?'>
                        </form>
                    </div>
                </div>
            </div>
            <br>

            <!--Score-->
            <div class="container-fluid">
                <div class="row-content">
                    <div class="col-sm-12 text-center">
                        <pre>
Score: <?php echo $_SESSION['score']; ?>
                        </pre>
                    </div>
                </div>
            </div>
        </div>  
        
        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>

         <!--Validation for text entry form, if no entry made and user clicks submit-->
        <script>
            function validateForm() {
                var x = document.forms["form"]["user_answer"].value;
                if (x == "") {
                    //alert user to enter input before clicking submit
                    alert("Answer must be filled out");
                    return false;
                }
            }
        </script>

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




