<?php
    require_once 'db_connection.php';
    require_once 'index.php';

    echo <<<_END
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="hotel_list.css">
        <style>
        .card {
            opacity: 80%;
            margin: 20px;
            padding: 15px;
            background-color:white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 15px; /* 5px rounded corners */
        }
        
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .eff {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
          }
        .eff:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        </style>
    </head>
    <body>
    _END;

    $conn = new mysqli($hn, $un, $pw, $db); // Opens a new connection to MySQL
    if ($conn->connect_error) die($conn->connect_error);    // Check connection to MySQL

    $query = "SELECT * FROM Hotel"; // Select 'all' from 'hotel' table

    $result = $conn->query($query);

    if (!$result) {
        echo "Something went wrong!";  // Statement so we know something didn't go as planned
    }
    else{

        $from = date('Y-m-d');
        $to = date('Y-m-d', strtotime("+5 Days"));

        $rows = $result->num_rows;
        for ($j = 0; $j < $rows; $j++)  // Go through each row
        {
            $result->data_seek($j);     // Get data from row
            $row = $result->fetch_array(MYSQLI_NUM);    // Put row data into array

            echo <<<_END
            <div class="row card">
                <div class="col" >
                    <h4 style="text-decoration: underline;color:black;"><b>$row[1]</b></h4>
                    <a href="http://maps.google.com/maps?q=<?=$row[2]?>"><h5>Address: <b>$row[2]</b></h5></a>
                </div>
                <form action="index.php" method="post" class="span" >
                <input type="hidden" name='searchtext' value='$row[1]'>
                <input type="hidden" name='from' value='$from'>
                <input type="hidden" name='to' value='$to'>
                    <button type="submit" class="btn btn-info eff"><b>View Rooms</b></button>
                </form>
            </div>
            _END;
        };
    }

    echo "</body></html>"
?>


