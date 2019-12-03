<?php
    require_once 'db_connection.php';
    require_once 'utilities.php';
    require_once 'index.php';

    $today = date('Y-m-d');
    $max = date('Y-m-d', strtotime("+6 Months"));

    $cardNumber = "";

    try{
        if(!isset($userid)) {throw new Exception("Not Logged In");}
        $card = getCard($conn, $userid);
        $cardNumber = substr(cipher($card[1], $card[0], 'd'), 12);
    }
    catch(Exception $e){}

    $search = "";
    $from = date('Y-m-d');
    $to = date('Y-m-d', strtotime("+5 Days"));

    if(isset($_POST['searchtext'])){
        $search = strtolower(mysql_entities_fix_string($conn, $_POST['searchtext']));
        $from = $_POST["from"];
        $to = $_POST["to"];
    }
    else{
        $search = "";
        $from = date('Y-m-d');
        $to = date('Y-m-d', strtotime("+5 Days"));
    }

    if(isset($_POST['book'])){
        if(isset($_POST["adult-quantity"]) && isset($_POST["child-quantity"]) 
            && isset($_POST["fromBook"]) && isset($_POST["toBook"]) && isset($_POST["payment"])){
            
            $adult = $_POST["adult-quantity"];
            $children = $_POST["child-quantity"];
            $hotelid = $_POST["hotelid"];
            $roomnum = $_POST["roomnumber"];
            $fromBook = $_POST["fromBook"];
            $toBook = $_POST["toBook"];

            $query = "INSERT INTO reserve(hotelId, RoomNum, Customerid, StartFrom, EndTo, adults, children) VALUES
                        ('$hotelid', '$roomnum', '$userid', '$fromBook', '$toBook', '$adult', '$children');";

            $result = $conn->query($query);

            if(!$result){
                echo "<script type='text/javascript'>alert(\"ERROR\");</script><noscript>ERROR</noscript>";
            }
        }
    }



    echo <<<_END
    <head>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="homepage.css">
        
        <style>
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
            div[value='search'] {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin: 20;
                opacity: 90%;
                word-wrap: break-word;
                background-color: #ffffff;
                border-radius: 20px;
                box-shadow: 0px 0px 3px 1px #000000;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right:0px;
                padding-left:0px;
            }
            img[value='roomimg']{
                width: 300px;
                height: 200px;
                object-fit: cover;
                border-radius: 8%;
            }
            input[type=text]{
                width: 50%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 13px;
                resize: vertical;
            }
            input[type=date]{
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
    <div class="slogan-text-box">
        <h1>A home away from home</h1>
    </div>
    <form action="index.php" method="post">
        <div value='search' class="row">
            <input type="text" placeholder="Search e.g. Hotel, Room Type, Address" name="searchtext">
            <div><b style="font-size:20;">From:</b>  <input type="date" name="from" min=$from max=$max value=$from></div>
            <div><b style="font-size:20;">To:</b>  <input type="date" name="to" min=$from max=$max value=$to></div>
            <button type="submit" class="btn btn-default" name="search"><b>Search</b></button>
        </div>
    </form>
    
    _END;

    $query = "SELECT * FROM reserve;";

    $result = $conn->query($query);

    if($result->num_rows > 0){
        $query = "SELECT * FROM (SELECT * FROM room JOIN hotel ON room.hotelID=hotel.id WHERE 
                LOWER(name) LIKE '%$search%' OR LOWER(type) LIKE '%$search%' OR LOWER(address) LIKE '%$search%')hotel_room
	            WHERE (hotel_room.id NOT IN (SELECT hotelId FROM reserve) AND hotel_room.roomNum NOT IN (SELECT RoomNum FROM reserve))
                OR id NOT IN ((SELECT hotelId as Id FROM reserve WHERE StartFrom>='$from' and StartFrom<'$to' or EndTo<='$to' and EndTo>'$from'));";
    }
    else{
        $query = "SELECT * FROM room JOIN hotel ON room.hotelID=hotel.id WHERE 
            LOWER(name) LIKE '%$search%' OR LOWER(type) LIKE '%$search%' OR LOWER(address) LIKE '%$search%'";
    }

    $result = $conn->query($query);

    if (!$result) {
        echo "Something went wrong!";  // Statement so we know something didn't go as planned
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
            _END;
            if(!isset($username)){
                echo <<<_END
                <div class="col-sm-3" align="center" style="margin-top:80;">
                    <b style="font-size:20;border: 1px solid #ccc;border-radius: 13px;padding: 12px">Log In To Book</b>
                </div>
                _END;
            }
            else if($cardNumber != ""){
                echo <<<_END
                    <div class="col-sm-3" align="center" style="margin-top:65;">
                        <button type="submit" class="btn btn-info btn-lg eff" data-toggle="modal" data-target="#bookModal$j">Book For <b>$$row[4]</b></button>
                    </div>
                </div>
                <div id="bookModal$j" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Book Hotel</h4>
                        </div>
                        <form action="index.php" method="post">
                                <div class="modal-body" align='center'>
                                    Name: $first $last<br>
                                    Username: @$username<br>
                                    Email: $email<br><br>
                                    Adults: <input type="number" name="adult-quantity" min="1" max="5" value=1> 
                                    Children: <input type="number" name="child-quantity" min="0" max="5" value=0> <br>
                                    Payment: Card Ending w/ $cardNumber<br>
                                    From: $from <br>
                                    To: $to <br><br>
                                    Room and Hotel Information <br>
                                    Hotel: $row[6] <br>
                                    Address: $row[7] <br>
                                    Room Type: $row[2] <br>
                                    Room Number: $row[1] <br>
                                    Price: $$row[4] <br>
                                    <input type="hidden" name="hotelid" value="$row[0]">
                                    <input type="hidden" name="roomnumber" value="$row[1]">
                                    <input type="hidden" name="fromBook" value="$from">
                                    <input type="hidden" name="toBook" value="$to">
                                    <input type="hidden" name="payment" value="$cardNumber">
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-default" name="book"><b>Confirm & Book</b></button>
                            </div>
                            </div>
                        </form>
                    </div>
                
                _END;
            }
            else{
                echo <<<_END
                    <div class="col-sm-3" align="center" style="margin-top:65;">
                        <button type="submit" class="btn btn-info btn-lg eff" data-toggle="modal" data-target="#bookModal$j">Book For <b>$$row[4]</b></button>
                    </div>
                </div>
                <div id="bookModal$j" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Payment to Book</h4>
                        </div>
                        <form action="index.php" method="post">
                                <div class="modal-body" align='center'>
                                    <h4>Go to Profile and Add Payment Method!</h4>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </form>
                    </div>
                
                _END;
            }
            echo "</div>";
        }
    }
?>