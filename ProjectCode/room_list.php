<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="homepage.css">
<title> Table </title>    
    <style type = "text/css">
        #rooms {
            border-collapse: collapse;
            width: 100%;
            color: black;
            font-family: Times New Roman;
            font-size: 20px;
            text-align: center;
            margin: auto;
        }
        
        #rooms td {
            border: 1px solid #000;
            padding: 8px; 
        }

        #rooms tr:nth-child(even) {
            background-color: #ddd;
        }

        #rooms tr:hover {
            background-color: #767676
        }

        #rooms th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #bed4d4;
            border: 1px solid #000;
            font-size: 25px;
            color: black;
            border-bottom: 5px solid black;
        }
        
        .roomBtn {
            text-align: center;
        }

        .theButton {
            position: absolute;
            left: 43%;
            top: 75%;
            background-color: #e67e22;
            border: 1px solid #e67e22;
            color: #fff;
            font-weight: 300;
            text-decoration: none;
            border-radius: 200px;
            transition: background-color 0.2s, border 0.2, color 0.2s;
            font-size: 24px;
            padding: 15px 32px;
        }
        
        .slogan-text-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -25%);
            color: white;
            font-family: 'Pacifico';
            font-size: 50px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rbg(0,0,0);
            background-color: rbga(0,0,0,0.4);
            margin: auto;
        }
        
        .rmPopup_content {
            background-color: #fefefe;
            margin: auto;
            padding: 5px;
            border: 1px solid #888;
            width: 50%
        }
        
        .close {
            color: #fd0303;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close: hover,
        .close: focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
         
    </style>    
</head>

<body>
    
<?php
    require_once 'db_connection.php';
    require_once 'index.php';
?>  
    
<div class = "roomBtn">
     <button id="rmBtn" class="theButton">Available Rooms</button>
</div>    
    
<div class="slogan-text-box">
     A home away from home
</div>
    
<div id="rmPopup" class="modal">
    <div class ="rmPopup_content">
    
        <span class="close">&times;</span>
        
                <table id = "rooms">
                    <tr>
                        <th>Hotel Number</th>
                        <th>Room Number</th>    
                        <th>Type</th>
                        <th>Available</th>
                    </tr>

                <?php
                    $conn = new mysqli($hn, $un, $pw, $db); // Opens a new connection to MySQL
                    if ($conn->connect_error) die($conn->connect_error);    // Check connection to MySQL

                    $query = "SELECT * FROM Room"; // Select 'all' from 'rooms' table

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
    </div>
</div>
    
    
<script>
    // The room pop-up
    var modal = document.getElementById("rmPopup");
    // The Available Room buttotn
    var btn = document.getElementById("rmBtn");
    // The close button of the pop-up
    var span = document.getElementsByClassName("close")[0];
    // Clicking the Available Button opens it
    btn.onclick = function() {
        modal.style.display = "block";
    }
    // Clicking the X button in the pop-up closes it
    span.onclick = function() {
        modal.style.display = "none";
    }
    // Clicking outside the pop-up closes it
    window.onclick = function() {
        if(event.target == modal)
            {
                modal.style.display = "none";
            }
    }
    
</script>    
    
    
</body>
</html>


