<?php 
//To connect to database
include '../model/database.php'; ?>

<?php
//Session Start
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}
?>

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
    
    //set session variables
//    $speech = $_POST['textarea'];

    $userid = $_SESSION['userID'];
    //get next question
    $next = ($_SESSION['random'][$_SESSION['counter']]);

    //get last question
    $lastquestion = end($_SESSION['random']);
    
    //setting session variables
    $learning = $_SESSION['learning'];
    $text = $_SESSION['text_entry'];
    $incorrect = $_SESSION['incorrect'];

//    $query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
//            . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
//            . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";
//
//    $result = $mysqli->query($query);
//
//    $row = $result->fetch_assoc();
//
//    $correct_choice = $row['translation'];
//
//    if (trim(mb_strtolower($correct_choice)) == trim($speech)) {
//        $_SESSION['score'] ++;
//    }
    
    //algorithm for next page using counters and session variables.

    if ($number == $_SESSION['random'][0] and $learning == 1 and $text == 0) {
        header("Location: ../view/question.php?n=" . $next);
    } elseif ($number == $_SESSION['random'][1] and $learning == 2 and $text == 0) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][0]);
    }//done
    elseif ($number == $_SESSION['random'][0] and $learning == 2 and $text == 1) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][2]);
    } elseif ($number == $_SESSION['random'][2] and $learning == 3 and $text == 1) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][1]);
    } elseif ($number == $_SESSION['random'][1] and $learning == 3 and $text == 2) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][3]);
    } elseif ($number == $_SESSION['random'][3] and $learning == 4 and $text == 2) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][2]);
    } elseif ($number == $_SESSION['random'][2] and $learning == 4 and $text == 3) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][4]);
    } elseif ($number == $_SESSION['random'][4] and $learning == 5 and $text == 3) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][3]);
    } elseif ($number == $_SESSION['random'][3] and $learning == 5 and $text == 4) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][5]);
    } elseif ($number == $_SESSION['random'][5] and $learning == 6 and $text == 4) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][4]);
    } elseif ($number == $_SESSION['random'][4] and $learning == 6 and $text == 5) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][1]);
    } elseif ($number == $_SESSION['random'][1] and $learning == 6 and $text == 6) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][6]);
    } elseif ($number == $_SESSION['random'][6] and $learning == 7 and $text == 6) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][5]);
    } elseif ($number == $_SESSION['random'][5] and $learning == 7 and $text == 7) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][2]);
    } elseif ($number == $_SESSION['random'][2] and $learning == 7 and $text == 8) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][7]);
    } elseif ($number == $_SESSION['random'][7] and $learning == 8 and $text == 8) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][0]);
    } elseif ($number == $_SESSION['random'][0] and $learning == 8 and $text == 9) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][6]);
    } elseif ($number == $_SESSION['random'][6] and $learning == 8 and $text == 10) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][8]);
    } elseif ($number == $_SESSION['random'][8] and $learning == 9 and $text == 10) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][7]);
    } elseif ($number == $_SESSION['random'][7] and $learning == 9 and $text == 11) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][4]);
    } elseif ($number == $_SESSION['random'][4] and $learning == 9 and $text == 12) {
        header("Location: ../view/question.php?n=" . $_SESSION['random'][9]);
    } elseif ($number == $_SESSION['random'][9] and $learning == 10 and $text == 12) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][5]);
    } elseif ($number == $_SESSION['random'][5] and $learning == 10 and $text == 13) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][4]);
    } elseif ($number == $_SESSION['random'][4] and $learning == 10 and $text == 14) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][8]);
    } elseif ($number == $_SESSION['random'][8] and $learning == 10 and $text == 15) {
        header("Location: ../view/text_entry.php?n=" . $_SESSION['random'][9]);
    } elseif ($number == $_SESSION['random'][9] and $learning == 10 and $text == 16 and ! empty($incorrect)) {
        header("Location: ../view/incorrecttext.php?n=" . $_SESSION['incorrect'][0]);
    } elseif ($number == $_SESSION['incorrect'][0] and $learning == 10 and $text == 17 and ! empty($incorrect)) {
        header("Location: ../view/incorrecttext.php?n=" . $_SESSION['incorrect'][1]);
    } elseif ($number == $_SESSION['incorrect'][1] and $learning == 10 and $text == 18 and ! empty($incorrect)) {
        header("Location: ../view/final.php");
        exit();
    } elseif ($number == $_SESSION['random'][9] and $learning == 10 and $text == 16 and empty($incorrect)) {
        header("Location: ../view/final.php");
        exit();
    } elseif ($number == $_SESSION['incorrect'][1] and $learning == 10 and $text == 18 and ! empty($incorrect)) {
        header("Location: ../view/final.php");
        exit();
    } else {
        header("Location: ../view/index.php");
    }
}

