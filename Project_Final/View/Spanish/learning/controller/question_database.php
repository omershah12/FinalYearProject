<?php 
//To connect to database
include '../model/database.php'; ?>

<?php

//Set question number
$number = (int) $_GET['n'];

//query to get subtring from correct answer
$query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word, "
        . "testSpanishWord.translation, LEFT(testSpanishWord.translation, 2) "
        . "FROM testSpanishChoice JOIN testSpanishWord ON "
        . "testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

$subresult = $mysqli->query($query);

$sub = $subresult->fetch_assoc();

$substring = $sub['LEFT(testSpanishWord.translation, 2)'];


//get default choices for answer
$query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word, testSpanishWord.translation FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=0 ORDER BY rand()";

$choices = $mysqli->query($query);


//get correct answer for testing
$query = "SELECT testSpanishWord.word, testSpanishWord.translation, testSpanishWord.pronunciation FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

$result = $mysqli->query($query);

$question = $result->fetch_assoc();


//get correct answer
$query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word, testSpanishWord.translation FROM "
        . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
        . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

$results = $mysqli->query($query);

$answer = $results->fetch_assoc();

$correct_choice = $answer['translation'];

//get substring choices
$query = "SELECT * FROM testSpanishWord WHERE translation LIKE '%$substring%' "
        . "AND translation NOT LIKE '$correct_choice' ORDER BY rand()";
$choices1 = $mysqli->query($query);
$total = $choices1->num_rows;


//get incorrect word
$query = "SELECT testSpanishWord.word, testSpanishWord.translation, testSpanishWord.pronunciation FROM "
        . "overallIncorrectSpanish JOIN testSpanishWord ON overallIncorrectSpanish.wordID=testSpanishWord.wordID "
        . "WHERE overallIncorrectSpanish.overallIncorrectSpanishID=$number";

$resulting = $mysqli->query($query);

$incorrect = $resulting->fetch_assoc();
?>