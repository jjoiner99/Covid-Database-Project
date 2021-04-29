<?php
    include "DBConn.php";
    switch ($_POST['route']) {
        case "register":
            include "Render.php";
            renderPatientRegPage();
            break;
        case "back":
            header("Location: index.php");
            exit;
        case "submit":
            $stmt = mysqli_prepare($conn, "INSERT INTO Patient (Username, PWD, Name, SSN, Age, Gender, Race, Occupation, MedicalHistory, PhoneNumber, Address) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, 'sssssssssss', $_POST['uName'], $_POST['pWord'], $_POST['Name'], $_POST['SSN'], $_POST['Age'], $_POST['gender'], $_POST['race'], $_POST['Occupation'], $_POST['medHist'], $_POST['phone'], $_POST['addr']);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_error($stmt)){
                include "Render.php";
                renderPatientRegPage(array("error" => "<p style='color: red'>Username Already Exist or Empty Input Field</p>"));
            } else {
                include "Render.php";
                renderLoginPage(array("regResult" => "<p style='color: green'>Registration success, login with your username and password.</p>"));
            }
            break;
        default:
            http_response_code(404);
            break;
    }
?>