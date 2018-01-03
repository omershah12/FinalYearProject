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
    
    //get useranswer from hidden
    $userinput = $_POST['user_answer'];

    $incorrecttranslation = $_SESSION['incorrecttranslation'];

    //set session variables
    $userid = $_SESSION['userID'];
    $next = ($_SESSION['random'][$_SESSION['counter']]);

    $lastquestion = end($_SESSION['random']);

   //correct answer
    $query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
            . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
            . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

    $result = $mysqli->query($query);

    $row = $result->fetch_assoc();

    $correct_choice = $row['translation'];

    //correct answer for user incorrect answer
    $query = "SELECT overallIncorrect.wordID, testFrenchWord.word, testFrenchWord.translation FROM "
            . "overallIncorrect JOIN testFrenchWord ON overallIncorrect.wordID=testFrenchWord.wordID WHERE translation="
            . "'$incorrecttranslation' LIMIT 1";
    $results = $mysqli->query($query);

    $rows = $results->fetch_assoc();

    $correct_word = $rows['translation'];

    //get soundex ffrom user input
    $userword = soundex($userinput);

    //get soundex from correct word
    $sound = soundex($correct_choice);

    //session variable for soundex
    $_SESSION['sound'] = $sound;

//   $_SESSION['userword']=$userword;
    //delete date for 4 days time
    $delete = date("Y.m.d H:i:s", strtotime("+ 4 days"));

    //convert string to lower key and trim spaces for correct answer
    if (trim(mb_strtolower($correct_choice)) == trim(mb_strtolower($userinput))) {
        $_SESSION['score'] ++;  //increment if correct
        $_SESSION['correctanswer'] = 1; // so image is tick
        //insert into quiz correct
        $query = "INSERT INTO testFrenchQuizCorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $result = $mysqli->query($query);

        //insert into overall correct
        $query = "INSERT INTO overallCorrect " .
                "(wordID, userID, date, deletedate) " .
                "VALUES " .
                "('$number', '$userid', NOW(), '$delete')";
        $results = $mysqli->query($query);
        
        //again trim and convert to lower and check
    } elseif (trim(mb_strtolower($correct_word)) == trim(mb_strtolower($userinput))) {
        $_SESSION['score'] ++;
        $_SESSION['correctanswer'] = 1;
        //if input has same soundex then add to language word table
    } elseif ($userword == $sound and mb_strtolower($correct_choice) !== mb_strtolower($userinput)) {
        //adding to word table
        $query = "INSERT INTO testFrenchWord(word, translation, pronunciation)"
                . "VALUES('$userinput', '$userinput', '$userinput')";
        $result = $mysqli->query($query);

        //getting wordid
        $query = "SELECT * FROM testFrenchWord WHERE word = '$userinput'";
        $output = $mysqli->query($query);
        $id_result = $output->fetch_assoc();
        $correct_id = $id_result['wordID'];

        //inserting id into choice
        $query = "INSERT INTO testFrenchChoice(wordID, questionID)"
                . "VALUES ($correct_id, $number)";
        $results = $mysqli->query($query);

        //adding to incorrect for quiz
        $query = "INSERT INTO testFrenchQuizIncorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $result = $mysqli->query($query);

        //adding to incorrect
        $query = "INSERT INTO overallIncorrect " .
                "(wordID, userID, date, deletedate) " .
                "VALUES " .
                "('$number', '$userid', NOW(), '$delete')";
        $results = $mysqli->query($query);
        //setting image to cross
        $_SESSION['correctanswer'] = 0;
    } else {
        //setting image to cross
        $_SESSION['correctanswer'] = 0;
        //inserting to quiz incorrect
        $query = "INSERT INTO testSpanishQuizIncorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $result = $mysqli->query($query);

        //inserting into overallincorrect
        $query = "INSERT INTO overallIncorrectSpanish " .
                "(wordID, userID, date, delete) " .
                "VALUES " .
                "('$number', '$userid', NOW(), '$delete')";
        $results = $mysqli->query($query);
    }


     //setting session variables
    $learning = $_SESSION['learning'];
    $text = $_SESSION['text_entry'];

    
    //algorithm to check next page using counters and session variables.
    if ($number == $_SESSION['random'][0] and $learning == 2 and $text == 0) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][0]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][1] and $learning == 3 and $text == 1) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][1]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][2] and $learning == 4 and $text == 2) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][2]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][3] and $learning == 5 and $text == 3) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][3]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][4] and $learning == 6 and $text == 4) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][4]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][1] and $learning == 6 and $text == 5) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][1]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][5] and $learning == 7 and $text == 6) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][5]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][2] and $learning == 7 and $text == 7) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][2]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][0] and $learning == 8 and $text == 8) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][0]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][6] and $learning == 8 and $text == 9) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][6]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][7] and $learning == 9 and $text == 10) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][7]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][4] and $learning == 9 and $text == 11) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][4]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][5] and $learning == 10 and $text == 12) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][5]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][4] and $learning == 10 and $text == 13) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][4]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][8] and $learning == 10 and $text == 14) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][8]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['random'][9] and $learning == 10 and $text == 15) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][9]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['incorrect'][0] and $learning == 10 and $text == 16) {
        header("Location: ../view/incorrecttranslation.php?n=" . $_SESSION['incorrect'][0]);
        $_SESSION['text_entry'] ++;
    } elseif ($number == $_SESSION['incorrect'][1] and $learning == 10 and $text == 17) {
        header("Location: ../view/incorrecttranslation.php?n=" . $_SESSION['incorrect'][1]);
        $_SESSION['text_entry'] ++;
    } else {
        header("Location: ../view/index.php");
    }
}
