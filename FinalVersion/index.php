<?php
    include "DBConn.php";
    function renderPageByRole($role) {
        switch ($role) {
            case "Administrator":
                include "Render.php";
                renderAdminPage();
                break;
            case "Nurse":
                include "Render.php";
                renderNursePage();
                break;
            case "Patient":
                include 'Render.php';
                renderPatientPage();
                break;
        }
    }
    function processLoginResult($conn, $un, $pwd, $role, $table) {
        $result = mysqli_query($conn, "SELECT Username FROM $table WHERE Username = '$un' AND PWD = '$pwd'") or die('Query failed: ' . mysqli_error($conn));
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            setcookie("role", $role, time() + (86400 * 30));
            setcookie("username", $row[0], time() + (86400 * 30));
            renderPageByRole($role);
        } else {
            include "Render.php";
            renderLoginPage(array("error" => "<p style='color: red'>Username or password wrong</p>"));
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (empty($_COOKIE["role"]) || !in_array($_COOKIE["role"], ["Administrator", "Nurse", "Patient"])) {
            include "Render.php";
            renderLoginPage();
        } else {
            renderPageByRole($_COOKIE["role"]);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((!empty($_POST['user']) && !empty($_POST['pass'])) && $_POST['route'] == "login") {
            switch ($_POST['role']) {
                case "Administrator":
                    processLoginResult($conn, $_POST['user'], $_POST['pass'], $_POST['role'], "Admin");
                    break;
                case "Nurse":
                    processLoginResult($conn, $_POST['user'], $_POST['pass'], $_POST['role'], "Nurse");
                    break;
                case "Patient":
                    processLoginResult($conn, $_POST['user'], $_POST['pass'], $_POST['role'], "Patient");
                    break;
            }
        } else {
            include "Render.php";
            renderLoginPage(array("error" => "<p style='color: red'>Username or password cannot be empty</p>"));
        }
    }
    
?>
