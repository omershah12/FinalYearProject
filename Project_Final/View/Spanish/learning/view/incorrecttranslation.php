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

//if learning not set, set to 0
if (!isset($_SESSION['learning'])) {
    $_SESSION['learning'] = 0;
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
        <!--All entries into the text are are made lower case-->
        <style>
            textarea { 
                text-transform: lowercase; 
            }
        </style>
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
                    <div class="col-sm-6">
                        <!--When answer correct, display tick else cross-->
                        <?php
                        if ($_SESSION['correctanswer'] == 1) {
                            $image = "tick";
                        } else {
                            $image = "cross";
                        }
                        ?>
                        <img src="<?php echo $image; ?>.png" alt="Smiley face" height="300" width="200">   
                    </div>
                    <div class="col-sm-6">
                        <div class="jumbotron">
                            <!--Answer with translation and pronunciation shown here-->
                            <h1>Answer</h1>
                            <p><?php
                                echo "Word: ";
                                echo $incorrect['word'];
                                echo "<br>";
                                echo "Translation: ";
                                echo $incorrect['translation'];
                                ?><br>
                                <?php
                                echo "Pronunciation: ";
                                echo $incorrect['pronunciation'];
                                ?></p>
                            <!--User click to hear pronunciation-->
                            <p><button onclick="talk()">Hear it</button> </p>
                        </div>
                    </div>
                </div>
            </div>



            <main>
                <div class="container-fluid">
                    <div class="row-content">
                        <div class="col-sm-12 text-center">
                            
                             <!--Form, goes to next question-->
                            <form method="post" action="../controller/translationprocess.php">

                                <input type="submit"  value="Next Question"/>
                                
                                 <!--For testing-->
                                <p><?php // echo $incorrect['word'];       ?></p>
                                
                                <!--For testing-->
<!--                    <p> Learning Counter: <?php // echo ($_SESSION['learning']);      ?></p>-->
<!--                    <p> Text Counter: <?php // echo ($_SESSION['text_entry']);      ?></p>-->
                                
                                <!--Text area for microphone output-->
                                <textarea id="textarea" name="textarea" form="form" required disabled></textarea> 
                                
                                <!--Hidden inputs which are passed on when form submit-->
                                <input type="hidden" name="number" value="<?php echo $number; ?>" />
                                <input type="hidden" name="text" value="<?php echo $question['answer']; ?>" />

                                <p id="demo"></p>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <!--For testing-->
                <?php // echo $_SESSION['userword'];  ?>
                <br>
                <!--For testing-->
                <?php // echo $_SESSION['sound'];  ?>
                <div class="container-fluid">
                    <div class="row-content">
                        <div class="col-sm-12 text-center">
                            <!--Used to activate microphone-->
                            <button onclick="start()">Talk it</button>
                        </div>
                    </div>
                </div>
            </main>
            
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
        
        <!--Script to hear pronunciation of word using SpeechSynth API-->
        <script>
            function talk() {
                var su = new SpeechSynthesisUtterance();
                su.lang = "es"; //Spanish Voice
                su.text = "<?php echo $incorrect['translation']; ?>"; //to say correct word
                speechSynthesis.speak(su);
            }
        </script>      

         <!--Script to talk pronunciation of word using SpeechRecog API-->
        <script type="text/javascript">
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "es"; //spanish accent
            recognition.maxAlternatives = 10;
            recognition.onresult = function (event) {
                if (event.results.length > 0) {
                    var result = event.results[0];
                    for (var i = 0; i < result.length; ++i) {
                        //            var text = result[i].transcript;
                        textarea.value += event.results[i][0].transcript;
                    }
                }
            }

            function start() {
                textarea.value = null;
                textarea.value.length = 0;   //sets text area to null before display
                recognition.start();    //displays
            }
        </script>
        
        <!--Validation for microphone form, to see if pronunciation correct-->
        <script>
            $(document).ready(function () {
                $('#form').submit(function () {
                    var error = 0;
                    var comment = $('#textarea').val();
                    if (comment == '') {
                        error = 0;
                        //for testing
//                        alert('Empty');
                    } else if (comment == '<?php echo $question['translation']; ?>') {
                        error = 0;
                        //if correct pronunciation
                        alert('Correct');
                    } else if (comment !== '<?php echo $question['translation']; ?>') {
                        error = 0;
                        //if incorrect pronunication
                        alert('incorrect');
                    }
                    if (error) {
                        return false;
                    } else {
                        return true;
                    }

                });
            });
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



