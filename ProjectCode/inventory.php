<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="inventory.css">
</head>

<body>

<table id = "inventory">
    <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Quantity</th>
    <th>Modifications</th>
    </tr>   
    
    <?php
        require_once 'db_connection.php';
        
        $query = "SELECT * FROM Inventory"; // Select 'all' from 'Inventory' table
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
                
                echo "<tr><td>" . $row[0]. "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td>
                <td>  
                       
                    <input type = submit value='Add'>
                    
                    <input type = submit value='Sub'>    
        
                </td>
                </tr>";
            };
        }
    ?>
    
</table>
</body>
</html>


