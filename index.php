<?php
    /*$servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
    function renderPage($role) {
        switch ($role) {
            case "Administrator":
                $adminPage = file_get_contents("Admin.html");
                echo $adminPage;
                break;
            case "Nurse":
                $nursePage = file_get_contents("Nurse.html");
                echo $nursePage;
                break;
            case "Patient":
                break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (empty($_COOKIE["role"]) || !in_array($_COOKIE["role"], ["Administrator", "Nurse", "Patient"])) {
            $loginPage = str_replace("%%%ERROR%%%", "", file_get_contents("Login.html"));
            echo $loginPage;
        } else {
            renderPage($_COOKIE["role"]);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((!empty($_POST['user']) && !empty($_POST['pass'])) && $_POST['route'] == "login") {
            $sql = "write query here";//username = $_POST['user'], password = $_POST['pass'], table = $_POST['role']
            $matchedUser = "";//$matchedUser = $conn->query($sql);
            //if (mysql_num_rows($matchedUser) == 0) {
            if ($matchedUser != "") { //replace this line with the line above
                $loginPage = str_replace("%%%ERROR%%%", "<p style='color: red'>Username or password wrong</p>", file_get_contents("Login.html"));
                echo $loginPage;
            } else {
                setcookie("role", $_POST['role'], time() + (86400 * 30));
                renderPage($_POST['role']);
            }
        } else {
            $loginPage = str_replace("%%%ERROR%%%", "<p style='color: red'>Username or password cannot be empty</p>", file_get_contents("Login.html"));
            echo $loginPage;
        }
    }
    
?>
