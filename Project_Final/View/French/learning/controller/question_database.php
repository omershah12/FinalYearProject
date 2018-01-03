<?php 
//To connect to database
include '../model/database.php'; ?>

<?php

//Set question number
$number = (int) $_GET['n'];

//query to get subtring from correct answer
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, "
        . "testFrenchWord.translation, LEFT(testFrenchWord.translation, 2) "
        . "FROM testFrenchChoice JOIN testFrenchWord ON "
        . "testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$subresult = $mysqli->query($query);

$sub = $subresult->fetch_assoc();

$substring = $sub['LEFT(testFrenchWord.translation, 2)'];

//get default choices for answer
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=0 ORDER BY rand()";

$choices = $mysqli->query($query);


//get correct answer for testing
$query = "SELECT testFrenchWord.word, testFrenchWord.translation, testFrenchWord.pronunciation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$result = $mysqli->query($query);

$question = $result->fetch_assoc();

//get correct answer
$query = "SELECT testFrenchChoice.choiceID, testFrenchWord.word, testFrenchWord.translation FROM "
        . "testFrenchChoice JOIN testFrenchWord ON testFrenchChoice.wordID=testFrenchWord.wordID "
        . "WHERE testFrenchChoice.questionID=$number AND is_correct=1";

$results = $mysqli->query($query);

$answer = $results->fetch_assoc();

$correct_choice = $answer['translation'];

//get substring choices
$query = "SELECT * FROM testFrenchWord WHERE translation LIKE '%$substring%' "
        . "AND translation NOT LIKE '$correct_choice' ORDER BY rand()";
$choices1 = $mysqli->query($query);
$total = $choices1->num_rows;

//get incorrect word
$query = "SELECT testFrenchWord.word, testFrenchWord.translation, testFrenchWord.pronunciation FROM "
        . "overallIncorrect JOIN testFrenchWord ON overallIncorrect.wordID=testFrenchWord.wordID "
        . "WHERE overallIncorrect.overallIncorrectID=$number";

$resulting = $mysqli->query($query);

$incorrect = $resulting->fetch_assoc();
?>