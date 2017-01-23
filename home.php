<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, td {

                width:50%;
                text-align: left;
                background-color: whitesmoke;
            }
            th {
                border: 1px black;
                background-color: grey;
                color: white;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="styles_change.css">
    </head>
    <body
        <div id="nav">
            <div id="navigation">
                <a id="a1" href="#">Home</a>
                <a id="a3" href="index.php">Play Game</a>

                <a id="a3" href="puzzlegame.php">Puzzle List</a>

                <?php
                if (isset($_SESSION["logged"])) {
                    //$printname = $_SESSION["uname"];
                    echo $_SESSION["uname"];


                    echo'<a id="a4" href="logoff.php">Log Out</a>';
                } else {
                    echo '<a id="a2" href="modsignup.php">Sign Up</a>';
                    echo '<a id="a4" href="sigin1.php">Login</a>';
                }
                ?>
            </div>
            <div id="content-sidebar">


                <div id="content">
                    <p><h1>How to Play the Game</h1><p>
                    <h2>Goal of the Game</h2>
                    <p> Push the Target to your pusher's initial position and maintain least score possible.Score increases with each move.</p>
                   
                    <h3>General</h3>
                    <ul>

                        <li>The pusher can be moved using "up" "down" "left" and "right" arrows.</li>
                        <li>You can destroy the weight in front of pusher using "X" key press but it will increase your score. </li>
                        
                        <br>
                        <img src="arrays.JPG" alt="Keys"/></br>

                    </ul>
                    </li>
                    </ul>



                </div>
                <div id="sidebar">
                    <h2>Sponsers</h2>
                    <ul>
                        <li>Starla's Gears</li>
                        <li>Zubaz</li>
                        <li>Tupperware</li>
                        <li>American Friends Society</li>
                    </ul>
                </div>
            </div>
            <div id="footer">
                <p>Address: 414 E. Clark Street, Vermillion, SD 57069</p>
                <p>Contact details: Skype: 877-COYOTES Free,  877-2696837 Free</p>
            </div>
    </body>
</html>