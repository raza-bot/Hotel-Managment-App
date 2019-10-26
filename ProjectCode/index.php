<?php
    require_once 'db_connection.php';
    require_once 'utilities.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    //Logs user in using MySQL
    function login($result, $pass){
        if($result->num_rows){
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $token = hash('ripemd128', $pass);
            if($token == $row[5]){
                echo <<<_END
                    <!-- Logout -->
                    <p>Logged in as $row[2] $row[3]!</p>
                    <form action="index.php" method="post">
                        <button type="submit" name="logout-submit">Logout</button>                
                    </form>
                    </div>
                _END;
            }
            else{
                echo <<<_END
                <!-- Login  --> 
                <form action="index.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                    <button type="submit" name="signup-submit">Sign Up</button>                  
                </form>
                </div>
            _END;
            }
        }
    }

    //Signs user up if everything is entered
    if(isset($_POST['SignUp'])){
        if(isset($_POST['mailuid']) && isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['first'])&& isset($_POST['last'])){
            $username = mysql_entities_fix_string($conn, $_POST['username']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);
            $email = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $first = mysql_entities_fix_string($conn, $_POST['first']);
            $last = mysql_entities_fix_string($conn, $_POST['last']);
    
            $token = hash('ripemd128', $pass);
    
            $query = "INSERT INTO user(userName, firstName, lastName, email, passHash) VALUES ('$username', '$first', '$last', '$email', '$token')";
            $result = $conn->query($query);
            if(!$result){
                echo "<script type='text/javascript'>alert(\"ERROR\");</script><noscript>ERROR</noscript>";
            }
        }    
    }

    echo <<<_END
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name=viewport content="width=device-width, intial-scale=1">
            <title>Testing Website</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
    
        <header>
            <nav class="nav-header-main">
                <!-- Logo Image -->
                <a class="header-logo" href="index.php">
                    <img src="img/hotel_logo.PNG" alt="logo"> 
                </a>   
                <!-- Access buttons on top of page --> 
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.inc.php">Hotels</a></li>
                    <li><a href="#">Contact</a></li> 
                </ul> 
            </nav>   
                <div class="header-login">
    _END;

    //Display Logout if signed in
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
        }
        
        if($resultUsername->num_rows){
            login($resultUsername, $pass);
        }
        else if($resultEmail->num_rows){
            login($resultEmail, $pass);
        }
        else{
            echo <<<_END
                <!-- Login  --> 
                <form action="index.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                    <button type="submit" name="signup-submit">Sign Up</button>                  
                </form>
                </div>
            _END;
        }
    }
    else{
    echo <<<_END
        <!-- Login  --> 
        <form action="index.php" method="post">
            <input type="text" name="mailuid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
            <button type="submit" name="signup-submit">Sign Up</button>                  
        </form>
        </div>
    _END;
    }
    
    echo "</header></body>";

    //Display Sign up if user wants to signup
    if(isset($_POST['signup-submit'])){
        echo <<<_END
        <!-- Logout -->
        <body>
        <form action="index.php" method="post">
            <input type="text" name="first" placeholder="First Name">
            <input type="text" name="last" placeholder="Last Name">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="mailuid" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="SignUp">Sign Up</button>                
        </form>
        </body>
    _END;
    }
    else{
    echo <<<_END
        <main>
            <p>Blah Blah Blah</p>
            <p>Test Test Test</p>
        </main>
    _END;
    }

    require "footer.php";
?>