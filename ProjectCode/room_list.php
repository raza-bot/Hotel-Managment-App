<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="homepage.css">
<title> Table </title>    
    <style type = "text/css">
        table{
            border-collapse: collapse;
            width: 40%;
            color: white;
            font-family: Times New Roman;
            font-size: 20px;
            text-align: left;   
                        
        }
        th{
            color: white;
            border-bottom: 5px solid white; 
        }
    
    </style>    
</head>

<body>
    <table>
        <tr>
            <th>Hotel Number</th>
            <th>Room Number</th>    
            <th>Type</th>
            <th>Available</th>
        </tr>
        
        <div class="slogan-text-box">
            <h1>A home away from home</h1>
        </div>
    <?php
        require_once 'db_connection.php';
        require_once 'index.php';

        $conn = new mysqli($hn, $un, $pw, $db); // Opens a new connection to MySQL
        if ($conn->connect_error) die($conn->connect_error);    // Check connection to MySQL

        $query = "SELECT * FROM Room"; // Select 'all' from 'hotel' table

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

                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
            }
            echo "</table>";
        }
    ?>
        
    </table>
</body>
</html>


