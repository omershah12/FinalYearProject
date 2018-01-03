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
$query = "DELETE FROM overallCorrect WHERE DATE(deletedate) <= '$delete' AND userID=$userid";
$date = $mysqli->query($query);

//query to delete all quiries where the delete dates are less than todays date
$query = "DELETE FROM overallIncorrect WHERE DATE(deletedate) <= '$delete' AND userID=$userid";
$incdate = $mysqli->query($query);

//for testing
//  if ($date === TRUE) {
//    echo "Record deleted successfully";
//} else {
//    echo "Error deleting record: " . $mysqli->error;
//}

//all user correct words
$query = "SELECT COUNT(overallCorrect.wordID), testFrenchWord.word, testFrenchWord.translation FROM testFrenchWord "
        . "INNER JOIN overallCorrect ON testFrenchWord.wordID=overallCorrect.wordID WHERE overallCorrect.userID="
        . "$userid"
        . " GROUP BY overallCorrect.wordID";

$result = $mysqli->query($query);
$test = $result->fetch_assoc();

//count for all words user has gotten correct so far
$query1 = "SELECT COUNT(testFrenchWord.word), overallCorrect.wordID FROM testFrenchWord "
        . "INNER JOIN overallCorrect "
        . "ON testFrenchWord.wordID=overallCorrect.wordID WHERE overallCorrect.userID="
        . "$userid "
        . "GROUP BY overallCorrect.wordID";

$results = $mysqli->query($query1);
$correctsofar = $results->num_rows;


//   $query2="SELECT * FROM testFrenchWord";
//   
//   $queryresult=$mysqli->query($query2);
//   $totalwords= $queryresult->num_rows;

//all incorrect words for user
$queryIncorrect = "SELECT COUNT(overallIncorrect.wordID), testFrenchWord.word, testFrenchWord.translation FROM testFrenchWord "
        . "INNER JOIN overallIncorrect ON testFrenchWord.wordID=overallIncorrect.wordID WHERE overallIncorrect.userID="
        . "$userid"
        . " GROUP BY overallIncorrect.wordID";
$resultIncorrect = $mysqli->query($queryIncorrect);
$incorrect = $resultIncorrect->num_rows;

//find max words
$query = "SELECT COUNT(overallCorrect.wordID), testFrenchWord.word, "
        . "testFrenchWord.translation FROM testFrenchWord INNER JOIN overallCorrect ON "
        . "testFrenchWord.wordID=overallCorrect.wordID WHERE overallCorrect.userID= $userid "
        . "GROUP BY overallCorrect.wordID ORDER BY COUNT(overallCorrect.wordID) desc LIMIT 1";
$correct = $mysqli->query($query);
$max = $correct->fetch_assoc();

if ($max['COUNT(overallCorrect.wordID)'] < 10) {
    $max['COUNT(overallCorrect.wordID)'] = 10;
}
?>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

