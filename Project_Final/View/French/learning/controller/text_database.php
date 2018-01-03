<?php 
//To connect to database
include '../model/database.php'; ?>

<?php

//Set question number
$number = (int) $_GET['n'];

//get incorrect choices
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=0 ORDER BY rand()";


$choices = $mysqli->query($query);

//get correct for testing
$query = "SELECT testFrenchWord.word, testFrenchWord.translation, testFrenchWord.pronunciation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$result = $mysqli->query($query);

$question = $result->fetch_assoc();

//get correct word
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$results = $mysqli->query($query);

$answer = $results->fetch_assoc();

$correct_choice = $answer['word'];
?>
