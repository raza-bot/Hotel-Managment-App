<?php
    require_once 'db_connection.php';
    require_once 'utilities.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    session_start();

    if(isset($_POST['logout-submit'])){
        destroy_session_and_data();
    }

    if(isset($_SESSION['tokenA'])){
        $username = $_SESSION['usernameA'];
        $email = $_SESSION['emailA'];
        $userid = $_SESSION['useridA'];
        $first = $_SESSION['firstnameA'];
        $last = $_SESSION['lastnameA'];
        $token = $_SESSION['tokenA'];
        $hotelId = $_SESSION['hotelId'];
    }

    if(isset($_POST['delete'])){
        $number = $_POST['number'];

        $query = "DELETE FROM room WHERE roomNum='$number' AND hotelID='$hotelId';";
        $conn->query($query);
    }

    if(isset($_POST['addroom'])){
        $number = mysql_entities_fix_string($conn, $_POST['number']);
        $price = mysql_entities_fix_string($conn, $_POST['price']);
        $type = $_POST['type'];

        $query = "INSERT INTO room(hotelID, roomNum, type, status, price) VALUES('$hotelId', '$number', '$type', 0, '$price');";
        $conn->query($query);
    }

    if(isset($_POST['updateroom'])){
        $number = mysql_entities_fix_string($conn, $_POST['number']);
        $price = mysql_entities_fix_string($conn, $_POST['price']);
        if(isset($_POST['status'])){
            $query = "UPDATE room SET status=true, price='$price' WHERE hotelID='$hotelId' AND roomNum='$number';";
            $conn->query($query);
        }
        else{
            $query = "UPDATE room SET status=false, price='$price' WHERE hotelID='$hotelId' AND roomNum='$number';";
            $conn->query($query);
        }
    }

    if(isset($_POST['SignUp'])){
        if(isset($_POST['hotel']) && isset($_POST['mailuid']) && isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['first'])&& isset($_POST['last'])){
            $username = mysql_entities_fix_string($conn, $_POST['username']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);
            $email = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $first = mysql_entities_fix_string($conn, $_POST['first']);
            $last = mysql_entities_fix_string($conn, $_POST['last']);

            $hotelId = explode("ID: ",$_POST['hotel'])[1];
    
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
                    $query = "INSERT INTO has(hotelID, userID) VALUES ('$hotelId', '$row[0]')";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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

    input[type="text"], [type="password"], [type="number"]{
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

    select{
        width: auto;
        color: black;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 13px;
        resize: vertical;
    }
    select:focus { 
        outline: none !important;
        border-color: #719ECE;
        box-shadow: 0 0 10px #719ECE;
    }

    div[value='content'] {
        margin: 20;
        opacity: 90%;
        word-wrap: break-word;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0px 0px 3px 1px #000000;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-right:10px;
        padding-left:8px;
    }
    .eff {
        /* Add shadows to create the "card" effect */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
      }
    .eff:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    img[value='roomimg']{
        width: 310px;
        height: 225px;
        object-fit: cover;
        border-radius: 8%;
    }

</style>
</head>
<body>
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
            displayLoggedIn($conn, $userid, $first, $last);
        }
        else if(isset($_POST['login-submit'])){
            //Sanitizing
            
            $userOrEmail = mysql_entities_fix_string($conn, $_POST['mailuid']);
            $pass = mysql_entities_fix_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM User WHERE email='$userOrEmail' OR userName='$userOrEmail'";
            $result= $conn->query($query);

            if (!$result) { 
                echo "hotel";
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
                <select name="hotel">
            _END;
            loadHotels($conn);
            echo <<<_END
                </select><br>
                <input type="checkbox" name="admin" value="Admin">Is Admin?<br>
                <button class="btn btn-default" type="submit" name="SignUp">Sign Up</button>    
                <button class="btn btn-default btn-danger" type="submit" name="backtologin">Back</button>            
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
                    $query = "SELECT hotelID FROM has WHERE userID='$row[0]';";
                    $result = $conn->query($query);
                    if(!$result){
                        throw new Exception("Wrong Pass");
                    }
                    $hotelId = $result->fetch_array(MYSQLI_NUM)[0];
                    $_SESSION['usernameA'] = $row[1];
                    $_SESSION['emailA'] = $row[4];
                    $_SESSION['useridA'] = $row[0];
                    $_SESSION['firstnameA'] = $row[2];
                    $_SESSION['lastnameA'] = $row[3];
                    $_SESSION['tokenA'] = $token;
                    $_SESSION['hotelId'] = $hotelId;
                    displayLoggedIn($conn, $row[0], $row[2], $row[3]);
                }
                else{
                    throw new Exception("Wrong Pass");
                }
            }
            else{
                throw new Exception("Not Admin");
            }
        }
    }

    function displayLoggedIn($conn, $userid, $first, $last){
        echo <<<_END
            <!-- Logout -->
            <h1>Welcome $first $last!</h1>
            <form action="admin.php" method="post">
                <button type="submit" class="btn btn-danger btn-lg eff" name="logout-submit">Logout</button> 
            </form>
            
            <form action="admin.php" method="post">
                <button type="submit" class="btn btn-info btn-lg eff" name="inventory submit">Inventory</button>   
                <input type='hidden' name='inventory-submit'>
            </form>
            <div id="addRoomModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Payment</h4>
                    </div>
                    <form action="admin.php" method="post">
                            <div class="modal-body">
                                <input name="number" type="number" placeholder="Room Number" required/><br><br>
                                <input name="price" type="text" pattern="(\d+\.\d{1,2})" placeholder="Price" required/><br><br>
                                <select name="type" placeholder="Type" required/>
                                    <option value='Single'>Single</option>
                                    <option value='Double'>Double</option>
                                    <option value='Triple'>Triple</option>
                                    <option value='Regular'>Regular</option>
                                    <option value='Suite'>Suite</option>
                                </select><br><br>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-default" name="addroom"><b>Add</b></button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-lg eff" data-toggle="modal" data-target="#addRoomModal">Add Room</b></button>
            </div>
        _END;

        $query = "SELECT * FROM (SELECT * FROM room JOIN hotel ON id=hotelID)hotel_room 
                    JOIN has ON hotel_room.hotelID=has.hotelID 
                    WHERE userID='$userid';";

        $result = $conn->query($query);

        if(!$result){

        }
        else{
            $rows = $result->num_rows;
        for ($j = 0; $j < $rows; $j++)  // Go through each row
            {
                $result->data_seek($j);     // Get data from row
                $row = $result->fetch_array(MYSQLI_NUM);    // Put row data into array

                echo <<<_END
                <div value='content' class="row">
                    <img value='roomimg' class="col-sm-2" src="img/$row[2].jpg">
                    <div class="col-sm-6" style="margin: auto;">
                        <h2><b>$row[6]</b></h2>
                        <a href="http://maps.google.com/maps?q=<?=$row[7]?>"><h5>Address: <b>$row[7]</b></h5></a>
                        <h4>Type: <b>$row[2]</b></h4> 
                        <h4>Room Number: <b>$row[1]</b></h4>
                        <h3 style="color:Green;"><b>$$row[4]</b> <small>PER NIGHT</small></h3>
                    </div>
                    <div class="col-sm-3" align="center" style="margin-top:45;">
                        <button type="submit" class="btn btn-warning btn-lg eff" data-toggle="modal" data-target="#editRoomModal$j">EDIT</b></button>
                        <form action="admin.php" method="post">
                            <input name="number" type="hidden" value='$row[1]'><br>
                            <button name="delete" type="submit" class="btn btn-danger btn-lg eff">DELETE</b></button>
                        </form>
                    </div>
                </div>
                <div id="editRoomModal$j" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Room</h4>
                        </div>
                        <form action="admin.php" method="post">
                                <div class="modal-body">
                                    <input name="number" type="hidden" value='$row[1]'>
                                    <input name="price" type="text" pattern="(\d+\.\d{1,2})" placeholder="Price" value='$row[4]' required/><br><br>
                _END;
                                    if($row[3] == 0){
                                        echo "<input name='status' type='checkbox' value='true'>Status?<br>";
                                    }
                                    else{
                                        echo "<input name='status' type='checkbox' value='true' checked>Status?<br>";
                                    }
                echo <<<_END
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-default" name="updateroom"><b>Edit</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                _END;
            }
        }
    }

    function loadHotels($conn){
        $query = "SELECT id, name FROM hotel";
        $result = $conn->query($query);
        if(!$result){
            echo "<option value='none'>N/A</option>";
        }

        if($result->num_rows){
            $rows = $result->num_rows;
            for ($j = 0; $j < $rows; $j++)  // Go through each row
            {
                $result->data_seek($j);     // Get data from row
                $row = $result->fetch_array(MYSQLI_NUM);    // Put row data into array
                $val = "$row[1] ID: $row[0]";
                echo "<option value='$val'>$val</option>";
            }
        }
    }
?>