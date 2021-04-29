<?php
    $servername = "sql5.freemysqlhosting.net";
    $username = "sql5408518";
    $password = 'ZPkXQUULfG';
    $dbname = "sql5408518";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>