<?php
    /*$servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    switch ($_POST['route']) {
        case "register":
            $patRegPage = file_get_contents("PatRegister.html");
            echo $patRegPage;
            break;
        case "back":
            header("Location: index.php");
            exit;
        case "submit":
            /*$sql = "write query here"; //select query to check
            $result = $conn->query($sql);
            if ($result === TRUE) {
                if($result->num_rows > 0) { //exist
                    echo "<script>alert('Username Exist')</script>";
                } else {
                    $sqlInsert = "write query here"; //insert query to update
                    if ($conn->query($sqlInsert); === TRUE) {
                        echo "<script>alert('Success')</script>";
                    } else {
                        echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                    }
                }
            } else {
                echo "<script>alert('Error creating database: ' + $conn->error)</script>";
            }*/
            break;
        default:
            http_response_code(404);
            break;
    }
?>