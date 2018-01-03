<?php 
//To connect to database
include '../model/database.php'; ?>

<?php 
//Session Start
session_start(); 

if (!isset($_SESSION['userID'])) {
    header("Location: ../../../Start/signin.php");
}
?>


<?php

//check score
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}


if ($_POST) {
    
    //get question number from hidden varibale
    $number = $_POST['number'];
//   if($number == 1) {
//        $_SESSION["score"] = 0;
//    }
    
    //get choice from hidden
    $selected_choice = $_POST['choice'];
    
    //set session variables
    $userid = $_SESSION['userID'];
    
    //get next question
    $next = ($_SESSION['random'][$_SESSION['counter']]);

    //get last question
    $lastquestion = end($_SESSION['random']);

    $learning = $_SESSION['learning'];
    
    //correct answer
    $query = "SELECT testSpanishChoice.choiceID, testSpanishWord.word FROM "
            . "testSpanishChoice JOIN testSpanishWord ON testSpanishChoice.wordID=testSpanishWord.wordID "
            . "WHERE testSpanishChoice.questionID=$number AND is_correct=1";

    $result = $mysqli->query($query);

    $row = $result->fetch_assoc();

    $correct_choice = $row['choiceID'];
    
    //get date for 4 days in future 
    $delete = date("Y.m.d H:i:s", strtotime("+ 4 days"));
    
    //check if user answer matches correct answer
    if ($selected_choice == $correct_choice) {
        //if yes then increment score
        $_SESSION['score'] ++;
        //add to quizresult
        $query = "INSERT INTO testSpanishQuizCorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $result = $mysqli->query($query);
        
        //add to overall correct for user
        $query = "INSERT INTO overallCorrectSpanish " .
                "(wordID, userID, date, deletedate) " .
                "VALUES " .
                "('$number', '$userid', NOW(), '$delete')";
        $results = $mysqli->query($query);

        $_SESSION['correctanswer'] = 1;
        //set to 1, to set tick image
        
        //if user choice does not equal correct
    } elseif ($selected_choice !== $correct_choice) {
        //add to quiz incorrect
        $query = "INSERT INTO testSpanishQuizIncorrect " .
                "(wordID, userID) " .
                "VALUES " .
                "('$number', '$userid')";
        $result = $mysqli->query($query);
        
        //add to overall incorrect for user
        $query = "INSERT INTO overallIncorrectSpanish " .
                "(wordID, userID, date, deletedate) " .
                "VALUES " .
                "('$number', '$userid', NOW(), '$delete')";
        $results = $mysqli->query($query);
        //set to 0, for cross image
        $_SESSION['correctanswer'] = 0;
    } else {
        //else cross image
      $_SESSION['correctanswer']=0;
    }
    
    //algorithm for next page using counters to check
    if ($number == $_SESSION['random'][0] and $learning == 0) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][0]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][0] and $learning==1){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][1] and $learning == 1) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][1]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][1] and $learning==2){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][2] and $learning == 2) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][2]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][2] and $learning==3){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][3] and $learning == 3) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][3]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][3] and $learning==4){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][4] and $learning == 4) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][4]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][4] and $learning==5){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][5] and $learning == 5) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][5]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][5] and $learning==6){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][6] and $learning == 6) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][6]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][6] and $learning==7){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][7] and $learning == 7) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][7]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][7] and $learning==8){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][8] and $learning == 8) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][8]); //done
        $_SESSION['learning'] ++;
    }
//   elseif($number==$_SESSION['random'][8] and $learning==9){
//       header("Location: ../view/question.php?n=".$next);
//   }
    elseif ($number == $_SESSION['random'][9] and $learning == 9) {
        header("Location: ../view/translation.php?n=" . $_SESSION['random'][9]); //done
        $_SESSION['learning'] ++;
    } elseif ($number == $_SESSION['random'][9] and $learning == 10) {
        header("Location: ../view/final.php"); //done
        exit();
    } else {
        header("Location: ../view/index.php");
    }
}


