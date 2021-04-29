<?php
    include "DBConn.php";
    if($_COOKIE["role"] == "Nurse"){
        //if(isset($_POST['route'])) {
            switch ($_POST['route']) {
                case "updInfo":
                    $stmt = mysqli_prepare($conn, "UPDATE Nurse SET PhoneNumber = ?, Address = ? WHERE Username = ?");
                    mysqli_stmt_bind_param($stmt, 'dss', $_POST['phone'], $_POST['addr'], $_COOKIE["username"]);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_error($stmt)){
                        include "Render.php";
                        renderNursePage(array("updInfoResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        include "Render.php";
                        renderNursePage(array("updInfoResult" => "<p style='color: green'>Success</p>")); 
                    }
                    break;

                case "schedule":
                    $username = $_COOKIE["username"];
                    $idQuery = mysqli_query($conn, "SELECT EmployeeID FROM Nurse WHERE Username = '$username'") or die('Query failed: ' . mysqli_error($conn));
                    $resultarr = mysqli_fetch_array($idQuery);
                    $id = $resultarr[0];
                    $date = $_POST["scheduledDate"];
                    $result = mysqli_query($conn, "SELECT EmployeeID FROM NurseScheduling WHERE Date = '$date'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderNursePage(array("scheduleTimeResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if(mysqli_num_rows($result) <= 11) {
                            while ($row = mysqli_fetch_array($result)){
                                if ($row[0] == $id){
                                    include "Render.php";
                                    renderNursePage(array("scheduleTimeResult" => "<p style='color: red'>You Have Already Scheduled This Time Slot</p>"));
                                }
                            }                    
                            $ins = mysqli_query($conn, "INSERT INTO NurseScheduling (Date, EmployeeID) VALUES ('$date', '$id')");
                            if(mysqli_error($conn)){
                                include "Render.php";
                                renderNursePage(array("scheduleTimeResult" => "<p style='color: red'>Failed</p>"));
                            } else {
                                include "Render.php";
                                renderNursePage(array("scheduleTimeResult" => "<p style='color: green'>Success</p>")); 
                            }
                        } else {
                            include "Render.php";
                            renderNursePage(array("scheduleTimeResult" => "<p style='color: red'>This Time Slot is Full</p>"));
                        }
                    }
                    break;
                case "showSchedule":
                    $username = $_COOKIE["username"];
                    $idQuery = mysqli_query($conn, "SELECT EmployeeID FROM Nurse WHERE Username = '$username'") or die('Query failed: ' . mysqli_error($conn));
                    $resultarr = mysqli_fetch_array($idQuery);
                    $id = $resultarr[0];
                    $result = mysqli_query($conn, "SELECT Date FROM NurseScheduling WHERE EmployeeID = '$id' ORDER BY Date") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderNursePage(array("scheduleTimeTable" => "<p style='color: red'>Failed</p>"));
                    } else {
                        $table = "<tr><th>Time Slot</th></tr>";
                        while ($row = mysqli_fetch_array($result)){
                            $table = $table . "<tr><td>$row[0]</td></tr>";
                        }    
                        include "Render.php";
                        renderNursePage(array("scheduleTimeResult" => $table));
                    }
                    break;
                case "viewInfo":
                    $username = $_COOKIE["username"];
                    $result = mysqli_query($conn, "SELECT Name, EmployeeID, Age, Gender, PhoneNumber, Address FROM Nurse WHERE Username = '$username'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderNursePage(array("viewInfoResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if(mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            include "Render.php";
                            renderNursePage(array("viewInfoTable" => "<tr><th>Name</th><th>Employee ID</th><th>Age</th><th>Gender</th><th>Phone#</th><th>Address</th></tr><tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>")); 
                        } else {
                            include "Render.php";
                            renderNursePage(array("viewInfoResult" => "<p style='color: red'>Employee ID Doesn't Exist</p>"));
                        }
                    }
                    break;
                case "recVaccine":
                    $username = $_COOKIE["username"];
                    $result = mysqli_query($conn, "SELECT Name FROM Nurse WHERE Username = '$username'") or die('Query failed: ' . mysqli_error($conn));
                    $row = mysqli_fetch_array($result);
                    $stmt = mysqli_prepare($conn, "UPDATE VaccineDelivery SET Amount = Amount - ? WHERE Name = ?");
                    mysqli_stmt_bind_param($stmt, 'ds', $_POST['doseNum'], $_POST['vName']);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_error($stmt)){
                        include "Render.php";
                        renderNursePage(array("vacRecResult" => "<p style='color: red'>Failed</p>"));
                    } elseif (mysqli_stmt_affected_rows($stmt) == 0) {
                        include "Render.php";
                        renderNursePage(array("vacRecResult" => "<p style='color: red'>Vaccine Name Doesn't Exist</p>"));
                    } else {
                        $stmt2 = mysqli_prepare($conn, "INSERT INTO VaccinationRecord (PatientName, NurseName, Date, Vaccine, Dose) VALUES (?,?,?,?,?)");
                        mysqli_stmt_bind_param($stmt2, 'ssssd', $_POST['pName'], $row[0], $_POST['Datetime'],$_POST['vName'],$_POST['doseNum']);
                        mysqli_stmt_execute($stmt2);
                        if(mysqli_stmt_error($stmt2)){
                            $dose = $_POST['doseNum'];
                            $name = $_POST['vName'];
                            $upd = mysqli_query($conn, "UPDATE VaccineDelivery SET Amount = Amount - '$dose' WHERE Name = '$name'") or die('Query failed: ' . mysqli_error($conn));
                            include "Render.php";
                            renderNursePage(array("vacRecResult" => "<p style='color: red'>Failed</p>"));
                        } else {
                            include "Render.php";
                            renderNursePage(array("vacRecResult" => "<p style='color: green'>Success</p>")); 
                        }
                    }
                    break;
                case "logout":
                    unset($_COOKIE['username']); 
                    setcookie("username", "", 1);
                    unset($_COOKIE['role']); 
                    setcookie("role", "", 1);
                    header("Location: index.php");
                    exit;
                default:
                    http_response_code(404);
                    break;
            }
        /*} else {
            unset($_COOKIE['username']); 
            setcookie("username", "", 1);
            unset($_COOKIE['role']); 
            setcookie("role", "", 1);
            header("Location: index.php");
        }*/
    } else {
        header("Location: index.php");
    }
?>