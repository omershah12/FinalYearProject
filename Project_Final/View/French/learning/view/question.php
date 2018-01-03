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
        <title>TLL- Basic French 1- <?php echo $_SESSION['firstname']; ?></title>
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
                            <h1>Question</h1>
                            <!--English Word will be displayed here-->
                            <p><?php
                                echo "Word: ";
                                echo $question['word'];
                                echo "<br>"
                                ?></p>
                            <p>Translation...?</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row content">
                    <div class="col-sm-12 text-center">
                        <!--Question for user-->
                        <p><strong>Question: What is the translation for the word "<?php echo $question['word']; ?>"</strong></p>
                    </div>
                </div>
            </div>

            <main>
                <div class="container-fluid">
                    <div class="row-content">
                        <div class="col-sm-12 text-center">
                            <!--Form for choices, process will be called when submit after validation-->
                            <form method="post" action="../controller/process.php" onsubmit="return validateForm()">
                                <ul id="tst" class="choices">  

                                    <?php
                                    //counter, max 4 choice can be displayed
                                    $counter = 0;
                                    $max = 3;
                                    ?>
                                    <!--Correct answer displayed-->
                                    <li><label class="element-animation1 btn btn-secondary btn-lg btn-block active"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="choice" value="<?php echo $answer['choiceID']; ?>"><?php echo $answer['translation']; ?></label></li>

                                    <!--Selection for incorrect words-->
                                    <?php
                                    if ($total == 0) {
                                        //if total of substring query is 0, use default
                                        while (($row = $choices->fetch_assoc()) and ( $counter < $max)):
                                            ?>   

                                            <li><label class="element-animation1 btn btn-secondary btn-lg btn-block active"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="choice" value="<?php echo $row['choiceID']; ?>"><?php echo $row['translation']; ?></label></li> 

                                            <?php
                                            $counter++;
                                        endwhile;
                                    } elseif ($total > 2) {
                                        //if total of substring query is greater than 2, then display results of substring query
                                        while (($row1 = $choices1->fetch_assoc()) and ( $counter < $max)):
                                            ?>
                                            <li><label class="element-animation1 btn btn-secondary btn-lg btn-block active"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="choice" value="<?php echo $row1['choiceID']; ?>"><?php echo $row1['translation']; ?></label></li>  
                                            <?php
                                            $counter++;
                                        endwhile;
                                    } else {
                                        //if neither, then use default
                                        while (($row2 = $choices->fetch_assoc()) and ( $counter < $max)):
                                            ?>
                                            <li><label class="element-animation1 btn btn-secondary btn-lg btn-block active"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="choice" value="<?php echo $row2['choiceID']; ?>"><?php echo $row2['translation']; ?></label></li>
                                            <?php
                                            $counter++;
                                        endwhile;
                                    }
                                    ?>
                                </ul>
                                <input type="submit"  value="Submit"/>
                                 <!--For testing-->
                                <p><?php // echo $correct_choice     ?></p>
                                 <!--For testing-->
                                <?php
//                         $date=date("Y-m-j H:i:s");
//                         echo $date;
                                ?>
                                 
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
            <br>
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

            
            <!--For testing-->
            <p><?php // echo $_SESSION['score'];    ?></p>
<!--                    <p> Learning Counter: </p>-->
            <?php // echo ($_SESSION['learning']);?>
<!--                    <p> Random Number: </p>-->
            <?php // print_r(array_values($_SESSION['random'])); ?>
<!--                    <p> Text Counter: </p>-->
            <?php // echo ($_SESSION['text_entry']);  ?>
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
        
        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>

        <!--Script used to randomise choices-->
        <script type="text/javascript">

            var ul = document.querySelector('ul');
            for (var i = ul.children.length; i >= 0; i--) {
                ul.appendChild(ul.children[Math.random() * i | 0]);
            }

        </script>
        
        <!--Validation for choice form, if no selection made and user clicks submit-->
        <script type="text/javascript">
            function validateForm() {
                var radios = document.getElementsByName("choice");
                var formValid = false;

                var i = 0;
                while (!formValid && i < radios.length) {
                    if (radios[i].checked)
                        formValid = true;
                    i++;
                }

                if (!formValid)
                    //alert user to check box before clicking submit
                    alert("Must check some option!");
                return formValid;
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



