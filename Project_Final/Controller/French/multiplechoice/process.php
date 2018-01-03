<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php 
//Session Start
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
    $selected_choice = $_POST['choice'];

    //set session variables
    $userid = $_SESSION['userID'];
    
    //get next question
    $next = ($_SESSION['random'][$_SESSION['counter']]);
    
    //get last question
    $lastquestion = end($_SESSION['random']);

    
    //correct answer
    $query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word FROM "
            . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
            . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

    $result = $mysqli->query($query);

    $row = $result->fetch_assoc();

    $correct_choice = $row['choiceID'];

    //check if user answer matches correct answer
    if ($selected_choice == $correct_choice) {
        //if yes then increment score
        $_SESSION['score'] ++;
        //add to quizresult
        $query = "INSERT INTO testFrenchQuizCorrect " .
                "(wordID) " .
                "VALUES " .
                "('$number')";
        $result = $mysqli->query($query);
        
        //add to overall correct for user
        $query = "INSERT INTO overallCorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $results = $mysqli->query($query);
    }
    
    //check next question
    if ($number == $lastquestion) {
        header("Location: ../../../View/French/multiplechoice/final.php");
        exit();
    } else {
        header("Location: ../../../View/French/multiplechoice/question.php?n=" . $next);
    }
}
