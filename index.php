
<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><h1>crateboard</h1></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles_change.css">
    </head>

    <body>
        <div id="nav">
            <div id="navigation">

                <a id="a1" href="home.php">Home</a>
                <a id="a1" href="index.php">Play Game</a>

                <a id="a3" href="puzzlegame.php">Puzzle List</a>

                <?php
                if (isset($_SESSION["logged"])) {
                    //$printname = $_SESSION["uname"];
                    echo $_SESSION["uname"];


                    echo'<a id="a4" href="logoff.php">Log Out</a>';
                } else {
                    echo '<a id="a2" href="modsignup.php">Sign Up</a>';
                    echo'  <a id="a3" href="sigin1.php">Log In</a>';
                }
                ?>
            </div>
        </div>
        <div id="myHeader" style="color:blue"></div>
        <div id="messageBoard" style="color:green"></div>
        <!--<div id="canvasDiv" width="524" height="524"></div>-->
        <canvas id="canvas" width="1024" height="1024" style="border:solid black; background-color: orange"></canvas>
        <script src="Util.js" type="text/javascript"></script>
        <script src="mainboard.js" type="text/javascript"></script>
        <script src="mainboard.view.js" type="text/javascript"></script> 
    </body>
<?php
$con = mysqli_connect("localhost", "root", "root", "cratedb");

// Check connection
if (!$con) {
    die("Failed to connect to MySQL: ");
    exit();
}

if (!isset($_GET['puzzlename']) || trim($_GET['puzzlename']) === '') {
    $gameMessage = '<p>You are playing an <b>Unresolved Puzzle</b></p>';
} else {
    $puzzlename = $_GET['puzzlename'];
    $sql = "SELECT * FROM puzzles WHERE puzname='$puzzlename'";
    $result = $con->query($sql);

    if ($row = $result->fetch_assoc()) {
        $gameMessage = "<p>You are playing the <b>{$puzzlename}</b> puzzle. The currrent high score is:<b>{$row['score']}</b></p>";
    }
}
?>
    <div><?php echo $gameMessage ?></div>

</html>