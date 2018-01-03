<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php

//Set question number
$number = (int) $_GET['n'];

//get default choices for answer
$query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word, testSpanishWord.translation FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=0 ORDER BY rand()";


$choices = $mysqli->query($query);


//get correct answer for testing
$query = "SELECT testSpanishWord.word, testSpanishWord.translation FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

$result = $mysqli->query($query);

$question = $result->fetch_assoc();


//get correct answer
$query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

$results = $mysqli->query($query);

$answer = $results->fetch_assoc();

$correct_choice = $answer['word'];

?>