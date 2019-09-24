<?php
    require_once 'Login.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $query = "SELECT * FROM user";

    $result = $conn->query($query);

    if (!$result) {
        echo "Something went wrong!"; 
    }
    else{

        $rows = $result->num_rows;
        for ($j = 0; $j < $rows; $j++) 
        {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_NUM);

            echo $row[0] . ", " . $row[1] . "<br><br>";
        };
    }
?>