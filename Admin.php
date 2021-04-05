<?php
    /*$servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    if($_COOKIE["role"] == "Administrator"){
        switch ($_POST['route']) {
            case "regNurse":
                /*$sql = "write query here";//$_POST['fName'], $_POST['MI'], $_POST['lName'], $_POST['empID'], $_POST['age'], $_POST['gender'], $_POST['phone'], $_POST['addr'], 
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $adminPage = file_get_contents("Admin.html");
                echo $adminPage;
                break;
            case "updNurse":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $adminPage = file_get_contents("Admin.html");
                echo $adminPage;
                break;
            case "delNurse":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $adminPage = file_get_contents("Admin.html");
                echo $adminPage;
                break;
            case "addVaccine":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $adminPage = file_get_contents("Admin.html");
                echo $adminPage;
                break;
            default:
                http_response_code(404);
                break;
        }
    } else {
        echo "permission denied";
    }
?>