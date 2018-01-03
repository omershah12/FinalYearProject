<?php
//To connect to database
include '../model/database.php';

//Session Start
session_start();

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}
?>

<?php
//get userid from session variable
$userid = $_SESSION['userID'];

//query to get correct answer with userid
$query = "SELECT COUNT(testSpanishQuizCorrect.wordID), testSpanishWord.word, testSpanishWord.translation FROM testSpanishWord 
INNER JOIN testSpanishQuizCorrect ON testSpanishWord.wordID=testSpanishQuizCorrect.wordID 
WHERE testSpanishQuizCorrect.userID=$userid GROUP BY testSpanishQuizCorrect.wordID 
ORDER BY COUNT(testSpanishQuizCorrect.wordID) desc";

$result = $mysqli->query($query);

//query to get incorrect answers with userid
$incorrect = "SELECT COUNT(testSpanishQuizIncorrect.wordID), testSpanishWord.word, testSpanishWord.translation FROM testSpanishWord 
INNER JOIN testSpanishQuizIncorrect ON testSpanishWord.wordID=testSpanishQuizIncorrect.wordID 
WHERE testSpanishQuizIncorrect.userID=$userid GROUP BY testSpanishQuizIncorrect.wordID 
ORDER BY COUNT(testSpanishQuizIncorrect.wordID) desc";

$incorrecrtResult = $mysqli->query($incorrect);
?>

<?php
//when user clicks home on final.php, scores for the quiz will be deleted from tables
if (isset($_POST['delete'])) {
    $query = "TRUNCATE TABLE `testSpanishQuizCorrect` ";
    $result = $mysqli->query($query);

    $querys = "TRUNCATE TABLE `testSpanishQuizIncorrect`";
    $results = $mysqli->query($querys);
    
    //user will then be returned back to home for the language
    header("Location: ../../spanishhome.php");

    //score set to 0
    $_SESSION['score'] = 0;
}
?>




    <?php

