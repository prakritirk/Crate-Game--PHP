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
                <a id="a1" href="home.php">Home</a>
                <a id="a1" href="index.php">Play Game</a>
                 
                <a id="a3" href="#">Puzzle List</a>

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
                    <?php
                    $con = mysqli_connect("localhost", "root", "root", "cratedb");

// Check connection
                    if (!$con) {
                        die("Failed to connect to MySQL: ");
                        exit();
                    }

                    echo'CHOOSE THE PUZZLE';
                    $sql = "SELECT * FROM puzzles";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table><tr><th>Puzzle Name</th><th>Name</th><th>Highest Score</th></tr>";
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            
                            $puzzname=$row["puzname"];
                            $seed=$row["seedlev"];
                            echo "<tr><td><a href=index.php?puzzlename=$puzzname&seed=$seed>" . $row["puzname"] . "</a></td><td>" . $row["name"] . " </td><td>" . $row["score"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    $con->close();
                    ?>
                   
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