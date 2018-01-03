<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php
//selects correct answers for user
$query = "SELECT testFrenchQuizCorrect.quizCorrectID, testFrenchWord.word, testFrenchWord.translation FROM testFrenchQuizCorrect JOIN testFrenchWord ON testFrenchQuizCorrect.wordID=testFrenchWord.wordID";

$result = $mysqli->query($query);
?>

<?php

//deletes all from table when user clicks button
if (isset($_POST['delete'])) {
    $query = "TRUNCATE TABLE `testFrenchQuizCorrect` ";
    $result = $mysqli->query($query);
    
    //user returned to french home page
    header("Location: ../../../View/French/frenchhome.php");

    //score set to 0
    $_SESSION['score'] = 0;
}
?>

    <?php

