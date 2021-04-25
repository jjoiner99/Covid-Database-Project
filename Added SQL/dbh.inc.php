<?php
$dbServername = "localhost:8889";
$dbUserName = "root";
$dbPassword = "root";
$dbName = "cs480dspc";
$dbPort = "8888";
 // Step 1: connect to DB
    $conn = new mysqli($dbServername,$dbUserName,$dbPassword,$dbName);
    if($conn->connect_error) 
    {
        echo "Error: could not connect to the DB";
        echo $conn->connect_error;
        exit;
    }
echo "you are connected";

?>