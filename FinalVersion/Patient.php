<?php
    include "DBConn.php";
    if($_COOKIE["role"] == "Patient"){
        //if(isset($_POST['route'])) {
            switch ($_POST['route']) {
                case "updInfo":
                    $stmt = mysqli_prepare($conn, "UPDATE Patient SET PhoneNumber = ?, Address = ? WHERE Username = ?");
                    mysqli_stmt_bind_param($stmt, 'dss', $_POST['phone'], $_POST['addr'], $_COOKIE["username"]);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_error($stmt)){
                        include "Render.php";
                        renderPatientPage(array("updInfoResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        include "Render.php";
                        renderPatientPage(array("updInfoResult" => "<p style='color: green'>Success</p>")); 
                    }
                    break;
                case "loadVac":
                    $allVac = mysqli_query($conn, "SELECT * FROM VaccineDelivery");
                    if(mysqli_error($conn)){
                        include "Render.php";
                        renderPatientPage(array("scheduleResult" => "<p style='color: red'>Failed</p>"));
                    } else {
                        if(mysqli_num_rows($allVac) > 0) {
                            $options = "";
                            while ($row = mysqli_fetch_array($allVac)){
                                if ($row[1] != 0){
                                    $name = $row[0];
                                    $total = mysqli_query($conn, "SELECT COUNT(*) FROM VaccinationScheduling WHERE Vaccine = '$name'");
                                    $item = mysqli_fetch_array($total);
                                    if(($row[1] - $item[0]) > 0) {
                                        $options = $options . "<option value=$name>$name</option>";
                                    }
                                    
                                }
                            }
                            if ($options == "") {
                                include "Render.php";
                                renderPatientPage(array("scheduleResult" => "<p style='color: red'>No Vaccine Available At This Time</p>"));
                            } else {
                                $options = "<label for='vaccine'>Vaccines: </label><select id='vaccine' name='vaccine' required>" . $options . "</select><br><label for='scheduledDate'>Time: </label><input type='datetime-local' id='scheduledDate' name='scheduledDate' step='3600' required><br><input type='submit' value='Schedule'>";                    
                                include "Render.php";
                                renderPatientPage(array("scheduleForm" => $options)); 
                            }
                        } else {
                            include "Render.php";
                            renderPatientPage(array("scheduleResult" => "<p style='color: red'>No Vaccine Available At This Time</p>"));
                        }
                    }
                    break;
                case "schedule":
                    $date = $_POST['scheduledDate'];
                    $checkNurse = mysqli_query($conn, "SELECT COUNT(*) FROM NurseScheduling WHERE Date = '$date'");
                    $checkPatient = mysqli_query($conn, "SELECT COUNT(*) FROM VaccinationScheduling WHERE Date = '$date'");
                    $numN = mysqli_fetch_array($checkNurse)[0];
                    $numP = mysqli_fetch_array($checkPatient)[0];
                    if (($numN * 2) > $numP) { //assume 1 nurse can serve 2 patients in a hour
                        $username = $_COOKIE['username'];
                        $patient = mysqli_query($conn, "SELECT Name FROM Patient WHERE Username = '$username'");
                        $pName = mysqli_fetch_array($patient)[0];
                        $checkPeriod = mysqli_query($conn, "SELECT COUNT(*) FROM VaccinationScheduling WHERE Name = '$pName'");
                        $period = mysqli_fetch_array($checkPeriod)[0] + 1;
                        $stmt = mysqli_prepare($conn, "INSERT INTO VaccinationScheduling (Name, Date, Vaccine, Period) VALUES (?,?,?,?)");
                        mysqli_stmt_bind_param($stmt, 'ssss', $pName, $date, $_POST['vaccine'], $period);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_error($stmt)){
                            include "Render.php";
                            renderPatientPage(array("scheduleResult" => "<p style='color: red'>You have already scheduled that time slot</p>"));
                        } else {
                            include "Render.php";
                            renderPatientPage(array("scheduleResult" => "<p style='color: green'>Success</p>")); 
                        }
                    } else {
                        include "Render.php";
                        renderPatientPage(array("scheduleResult" => "<p style='color: red'>This Time Slot is Full</p>"));
                    }
                    break;
                case "checkTimeTable":
                    $username = $_COOKIE['username'];
                    $patient = mysqli_query($conn, "SELECT Name FROM Patient WHERE Username = '$username'");
                    $pName = mysqli_fetch_array($patient)[0];
                    $checkSchedule = mysqli_query($conn, "SELECT Date, Vaccine, Period FROM VaccinationScheduling WHERE Name = '$pName'");
                    if (mysqli_num_rows($checkSchedule) > 0) {
                        $table = "";
                        while ($row = mysqli_fetch_array($checkSchedule)){
                            $date = $row[0];
                            $vName = $row[1];
                            $period = $row[2];
                            $table = $table . "<tr><td>$date</td><td>$vName</td><td>$period</td><td><input type='radio' name='date' value='$date'></td></tr>";
                        }
                        $table = "<table style='margin: 0 auto'><tr><th>Time</th><th>Vaccine</th><th>Period</th><th>Select</th></tr>" . $table . "</table><br><input type='submit' value='Cancel Selected'>";
                        include "Render.php";
                        renderPatientPage(array("scheduleTable" => $table));
                    } else {
                        include "Render.php";
                        renderPatientPage(array("scheduleTable" => "<p style='color: red'>You do not have any schedule</p>"));
                    }
                    
                    break;
                case "cancelSchedule":
                    $username = $_COOKIE['username'];
                    $date = $_POST['date'];
                    $patient = mysqli_query($conn, "SELECT Name FROM Patient WHERE Username = '$username'");
                    $pName = mysqli_fetch_array($patient)[0];
                    $delSchedule = mysqli_query($conn, "DELETE FROM VaccinationScheduling WHERE Name = '$pName' AND Date = '$date'");
                    include "Render.php";
                    renderPatientPage(array("scheduleTable" => "<p style='color: green'>Success</p>"));
                    break;
                case "viewInfo":
                    $username = $_COOKIE['username'];
                    $patient = mysqli_query($conn, "SELECT Name, SSN, Age, Gender, Race, Occupation, MedicalHistory, PhoneNumber, Address FROM Patient WHERE Username = '$username'");
                    $row = mysqli_fetch_array($patient);
                    include "Render.php";
                    renderPatientPage(array("patientInfoTable" => "<tr><th>Name</th><th>SSN</th><th>Age</th><th>Gender</th><th>Race</th><th>OccupationClass</th><th>MedicalHistory</th><th>Phone#</th><th>Address</th></tr><tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td></tr>"));
                    break;
                case "back":
                    $patPage = str_replace("%%%Table%%%", $table, file_get_contents("Patient.html"));
                    echo $patPage;
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