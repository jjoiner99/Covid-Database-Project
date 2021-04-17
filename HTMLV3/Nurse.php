<?php
    /*$servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    if($_COOKIE["role"] == "Nurse"){
        switch ($_POST['route']) {
            case "updMyInfo":
                /*$sql = "write query here";//$_POST['fName'], $_POST['MI'], $_POST['lName'], $_POST['empID'], $_POST['age'], $_POST['gender'], $_POST['phone'], $_POST['addr'], 
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $nursePage = file_get_contents("Nurse.html");
                echo $nursePage;
                break;
            case "schedule":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $nursePage = file_get_contents("Nurse.html");
                echo $nursePage;
                break;
            case "viewMyInfo":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $nursePage = file_get_contents("Nurse.html");
                echo $nursePage;
                break;
            case "recVaccine":
                /*$sql = "write query here";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $nursePage = file_get_contents("Nurse.html");
                echo $nursePage;
                break;
            case "logout":
                //unset($_COOKIE['username']); 
                //setcookie("username", "", 1);
                unset($_COOKIE['role']); 
                setcookie("role", "", 1);
                header("Location: index.php");
                exit;
            default:
                http_response_code(404);
                break;
        }
    } else {
        echo "permission denied";
    }
?>