<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php 
//Session Starts
session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}?>

<?php

//check score
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}


if ($_POST) {
    
    //get question number from hidden varibale
    $number = $_POST['number'];
//   if($number == 1) {
//        $_SESSION["score"] = 0;
//    }

    //get choice from hidden
    $userinput = $_POST['user_answer'];

    //set session variables
    $userid = $_SESSION['userID'];
    
    //get next question
    $next = ($_SESSION['random'][$_SESSION['counter']]);
    
     //get last question
    $lastquestion = end($_SESSION['random']);

    //correct answer
    $query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word FROM "
            . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
            . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

    $result = $mysqli->query($query);

    $row = $result->fetch_assoc();

    $correct_choice = $row['word'];
    
    //check if user input matches correct answer
    if ($correct_choice == $userinput) {
        $_SESSION['score'] ++;
//     $query = "INSERT INTO testFrenchQuizCorrect ".
//       "(wordID) ".
//       "VALUES ".
//       "('$number')";
//       $result = $mysqli->query($query);
//    
//       $query = "INSERT INTO overallCorrect ".
//       "(wordID, userID) ".
//       "VALUES ".
//       "('$number', '$userid')";
//       $results = $mysqli->query($query);
    }

    //check for next question
    if ($number == $lastquestion) {
        header("Location: ../../../View/Spanish/textentry/final.php");
        exit();
    } else {
        header("Location: ../../../View/Spanish/textentry/question.php?n=" . $next);
    }
}

