<?php
    require_once 'utilities.php';

    $today = date('Y-m-d');
    $userid = $_SESSION["userid"];

    if(isset($_POST['addpayment'])){
        if(isset($_POST['cardnum']) && isset($_POST['name']) && isset($_POST['cvv']) && isset($_POST['expire'])){
            $name = mysql_entities_fix_string($conn, $_POST['name']);
            $number = mysql_entities_fix_string($conn, $_POST['cardnum']);
            $cvv = mysql_entities_fix_string($conn, $_POST['cvv']);
            $expire = $_POST['expire'];

            $encNumber = cipher($number, $name, 'e');
            $encCvv = cipher($cvv, $name, 'e');

            $query = "INSERT INTO Payment(name, cardNum, cvv, expDate) VALUES ('$name', '$encNumber', '$encCvv', '$expire')";
            $result = $conn->query($query);
            if(!$result){
                echo "<script type='text/javascript'>alert(\"ERROR\");</script><noscript>ERROR</noscript>";
            }
            else{
                $query = "INSERT INTO have(userid, cardNum) VALUES ('$userid', '$encNumber')";
                $result = $conn->query($query);
            }
        }
    }

    if(isset($_POST['cancel'])){
        echo 'Helo';
        $hotelId = $_POST['hotelId'];
        $roomNum = $_POST['roomNum'];
        $query = "DELETE FROM reserve WHERE Customerid='$userid' AND hotelId='$hotelId' AND RoomNum='$roomNum';";
        $conn->query($query);
    }

    if(isset($_POST['del'])){
        $cardNum = $_POST['cardNum'];
        $query = "DELETE FROM Payment WHERE cardNum='$cardNum'";
        $conn->query($query);
        $query = "DELETE FROM have WHERE cardNum='$cardNum'";
        $conn->query($query);
    }

    echo <<<_END
    <head>
        <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
        <style>
        input[type=text]{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 13px;
        }
        input[type=number]{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 13px;
        }
        input[type=date]{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 13px;
        }
        input:focus { 
            outline: none !important;
            border-color: #719ECE;
            box-shadow: 0 0 10px #719ECE;
        }
        .eff {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
          }
        .eff:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card {
            margin: 30px;
            padding: 12px;
            background-color:white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 10px; /* 5px rounded corners */
        }
        
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card2 {
            margin: 30px;
            padding: 12px;
            background-color:white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 10px; /* 5px rounded corners */
        }
        
        .card2:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        
        </style>
    </head>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <h4 style="text-decoration: underline;"><i>Your Information</i></h4>
                    <br>
                    <h4><b>Name: $first $last</b></h4>
                    <hr>
                    <h4><b>Username: @$username</b></h3>
                    <hr>
                    <h4><b>Email: $email</b></h3>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <h4 style="text-decoration: underline;"><i>Payment Information</i></h4>
                <br>
    _END;

    if(!displayCards($conn, $userid)){
        echo <<<_END
                <center>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPaymentModal">Add Payment</button>
                </center>
            </div>
            </div>
        _END;
    }

    echo <<<_END
        </div>
        <div class="card2">
            <h4 style="text-decoration: underline;"><i>Reservations</i></h4>
            <br>
    _END;

    displayReservation($conn, $userid);

    echo <<<_END
        </div>
        <div id="addPaymentModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Payment</h4>
                </div>
                <form action="index.php" method="post">
                        <div class="modal-body">
                            <input type="text" name="name" pattern="^[A-Za-z -]+$" minlength="1" placeholder="Name On Card" required/><br><br>
                            <input name="cardnum" type="text" pattern="\d*" minlength="16" maxlength="16" placeholder="Card Number" required/><br><br>
                            <input name="cvv" type="text" pattern="\d*" minlength="3" maxlength="3" placeholder="CVV" required/><br><br>
                            <input type="hidden" name="profile-submit"/>
                            <input type="date" name="expire" min='$today' value='$today'/>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default" name="addpayment"><b>Add</b></button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    _END;

    function displayReservation($conn, $userid){
        $query = "SELECT * FROM (SELECT * FROM reserve JOIN hotel ON reserve.hotelId=hotel.id)reserve_hotel JOIN room ON reserve_hotel.RoomNum=room.roomNum WHERE customerid=$userid;";

        $result = $conn->query($query);
        if($result){
            $rows = $result->num_rows;
            if($rows < 1){
                echo "<center><b>No Reservations</b></center><br>";
            }
            for ($j = $rows - 1; $j >= 0; $j--) 
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);

                echo <<<_END
                    <h5><b>Hotel:</b> $row[8]</h5>
                    <h5><b>Address:</b> $row[9]</h5>
                    <h5><b>Room Number:</b> $row[11]</h5>
                    <h5><b>Room Type:</b> $row[12]</h5>
                    <h5><b>From:</b> $row[3]</h5>
                    <h5><b>To:</b> $row[4]</h5>
                    <h5><b>Price:</b> $row[14]</h5>
                    <center><form method="post">
                    <input type="hidden" name="delete" value="yes">
                    <input type="hidden" name="hotelId" value="$row[0]">
                    <input type="hidden" name="roomNum" value="$row[1]">
                    <input type="hidden" name="profile-submit">
                    <input name="cancel" class="btn btn-danger btn-lg eff" type="submit" value="CANCEL"></form></center>
                    <hr>
                _END;
            }
        }
        else{
            echo "No Reservation";
        }
    }

    function displayCards($conn, $userid){
        try{
            $card = getCard($conn, $userid);

            $number = cipher($card[1], $card[0], 'd');
            $cvv = cipher($card[2], $card[0], 'd');
            $number = substr($number, 12);

            echo <<<_END
                <style>
                .card2 {
                    margin: 30px;
                    margin-top:340px;
                    padding: 12px;
                    background-color:white;
                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                    transition: 0.3s;
                    border-radius: 10px; /* 5px rounded corners */
                }
                </style>
                <h4><b>$card[0]</b></h4>
                <h5><b>Card Number:</b> ************$number</h5>
                <h5><b>CVV:</b> $cvv</h5>
                <h5><i>Expires: $card[3]</i></h5>
                <center><form action="index.php" method="post">
                <input type="hidden" name="delete" value="yes">
                <input type="hidden" name="cardNum" value="$card[1]">
                <input type="hidden" name="profile-submit"><br>
                <input name="del" class="btn btn-danger btn-lg eff" type="submit" value="DELETE"></form></center>
            </div>
            _END;
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
?>