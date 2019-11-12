<?php
    require_once 'utilities.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

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

    echo <<<_END
    <style>
    div[title='profile'] {
        display: inline-block;
        margin: auto;
        margin-top: 75px;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0px 0px 20px 3px #808080;
        padding: 20px;
    }
    </style>
        <center>
            <h1>$first $last</h1><br>
            <h2>@$username</h2>
            <h2>Email: $email</h2>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPaymentModal">Add Payment</button>
    _END;

    echo <<<_END
        </center>
    
    <div id="addPaymentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Payment</h4>
            </div>
            <form action="index.php" method="post">
                    <div class="modal-body">
                        <p1>Name On Card: </p1>
                        <input type="text" name="name" placeholder="Ex: John Doe"><br><br>
                        <p1>Card Number: </p1>
                        <input type="number" name="cardnum" placeholder="Ex: 0000000000000000"><br><br>
                        <p1>CVV: </p1>
                        <input type="number" name="cvv" placeholder="Ex: 000"><br><br>
                        <input type="hidden" name="profile-submit">
                        <p1>Expiration Date: </p1>
                        <input type="date" name="expire">
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
?>