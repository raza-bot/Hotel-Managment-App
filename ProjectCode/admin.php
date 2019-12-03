<?php
    require_once 'db_connection.php';
    require_once 'utilities.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    session_start();

    if(isset($_POST['logout-submit'])){
        destroy_session_and_data();
    }

    if(isset($_SESSION['token'])){
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $userid = $_SESSION['userid'];
        $first = $_SESSION['firstname'];
        $last = $_SESSION['lastname'];
        $token = $_SESSION['token'];
    }

    //Logs user in using MySQL
    function login($result, $pass, $conn){
        if($result->num_rows){
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $query = "SELECT * FROM employee WHERE userId='$row[0]'";
            $result = $conn->query($query);
            if($result->num_rows){
                $token = hash('ripemd128', $pass);
                if($token == $row[5]){
                    $_SESSION['username'] = $row[1];
                    $_SESSION['email'] = $row[4];
                    $_SESSION['userid'] = $row[0];
                    $_SESSION['firstname'] = $row[2];
                    $_SESSION['lastname'] = $row[3];
                    $_SESSION['token'] = $token;
                    displayLoggedIn($row[2], $row[3]);
                    header("Location: #");
                }
                else{
                    throw new Exception("Wrong Pass");
                }
            }
            else{
                throw new Exception("Not Customer");
            }
        }
    }

    if(isset($_POST['SignUp'])){
        if(isset($_POST['mailuid']) && isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['first'])&& isset($_POST['last'])){
            $username = mysql_entities_fix_string($conn, $_POST['username']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);
            $email = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $first = mysql_entities_fix_string($conn, $_POST['first']);
            $last = mysql_entities_fix_string($conn, $_POST['last']);
    
            $token = hash('ripemd128', $pass);
    
            $query = "INSERT INTO User(userName, firstName, lastName, email, passHash) VALUES ('$username', '$first', '$last', '$email', '$token')";
            $result = $conn->query($query);
            if(!$result){
                echo "<script type='text/javascript'>alert(\"ERROR\");</script><noscript>ERROR</noscript>";
            }
            else{
                $queryEmail = "SELECT * FROM User WHERE email='$email'";
                $result = $conn->query($queryEmail);
                if($result->num_rows){
                    $row = $result->fetch_array(MYSQLI_NUM);
                    $result->close();
                    $admin = isset($_POST['admin']);
                    $salary = rand(40000, 90000);
                    if($admin){
                        $salary = rand(80000, 140000);
                    }
                    $query = "INSERT INTO Employee(userId, isAdmin, salary) VALUES ('$row[0]', '$admin', '$salary')";
                    $result = $conn->query($query);
                }
            }
        }    
    }
    
    echo <<<_END
<html>
<title>Admin Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style> 
    body, html {height: 100%}
    .bgimg {
      background-image: url('img/hotel_img.png');
      min-height: 100%;
      background-position: center;
      background-size: cover;
    }

     div {
      padding-top: 20px;
      padding-right: 20px;
      padding-bottom: 20px;
      padding-left: 20px;
    }
    
    .mybtn {
        box-shadow:inset 0px 0px 0px 2px #9fb4f2;
        background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
        background-color:#7892c2;
        border-radius:11px;
        border:5px solid #4e6096;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Arial;
        font-size:28px;
        padding:16px 37px;
        text-decoration:none;
        text-shadow:0px 1px 0px #283966;
    }
    .mybtn:hover {
        background:linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
        background-color:#476e9e;
    }
    .mybtn:active {
        position:relative;
        top:1px;
    }

    input[type="text"], [type="password"]{
        width: auto;
        color: black;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 13px;
        resize: vertical;
    }
    input:focus { 
        outline: none !important;
        border-color: #719ECE;
        box-shadow: 0 0 10px #719ECE;
    }

</style>
</head>
<body style="margin: 0;">

<body>
    <div class="bgimg">

      <div class="topleft">
       <p style = "color: white; font-size: 36px">
           Hotel Admin
       </p>
      </div>

      <div class="middle" align="center" style = "color:white">
_END;
    //Display Logout if signed in
    try{
        if(isset($_POST['inventory-submit'])){
            echo <<<_END
                <div style='background-color: white;'>
                <form action="admin.php" method="post">
                    <button class="btn btn-danger" type="submit" name="SignUp">Back</button>
                </form>
            _END;
            require "inventory.php";
            echo "</div>";
        }
        else if(isset($token)){
            displayLoggedIn($first, $last);
        }
        else if(isset($_POST['login-submit'])){
            //Sanitizing
            $userOrEmail = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM User WHERE email='$userOrEmail' OR userName='$userOrEmail'";
            $result= $conn->query($query);

            if (!$result) { 
                echo "<script type='text/javascript'>alert(\"Email or Password is Wrong!\");</script></script><noscript>Email or Password is Wrong!</noscript>";
                throw new Exception("Not Found");
            }
            else if($result->num_rows){
                login($result, $pass, $conn);
            }
            else if(isset($_POST['inventory-submit'])){
                require "inventory.php";
            }
            else{
                throw new Exception("Not Found");
            }
        }  
        else if(isset($_POST["signup-submit"])){
            echo <<<_END
            <font size = "36">
                Admin Sign Up
            </font>
            <hr style="width:50%">
            <form action="admin.php" method="post">
                <input type="text" name="first" placeholder="First Name"><br>
                <input type="text" name="last" placeholder="Last Name"><br>
                <input type="text" name="username" placeholder="Username"><br>
                <input type="text" name="mailuid" placeholder="Email"><br>
                <input type="password" name="pwd" placeholder="Password"><br>
                <input type="checkbox" name="admin" value="Admin">Is Admin?<br>
                <button class="btn btn-default" type="submit" name="SignUp">Sign Up</button>    
                <button class="btn btn-default" type="submit" name="backtologin">Log In</button>            
            </form>
            _END;
        }
        else{
            throw new Exception("Not Login");
        }
    }
    catch(Exception $e){
    echo <<<_END
        <!-- Login  --> 
        <font size = "36">
             Admin Login
        </font>
        <hr style="width:50%">
        <form action="admin.php" method="post">
            <input type="text" name="mailuid" placeholder="Username/Email"><br>
            <input type="password" name="pwd" placeholder="Password"><br><br>
            <button type="submit" class="btn btn-default" name="login-submit">Login</button>
            <button type="submit" class="btn btn-default" name="signup-submit">Sign Up</button><br>
        </form>   
        <form action="index.php" method="post">
            <button type="submit" class="btn btn-danger">Back</button>
        </form>
        </div>
    _END;
    }
    echo "</div></div></body></html>";


    function displayLoggedIn($first, $last){
        echo <<<_END
                <!-- Logout -->
                <h1>Logged in as $first $last!</h1>
                <form action="admin.php" method="post">
                    <button type="submit" class="mybtn" name="logout-submit">Logout</button> 
                </form>
                
                <form action="admin.php" method="post">
                    <button type="submit" class="mybtn" name="inventory submit">Inventory</button>   
                    <input type='hidden' name='inventory-submit'>
                </form>
                </div>
        _END;
    }
?>