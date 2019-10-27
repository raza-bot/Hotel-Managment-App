<?php
    require_once 'db_connection.php';
    require_once 'utilities.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    //Logs user in using MySQL
    function login($result, $pass, $conn){
        if($result->num_rows){
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $query = "SELECT * FROM Employee WHERE userId='$row[0]'";
            $result = $conn->query($query);
            if($result->num_rows){
                $token = hash('ripemd128', $pass);
                if($token == $row[5]){
                    echo <<<_END
                        <!-- Logout -->
                        <p>Logged in as $row[2] $row[3]!</p>
                        <form action="admin.php" method="post">
                            <button type="submit" name="logout-submit">Logout</button>                
                        </form>
                        </div>
                    _END;
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
                    $query = "INSERT INTO Employee(userId, isAdmin, salary) VALUES ('$row[0]', '$admin', 0)";
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

<style> 
    body, html {height: 100%}
    .bgimg {
      background-image: url('img/sunset.jpg');
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
</style>

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
        if(isset($_POST['login-submit'])){
            //Sanitizing
            $userOrEmail = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);

            $queryEmail = "SELECT * FROM User WHERE email='$userOrEmail'";
            $queryUsername = "SELECT * FROM User WHERE userName='$userOrEmail'";
            $resultEmail = $conn->query($queryEmail);
            $resultUsername = $conn->query($queryUsername);

            if (!$resultUsername && !$resultEmail) { 
                echo "<script type='text/javascript'>alert(\"Email or Password is Wrong!\");</script></script><noscript>Email or Password is Wrong!</noscript>";
                throw new Exception("Not Found");
            }
            else if($resultUsername->num_rows){
                login($resultUsername, $pass, $conn);
            }
            else if($resultEmail->num_rows){
                login($resultEmail, $pass, $conn);
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
                <input type="text" name="first" placeholder="First Name">
                <input type="text" name="last" placeholder="Last Name">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="mailuid" placeholder="Email">
                <input type="password" name="pwd" placeholder="Password">
                <input type="checkbox" name="admin" value="Admin">Is Admin?<br>
                <button type="submit" name="SignUp">Sign Up</button>    
                <button type="submit" name="backtologin">Log In</button>            
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
            <input type="text" name="mailuid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
            <button type="submit" name="signup-submit">Sign Up</button>
            <a href="index.php">Back</a>
        </form>   
        </div>
    _END;
    }
    echo "</div></div></body></html>"
?>