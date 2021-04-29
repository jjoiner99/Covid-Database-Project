<?php
    include "DBConn.php";
    if($_COOKIE["role"] == "Administrator"){
        //if(isset($_POST['route'])) {
            switch ($_POST['route']) {
                case "regNurse":
                    $empID = $_POST['empID'];
                    $result = mysqli_query($conn, "SELECT Username FROM Nurse WHERE EmployeeID = '$empID'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_num_rows($result) == 0) {
                        $stmt = mysqli_prepare($conn, "INSERT INTO Nurse (Username, PWD, Name, EmployeeID, Age, Gender, PhoneNumber, Address) VALUES(?,?,?,?,?,?,?,?)");
                        mysqli_stmt_bind_param($stmt, 'sssddsds', $_POST['username'], $_POST['password'], $_POST['Name'], $_POST['empID'], $_POST['age'], $_POST['gender'], $_POST['phone'], $_POST['addr']);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_error($stmt)){
                            include "Render.php";
                            renderAdminPage(array("nurseRegResult" => "<p style='color: red'>Employee ID  Already Exist or Empty Input Field</p>"));
                        } else {
                            include "Render.php";
                            renderAdminPage(array("nurseRegResult" => "<p style='color: green'>Success</p>")); 
                        }
                    } else {
                        include "Render.php";
                        renderAdminPage(array("nurseRegResult" => "<p style='color: red'>Employee ID Already Exist</p>"));
                    }
                    break;
                case "updNurse":
                    $empID = $_POST['empID'];
                    $result = mysqli_query($conn, "SELECT Username FROM Nurse WHERE EmployeeID = '$empID'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_num_rows($result) == 1) {
                        $stmt = mysqli_prepare($conn, "UPDATE Nurse SET Name = ?, Age = ?, Gender = ?, PhoneNumber = ?, Address = ? WHERE EmployeeID = ?");
                        mysqli_stmt_bind_param($stmt, 'sdsdsd', $_POST['Name'], $_POST['age'], $_POST['gender'], $_POST['phone'], $_POST['addr'], $_POST['empID']);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_error($stmt)){
                            include "Render.php";
                            renderAdminPage(array("nurseUpdResult" => "<p style='color: red'>Failed</p>"));
                        } else {
                            include "Render.php";
                            renderAdminPage(array("nurseUpdResult" => "<p style='color: green'>Success</p>")); 
                        }
                    } else {
                        include "Render.php";
                        renderAdminPage(array("nurseUpdResult" => "<p style='color: red'>Employee ID Doesn't Exist</p>"));
                    }
                    break;
                case "delNurse":
                    $empID = $_POST['empID'];
                    $result = mysqli_query($conn, "SELECT Username FROM Nurse WHERE EmployeeID = '$empID'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_num_rows($result) == 1) {
                        $del = mysqli_query($conn, "DELETE FROM Nurse WHERE EmployeeID = '$empID'") or die('Query failed: ' . mysqli_error($conn));
                        if(mysqli_error($conn)){
                            include "Render.php";
                            renderAdminPage(array("nurseDelResult" => "<p style='color: red'>Failed</p>"));
                        } else {
                            include "Render.php";
                            renderAdminPage(array("nurseDelResult" => "<p style='color: green'>Success</p>")); 
                        }
                    } else {
                        include "Render.php";
                        renderAdminPage(array("nurseDelResult" => "<p style='color: red'>Employee ID Doesn't Exist</p>"));
                    }
                    break;
                case "viewNurseInfo":
                    $empID = $_POST['empID'];
                    $result = mysqli_query($conn, "SELECT Name, Age, Gender, PhoneNumber, Address FROM Nurse WHERE EmployeeID = '$empID'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderAdminPage(array("nurseInfoResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if(mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            include "Render.php";
                            renderAdminPage(array("nurseInfoTable" => "<tr><th>Name</th><th>Age</th><th>Gender</th><th>Phone#</th><th>Address</th></tr><tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>")); 
                        } else {
                            include "Render.php";
                            renderAdminPage(array("nurseInfoResult" => "<p style='color: red'>Employee ID Doesn't Exist</p>"));
                        }
                    }
                    break;
                case "viewPatientInfo":
                    $name = $_POST['Name'];
                    $result = mysqli_query($conn, "SELECT Name, SSN, Age, Gender, Race, Occupation, MedicalHistory, PhoneNumber, Address FROM Patient WHERE Name = '$name'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderAdminPage(array("patInfoResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if(mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            include "Render.php";
                            renderAdminPage(array("patInfoTable" => "<tr><th>Name</th><th>SSN</th><th>Age</th><th>Gender</th><th>Race</th><th>Occupation</th><th>Medical History</th><th>Phone#</th><th>Address</th></tr><tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td></tr>")); 
                        } else {
                            include "Render.php";
                            renderAdminPage(array("patInfoResult" => "<p style='color: red'>Patient Doesn't Exist</p>"));
                        }
                    }
                    break;
                case "addVaccine":
                    $name = $_POST['vName'];
                    $result = mysqli_query($conn, "SELECT Name FROM Vaccine WHERE Name = '$name'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_num_rows($result) == 0) {
                        $stmt = mysqli_prepare($conn, "INSERT INTO Vaccine (Name, Company, Dose, Description) VALUES(?,?,?,?)");
                        mysqli_stmt_bind_param($stmt, 'ssds', $_POST['vName'], $_POST['compName'], $_POST['dose'], $_POST['description']);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_error($stmt)){
                            include "Render.php";
                            renderAdminPage(array("addVaccineResult" => "<p style='color: red'>Failed</p>"));
                        } else {
                            $stmt2 = mysqli_prepare($conn, "INSERT INTO VaccineDelivery (Name, Amount) VALUES (?,?)");
                            mysqli_stmt_bind_param($stmt2, 'sd', $_POST['vName'], $_POST['amount']);
                            mysqli_stmt_execute($stmt2);
                            if(mysqli_stmt_error($stmt2)){
                                $del = mysqli_query($conn, "DELETE FROM Vaccine WHERE Name = '$name'") or die('Query failed: ' . mysqli_error($conn));
                                include "Render.php";
                                renderAdminPage(array("addVaccineResult" => "<p style='color: red'>Failed</p>"));
                            } else {
                                include "Render.php";
                                renderAdminPage(array("addVaccineResult" => "<p style='color: green'>Success</p>")); 
                            }
                        }
                    } else {
                        include "Render.php";
                        renderAdminPage(array("addVaccineResult" => "<p style='color: red'>Vaccine Name Already Exist</p>"));
                    }
                    break;
                case "updateVaccine":
                    $name = $_POST['vName'];
                    $result = mysqli_query($conn, "SELECT Name FROM VaccineDelivery WHERE Name = '$name'") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_num_rows($result) == 1) {
                        $amount = $_POST['amount'];
                        $update = mysqli_query($conn, "UPDATE VaccineDelivery SET Amount = Amount + $amount WHERE Name = '$name'");
                        if(mysqli_error($conn)){
                            include "Render.php";
                            renderAdminPage(array("updVaccineResult" => "<p style='color: red'>Failed</p>"));
                        } else {
                            include "Render.php";
                            renderAdminPage(array("updVaccineResult" => "<p style='color: green'>Success</p>")); 
                        }
                    } else {
                        include "Render.php";
                        renderAdminPage(array("updVaccineResult" => "<p style='color: red'>Vaccine Name Doesn't Exist</p>"));
                    }
                    break;
                case "showSchedule":
                    $id = $_POST['empID'];
                    $result = mysqli_query($conn, "SELECT Date FROM NurseScheduling WHERE EmployeeID = '$id' ORDER BY Date") or die('Query failed: ' . mysqli_error($conn));
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderAdminPage(array("scheduleTimeTable" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            $table = "<tr><th>Time Slot</th></tr>";
                            while ($row = mysqli_fetch_array($result)){
                                $table = $table . "<tr><td>$row[0]</td></tr>";
                            }    
                            include "Render.php";
                            renderAdminPage(array("nurseScheduleTimeResult" => $table));
                        } else {
                            include "Render.php";
                            renderAdminPage(array("scheduleTimeTable" => "<p style='color: red'>Nurse has not scheduled a time slot or employee id doesn't exist</p>"));
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