<?php
    require_once 'db_connection.php';
    require_once 'index.php';

    $conn = new mysqli($hn, $un, $pw, $db); // Opens a new connection to MySQL
    if ($conn->connect_error) die($conn->connect_error);    // Check connection to MySQL

    $query = "SELECT * FROM Hotel"; // Select 'all' from 'hotel' table

    $result = $conn->query($query);

    if (!$result) {
        echo "Something went wrong!";   // Statement so we know something didn't go as planned
    }
    else{
        
        
        echo "Hotel Name - Hotel Address" . "<br><br>";
        
        $rows = $result->num_rows;
        for ($j = 0; $j < $rows; $j++)  // Go through each row
        {
            $result->data_seek($j);     // Get data from row
            $row = $result->fetch_array(MYSQLI_NUM);    // Put row data into array

            echo $row[0] . " - " . $row[1] . $row[2] . ", " . "<br><br>"; // Print result from 1st and 2nd column of current row
        };
    }
?>