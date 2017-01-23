<?php

/* connect to mysql database */
include 'user.php';
$non = mysqli_connect("localhost", "root", "root", "cratedb") or die("Can't connect to server");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>