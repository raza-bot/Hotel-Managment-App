<?php
    require_once 'db_connection.php';
    require_once 'index.php';

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
            img[value='roomimg']{
                width: 300px;
                height: 200px;
                object-fit: cover;
                border-radius: 8%;
            }
        </style>   
    </head>
    <div class="slogan-text-box">
        <h1>A home away from home</h1>
    </div>
    _END;

    $query = "SELECT * FROM room JOIN hotel ON room.hotelID=hotel.id;"; // Select 'all' from 'hotel' table

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
                <div class="col-sm-7">
                    <h2><b>$row[2]</b> at $row[5]</h2>
                    <h4><b>Room Number:</b> $row[1]</h4>
                    <h4><b>Address:</b> $row[6]</h4>
                    <h3><b>Price:</b> $266</h3>
                </div>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPaymentModal">Book</button>
            </div>
            _END;
        }
    }
?>