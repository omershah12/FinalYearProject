<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php

//Set question number
$number = (int) $_GET['n'];



//get default choices for answer
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=0 ORDER BY rand()";


$choices = $mysqli->query($query);

//get correct answer for testing
$query = "SELECT testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$result = $mysqli->query($query);

$question = $result->fetch_assoc();

//get correct answer
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$results = $mysqli->query($query);

$answer = $results->fetch_assoc();

$correct_choice = $answer['word'];

?>