<?php 
//To connect to database
include '../model/database.php'; ?>
<?php

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
$query = "SELECT COUNT(testFrenchQuizCorrect.wordID), testFrenchWord.word, testFrenchWord.translation FROM testFrenchWord 
INNER JOIN testFrenchQuizCorrect ON testFrenchWord.wordID=testFrenchQuizCorrect.wordID 
WHERE testFrenchQuizCorrect.userID=$userid GROUP BY testFrenchQuizCorrect.wordID 
ORDER BY COUNT(testFrenchQuizCorrect.wordID) desc";

$result = $mysqli->query($query);

//query to get incorrect answers with userid
$incorrect = "SELECT COUNT(testFrenchQuizIncorrect.wordID), testFrenchWord.word, testFrenchWord.translation FROM testFrenchWord 
INNER JOIN testFrenchQuizIncorrect ON testFrenchWord.wordID=testFrenchQuizIncorrect.wordID 
WHERE testFrenchQuizIncorrect.userID=$userid GROUP BY testFrenchQuizIncorrect.wordID 
ORDER BY COUNT(testFrenchQuizIncorrect.wordID) desc";

$incorrecrtResult = $mysqli->query($incorrect);
?>

<?php

//when user clicks home on final.php, scores for the quiz will be deleted from tables
if (isset($_POST['delete'])) {
    $query = "TRUNCATE TABLE `testFrenchQuizCorrect` ";
    $result = $mysqli->query($query);

    $querys = "TRUNCATE TABLE `testFrenchQuizIncorrect`";
    $results = $mysqli->query($querys);
    
    //user will then be returned back to home for the language
    header("Location: ../../frenchhome.php");
    
    //score set to 0
    $_SESSION['score'] = 0;
}
?>




    <?php

