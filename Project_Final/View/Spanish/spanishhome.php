<?php
//Session Start
session_start();

//Including spanishprogress_process.php file, which provides all the information
//concerning the progress half of the page
include '../../Controller/Spanish/spanishprogress_process.php';

//Check to see if user logged in, if not then they wil
//be retruned to signin.php
if (!isset($_SESSION['userID'])) {
    header("Location: ../Start/signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TLL-Spanish Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <link rel="stylesheet" href="../../Model/Style/css.css" type="text/css" />
        <link rel="stylesheet" href="../../Model/Style/tagcloud.css" type="text/css" />
        <link rel="icon" sizes="192x192" href="../Start/world.png" />
        <link rel="apple-touch-icon" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../Start/icon.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../Start/icon.png"/>
        <link rel="shortcut icon" href="../Start/world.png" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:regular,bold' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    
    <!--Main Body of Page-->
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <!--NavBar-->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <!--User will be returned to home.php when clicked-->
                    <a class="navbar-brand" href="../Home/home.php">TLL</a>
                </div>
                <!--User will be shown languages when clicked-->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Languages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../../View/French/frenchhome.php">French</a></li>
                                <li><a href="../../View/Spanish/spanishhome.php">Spanish</a></li>
                            </ul>
                        </li>
                        <!--User will be logged out when clicked-->
                        <li><a href="../../Model/Logout/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Wrapper used to hold all page content-->
        <div class="wrapper">
            <div class="container-fluid text-center">
                <!--Bootstrap row-->
                <div class="row content">
                    <!--Bootstrap column within row-->
                    <div class="col-sm-2 sidenav">
                        <p><a href="../Home/help.php" class="start">Help</a></p>
                    </div>
                    <!--User name called from session variable-->
                    <div class="col-sm-3 text-left"> 
                        <h1>Welcome <?php echo $_SESSION['firstname']; ?></h1>
                        <br>
                        <p>This is the home page for Spanish. Here you can test yourself and learn new words and phrases in the language of Spanish.</p>
                        <br>
                        <p>You can also track your progress bellow</p>
                    </div>

                    <div class="col-sm-3">
                        <h2>Learn Now</h2>
                        <!-- All learning environment available to user, the word number is dependent on the start and last values from the url-->
                        <br>
                        <p><a href="../Spanish/learning/view/index.php?start=1&last=10" class="start" data-toggle='tooltip' title='Learn 1 basic Spanish Words!'> Basic Spanish 1-10 Learning</a></p>

                        <p><a href="../Spanish/learning/view/index.php?start=10&last=20" class="start" data-toggle='tooltip' title='Learn 1 basic Spanish Words!'> Basic Spanish 10-20 Learning</a></p>

                        <p><a href="../Spanish/learning/view/index.php?start=20&last=30" class="start" data-toggle='tooltip' title='Learn 1 basic Spanish Words!'> Basic Spanish 20-30 Learning</a></p>

                        <p><a href="../Spanish/learning/view/index.php?start=30&last=40" class="start" data-toggle='tooltip' title='Learn 1 basic Spanish Words!'> Basic Spanish 30-40 Learning</a></p>

                        <p><a href="../Spanish/learning/view/index.php?start=40&last=50" class="start" data-toggle='tooltip' title='Learn 1 basic Spanish Words!'> Basic Spanish 40-50 Learning</a></p>
                    </div>
                    <div class="col-sm-4">
                        <!--All prototypes that were developed, again thr word number is dependent on the start and last values from the url-->
                        <h2>Prototypes</h2>
                        <br>
                        <p><a href="../Spanish/multiplechoice/index.php?start=11&last=20" class="start" data-toggle='tooltip' title='Prototype2'> Basic Spanish 11-20</a></p>


                        <p><a href="../Spanish/multiplechoice/index.php?start=1&last=10" class="start" data-toggle='tooltip' title='Prototype1'> Basic Spanish 1-10</a></p>
                        <p><a href="../Spanish/timed/index.php?start=1&last=10" class="start" data-toggle='tooltip' title='Prototype3'> Basic Spanish 1-10 Timed</a></p>


                        <p><a href="../Spanish/learning/view/index.php?start=1&last=10" class="start" data-toggle='tooltip' title='Prototype 4'> Basic Spanish 1-10 Learning</a></p>

                        <p><a href="../Spanish/textentry/index.php?start=1&last=10" class="start" data-toggle='tooltip' title='Prototype5'> Basic Spanish 1-10- Text</a></p>

                    </div>
                </div>
            </div>


            <!--Start of progress section-->
            <div class="container-fluid text-center">
                <div class="row-content">
                    <hr>
                    <h3>Progress so far...</h3>

                </div>
            </div>
            <div class="container-fluid text-center">
                <div class="row-content">
                    <!--Correct so far words-->
                    <div class="col-sm-6">
                        <!--Scrolling column-->
                        <div class="pre-scrollable">
                            <!--Correct so far stores the number of words learnt so far by user-->
                            <h4><?php echo $correctsofar; ?> out of 50 learnt so far</h4>
                            <!--Progress bar provided to add more graphical interpretation of progress-->
                            <progress id="progress" value="<?php echo $correctsofar; ?>" max="53"></progress>
                            <p><?php
                                if ($result->num_rows > 0) {
                                    //For each result from the query which finds all the correct words
                                    //they will all be represented with a progress bar
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                    <p><?php
                                        echo "Word: ";
                                        echo $row['word'];
                                        echo "<br>"
                                        ?> <?php
                                        echo"Translation: ";
                                        echo $row['translation'];
                                        echo"<br>";
                                        ?><progress id="progress" value="<?php echo $row['COUNT(overallCorrectSpanish.wordID)']; ?>" max="25">
                                        </progress></p>     
                                    <?php
                                }
                            } else {
                                //if the user has not learnt any words yet
                                echo "No words being learnt";
                            }
                            ?></div>
                    </div>

                    <!--Incorrect Word cloud-->
                    <div class="col-sm-6">   
                        <h4>Incorrect Words...</h4>
                        <br>
                        <div id="wordcloud"> 
                            <!--Query which is called to get all incorrect words for that user, along with the actual word
                            translation and the count-->
                            <?php
                            //database.php included to connect to database
                            include '../../Model/database.php';
                            //words which are returned by the query which will be stored into the array
                            $wordArray = array();
                            $query = "SELECT COUNT(overallIncorrectSpanish.wordID), testSpanishWord.word, "
                                    . "testSpanishWord.translation FROM testSpanishWord "
                                    . "INNER JOIN overallIncorrectSpanish ON testSpanishWord.wordID=overallIncorrectSpanish.wordID "
                                    . "WHERE overallIncorrectSpanish.userID= $userid "
                                    . "GROUP BY overallIncorrectSpanish.wordID ORDER BY COUNT(overallIncorrectSpanish.wordID) desc";

                            if ($result = $mysqli->query($query)) {
                                while ($row = $result->fetch_assoc()) {
                                    //if there is a result, for every result the transaltion is assigned with its count
                                    $translation = $row["translation"];
                                    $count = $row["COUNT(overallIncorrectSpanish.wordID)"];

                                    $wordArray[$translation] = $count;
                                }
                            }
                            $min = 99999999;
                            $max = 0;
                            //algorithm used to establis the max and min value, depending on the count
                            foreach ($wordArray as $key => $value) {
                                if ($value > $max) {
                                    $max = $value;
                                }
                                if ($value < $min) {
                                    $min = $value;
                                }
                            }
                            
                            //used for calucaltion to establish how words should a word be printed
                            $diff = $max - $min;
                            $highest = $max;
                            $middleHigh = 10 * ceil($diff / 3) + $min;
                            $middleLow = 1 * ceil($diff / 3) + $min;
                            $lowest = $min;
                            
                            //for every value in the word array, it will check its value and if it is true to
                            //for the if statement then the word will be written depending on the size of the 
                            //if statement it returned true
                            foreach ($wordArray as $key => $value) {
                                //query which select all information for the translated word
                                $query = "SELECT * FROM testSpanishWord WHERE translation='$key'";
                                $word = $mysqli->query($query);
                                $correctWord = $word->fetch_assoc();
                                
                                if ($value == $highest) {
                                    //the biggest incorrect word, $correctWord['word'] used for tooltip
                                    echo "<span data-toggle='tooltip' title='" . $correctWord['word'] . ", $value' class='largest' onclick='talk()'>$key, </span>";
                                } else if (($value < $highest) && ($value >= $middleHigh)) {
                                    //the second biggest incorrect word, $correctWord['word'] used for tooltip
                                    echo "<span data-toggle='tooltip' title='" . $correctWord['word'] . ", $value' class='large' onclick='talk()'>$key, </span>";
                                } else if (($value < $middleHigh) && ($value >= $middleLow)) {
                                    //the third biggest incorrect word, $correctWord['word'] used for tooltip
                                    echo "<span data-toggle='tooltip' title='" . $correctWord['word'] . ", $value' class='medium' onclick='talk()'>$key, </span>";
                                } else if (($value < $middleLow) && ($value >= $lowest)) {
                                    //the least incorrect word, $correctWord['word'] used for tooltip
                                    echo "<span data-toggle='tooltip' title='" . $correctWord['word'] . ", $value' class='small' onclick='talk()'>$key, </span>";
                                }

                                echo "</a> ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--Chart used to display user progress of score-->
            <div class="container-fluid">
                <div class="row-content">
                    <div class="col-sm-12">
                        <div id="chart_div">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Footer-->
        <footer class="container-fluid text-center">
            <p>TLL Copyright &copy;</p>
        </footer>
        
        <script>
            //tooltip function, used to show information when user hovers
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>   
        
        <script>
            //Google Charts API
            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {

                var data = new google.visualization.DataTable();
                data.addColumn('number', 'x');
                data.addColumn('number', 'Score');


                data.addRows([
<?php
//query called to get score for user who is logged in
//counter to count number of x axis
$counter = 0;
$query = "SELECT * FROM spanishScores WHERE userID=$userid";
$chartresult = $mysqli->query($query);

if ($chartresult->num_rows > 0) {
    while ($row = $chartresult->fetch_assoc()) {
        echo "[";
        echo $counter . ",";    //x axis
        echo $row['score'] . "], "; //yaxis
        $counter++; //counter increemented after each score is processed
    }
} else {
    echo "no results";
}
?>
                ]);

                var options = {
                    //titles for chart
                    'title': 'Your Scores',
                    hAxis: {
                        //axis title
                        title: 'Attempt'
                    },
                    vAxis: {
                        //axix title
                        title: 'Score'
                    }
                };
                
                //calling new chart from Google API
                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                
                //Google API draws data on to graph
                chart.draw(data, options);
            }</script>



    </body>
</html>
