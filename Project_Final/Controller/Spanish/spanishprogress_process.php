<?php 
//To connect to database
include '../../Model/database.php'; ?>

<?php

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}

//set session variable
$userid = $_SESSION['userID'];

//get todays date
$delete = date("Y-m-d");

//query to delete all quiries where the delete dates are less than todays date
$query = "DELETE FROM overallCorrectSpanish WHERE DATE(deletedate) <= '$delete' AND userID=$userid";
$date = $mysqli->query($query);

//query to delete all quiries where the delete dates are less than todays date
$query = "DELETE FROM overallIncorrectSpanish WHERE DATE(deletedate) <= '$delete' AND userID=$userid";
$incdate = $mysqli->query($query);

//  if ($date === TRUE) {
//    echo "Record deleted successfully";
//} else {
//    echo "Error deleting record: " . $mysqli->error;
//}

//all user correct words
$query = "SELECT COUNT(overallCorrectSpanish.wordID), testSpanishWord.word, testSpanishWord.translation FROM testSpanishWord "
        . "INNER JOIN overallCorrectSpanish ON testSpanishWord.wordID=overallCorrectSpanish.wordID WHERE overallCorrectSpanish.userID="
        . "$userid"
        . " GROUP BY overallCorrectSpanish.wordID";

$result = $mysqli->query($query);

//count for all words user has gotten correct so far
$query1 = "SELECT COUNT(testSpanishWord.word), overallCorrectSpanish.wordID FROM testSpanishWord "
        . "INNER JOIN overallCorrectSpanish  "
        . "ON testSpanishWord.wordID=overallCorrectSpanish.wordID WHERE overallCorrectSpanish.userID="
        . "$userid "
        . "GROUP BY overallCorrectSpanish.wordID";

$results = $mysqli->query($query1);
$correctsofar = $results->num_rows;


//   $query2="SELECT * FROM testFrenchWord";
//   
//   $queryresult=$mysqli->query($query2);
//   $totalwords= $queryresult->num_rows;

//all incorrect words for user
$queryIncorrect = "SELECT COUNT(overallIncorrectSpanish.wordID), testSpanishWord.word, testSpanishWord.translation FROM testSpanishWord "
        . "INNER JOIN overallIncorrectSpanish ON testSpanishWord.wordID=overallIncorrectSpanish.wordID WHERE overallIncorrectSpanish.userID="
        . "$userid"
        . " GROUP BY overallIncorrectSpanish.wordID";
$resultIncorrect = $mysqli->query($queryIncorrect);
$incorrect = $resultIncorrect->num_rows;

//find max words
$query = "SELECT COUNT(overallCorrectSpanish.wordID), testSpanishWord.word, "
        . "testSpanishWord.translation FROM testSpanishWord INNER JOIN overallCorrectSpanish ON "
        . "testSpanishWord.wordID=overallCorrectSpanish.wordID WHERE overallCorrectSpanish.userID= $userid "
        . "GROUP BY overallCorrectSpanish.wordID ORDER BY COUNT(overallCorrectSpanish.wordID) desc LIMIT 1";
$correct = $mysqli->query($query);
$max = $correct->fetch_assoc();

if ($max['COUNT(overallCorrectSpanish.wordID)'] < 10) {
    $max['COUNT(overallCorrectSpanish.wordID)'] = 10;
}
?>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

