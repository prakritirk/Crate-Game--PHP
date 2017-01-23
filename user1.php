<?php
session_start();
if (!isset($_SESSION["uname"])) {
    header('Location:index.php');
    exit;
}
?>
<html>
    <head>
        <title>User Page</title>
        <link rel="stylesheet" type="text/css" href="styles_change.css">
    </head>
    <body>
        <div id="nav">
            <div id="navigation">


                <a id="a1" href="home.php">Home</a>
                <a id="a1" href="index.php">Play Game</a>
                <a id="a3" href="puzzlegame.php">Puzzle List</a>
                <a id="a3" href="logoff.php">Log Out</a>
                
            </div>
            <div id="content-sidebar">
                <div id="content">


                    <p>

                        <img src="thumbs.png" alt="Success"/>

                    </p>
                    <center>
                        <h1> You are successfully logged In as <?php echo $_SESSION["uname"]; ?></h1>

                    </center>
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