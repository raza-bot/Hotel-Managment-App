<?php // login.php
    $hn = 'localhost';  // Host name
    $un = 'root';   // MySQL username
    $pw = 'root';   // MySQL password
    $db = 'hms';    // MySQL database name

    $conn = new mysqli($hn, $un, $pw, $db); // Opens a new connection to MySQL
    if ($conn->connect_error) die($conn->connect_error);
?>