<?php
    /*$servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    
    if($_COOKIE["role"] == "Patient"){
        switch ($_POST['route']) {
            case "updInfo":
                /*$sql = "write query here";
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $patPage = str_replace("%%%Table%%%", "", file_get_contents("Patient.html"));
                echo $patPage;
                break;
            case "updTimeTable":
                /*$sql = "write query here";
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                $appointmentId = "456";
                $appointmentId2 = "asdasdads::d3";
                $table = "<tr><td>2021/4/17</td><td>17:00:00</td><td><input type='radio' name='appointmentId' value=" . "'" . $appointmentId . "'" . "></td></tr><tr><td>2021/4/16</td><td>13:00:00</td><td><input type='radio' name='appointmentId' value=" . "'" . $appointmentId2 . "'" . "></td></tr>";//for demo
                $patPage = str_replace("%%%Table%%%", $table, file_get_contents("Patient.html"));
                echo $patPage;
                break;
            case "cancelSchedual":
                /*$sql = "write query here";
                    echo "<script>alert('Success')</script>";
                } else {
                    echo "<script>alert('Error creating database: ' + $conn->error)</script>";
                }*/
                echo $_POST["appointmentId"];
                //$patPage = str_replace("%%%Table%%%", "", file_get_contents("Patient.html"));
                //echo $patPage;
                break;
            case "viewInfo":
                $patInfoPage = str_replace("%%%Table%%%", $table, file_get_contents("PatviewInfo.html"));
                echo $patInfoPage;
                break;
            case "back":
                $patPage = str_replace("%%%Table%%%", $table, file_get_contents("Patient.html"));
                echo $patPage;
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