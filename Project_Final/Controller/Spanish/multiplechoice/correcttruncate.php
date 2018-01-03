<?php 
//To connect to database
include '../../../Model/database.php'; ?>

<?php
//selects correct answers for user
$query = "SELECT testSpanishQuizCorrect.quizCorrectID, testSpanishWord.word, testSpanishWord.translation FROM testSpanishQuizCorrect JOIN testSpanishWord ON testSpanishQuizCorrect.wordID=testSpanishWord.wordID";

$result = $mysqli->query($query);
?>

<?php
//deletes all from table when user clicks button
if (isset($_POST['delete'])) {
    $query = "TRUNCATE TABLE `testSpanishQuizCorrect` ";
    $result = $mysqli->query($query);

    //user returned to french home page
    header("Location: ../../../View/French/spanishhome.php");

    //score set to 0
    $_SESSION['score'] = 0;
}
?>

    <?php

