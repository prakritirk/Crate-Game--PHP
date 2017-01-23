<?php
session_start();
?>
<!DOCTYPE HTML> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php print_r($_POST); ?>

        </title>
        <link rel="stylesheet" type="text/css" href="styles_change.css">
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body> 
        <div id="nav">
            <div id="navigation">
                <a id="a1" href="home.php">Home</a>
                <a id="a1" href="index.php">Play Game</a>
                <a id="a3" href="puzzlegame.php">Puzzle List</a>
                <a id="a4" href="modsignup">Sign Up</a>



            </div>
            <div id="content-sidebar">
                <div id="content">
                    <?php
// define variables and set to empty values
                    $unameErr = $emailErr = $passwordErr = "";
                    $uname = $email = $password = "";
                    $errors = array();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//                        if (empty($_POST["uname"])) {
//                            $uname = "";
//                            $unameErr = "enter tag";
//                            $errors['uname'] = "Fill it";
//                        } else {
//                            $uname = test_input($_POST["uname"]);
//                            // check if URL address syntax is valid
//                            if (!preg_match("/^[a-zA-Z ]*$/", $uname)) {
//                                $unameErr = "Only letters and white space allowed";
//                                $errors['uname'] = "Fill it";
//                            }
//                        }

                        if (empty($_POST["email"])) {
                            $emailErr = "Email is required";
                            $errors['email'] = "Fill it";
                        } else {
                            $email = test_input($_POST["email"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $emailErr = "Invalid email format";
                                $errors['email'] = "Fill it";
                            }
                        }

                        if (empty($_POST["password"])) {
                            $password = "";
                            $errors['password'] = "Fill it";
                            $passwordErr = "enter password";
                        } else {
                            $password = md5($_POST["password"]);

                            // check if URL address syntax is valid
                            if (!preg_match("/^[\w]+$/", $password)) {
                                $passwordErr = "Numbers Letters and Alphanumeric Values allowed";
                                // $errors['password'] = '<p>error in password</p>';
                                //$errors['password']=true;
                                $errors['password'] = "Fill it";
                            }
                        }
                    }

                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    ?>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === "GET" || ($errors == 0)) {
//                        $uname = htmlentities($uname);
                        $password = htmlentities($password);
                        $email = htmlentities($email);
                    }
                    ?>
                    <?php
                    $mess = "";

                    if (isset($_POST["submit"])) {

                        //conncet to the database
                        //require_once("../Raj/user.php");
                        //include("../Raj/dbcon.php");	//database connection function




                        if (count($errors) == 0) {


                            $email = $_POST["email"];



//                            $username = $_POST["uname"];
                            $password = md5($_POST["password"]);

                            $mysqli = new mysqli('localhost', 'root', 'root', 'cratedb');
                            //check connection
                            if ($mysqli->connect_error) {
                                die('Connect Error:' . $mysqli->connect_errno . ':' . $mysqli->connect_error);
                            }



                             $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
                            $result = $mysqli->query($query);

                           while($row=mysqli_fetch_array($result)) {
		$name=$row["0"];
	}
	
	if(mysqli_num_rows($result)==0) {
		$mess = "<font color=purple size=2><b>Wrong username or password.<br>Please try again.</b></font>";
                $_SESSION["logged"]=FALSE;
               // header($authHeader);
               // header($responseLine);
                die("Username and Password combination incorrect!");
                exit;
	} else {
                $_SESSION["uname"]=$name;
		//$_SESSION["uname"]=  htmlentities($_GET["uname"]);
               // setcookie("uname",  htmlentities($_GET["uname"]));
                $_SESSION["logged"]=True;
		
		//header("Location:../Raj/user1.php");
                header("Location:user1.php");
               // header("Location:../Raj/puzzlegame.php");
		exit;
	}
                           
                        }
                    }
                    ?>

                    <h2>Sign In</h2>
                    <p><span class="error"></span></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
<!--                        Tag:<br> <input type="text" name="uname" required value="<?php print $uname; ?>">
                        <span class="error"> <?php echo $unameErr; ?> </span>
                        <br><br>-->
                        E-mail:<br> <input type="text" name="email" required value="<?php print $email; ?>">
                        <span class="error">* <?php echo $emailErr; ?></span>
                        <br><br>
                        Password:<br> <input type="password" name="password" >
                        <span class="error">* <?php echo $passwordErr; ?></span>
                        <br><br>

                        <input type="submit" name="submit" value="Submit"> 
                    </form>


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