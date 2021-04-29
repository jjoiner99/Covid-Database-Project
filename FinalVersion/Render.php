<?php
    function renderAdminPage($options = array()) {
        $adminPage = file_get_contents("Admin.html");
        $adminPage = str_replace("%%%NURSEREGRESULT%%%", isset($options["nurseRegResult"]) ? $options["nurseRegResult"] : "", $adminPage);
        $adminPage = str_replace("%%%NURSEUPDRESULT%%%", isset($options["nurseUpdResult"]) ? $options["nurseUpdResult"] : "", $adminPage);
        $adminPage = str_replace("%%%NURSEDELRESULT%%%", isset($options["nurseDelResult"]) ? $options["nurseDelResult"] : "", $adminPage);
        $adminPage = str_replace("%%%NURSEINFOTABLE%%%", isset($options["nurseInfoTable"]) ? $options["nurseInfoTable"] : "", $adminPage);
        $adminPage = str_replace("%%%NURSEINFORESULT%%%", isset($options["nurseInfoResult"]) ? $options["nurseInfoResult"] : "", $adminPage);
        $adminPage = str_replace("%%%PATINFOTABLE%%%", isset($options["patInfoTable"]) ? $options["patInfoTable"] : "", $adminPage);
        $adminPage = str_replace("%%%PATINFORESULT%%%", isset($options["patInfoResult"]) ? $options["patInfoResult"] : "", $adminPage);
        $adminPage = str_replace("%%%ADDVACCINERESULT%%%", isset($options["addVaccineResult"]) ? $options["addVaccineResult"] : "", $adminPage);
        $adminPage = str_replace("%%%UPDVACCINERESULT%%%", isset($options["updVaccineResult"]) ? $options["updVaccineResult"] : "", $adminPage);
        $adminPage = str_replace("%%%SCHEDULETIMETABLE%%%", isset($options["nurseScheduleTimeResult"]) ? $options["nurseScheduleTimeResult"] : "", $adminPage);
        echo $adminPage;
    }
    function renderPatientPage($options = array()) {
        $patientPage = file_get_contents("Patient.html");
        $patientPage = str_replace("%%%UPDINFORESULT%%%", isset($options["updInfoResult"]) ? $options["updInfoResult"] : "", $patientPage);
        $patientPage = str_replace("%%%SCHEDULERESULT%%%", isset($options["scheduleResult"]) ? $options["scheduleResult"] : "", $patientPage);
        $patientPage = str_replace("%%%SCHEDULEFORM%%%", isset($options["scheduleForm"]) ? $options["scheduleForm"] : "", $patientPage);
        $patientPage = str_replace("%%%SCHEDULETABLE%%%", isset($options["scheduleTable"]) ? $options["scheduleTable"] : "", $patientPage);
        $patientPage = str_replace("%%%PATIENTINFOTABLE%%%", isset($options["patientInfoTable"]) ? $options["patientInfoTable"] : "", $patientPage);
        echo $patientPage;
    }
    function renderNursePage($options = array()) {
        $nursePage = file_get_contents("Nurse.html");
        $nursePage = str_replace("%%%UPDINFORESULT%%%", isset($options["updInfoResult"]) ? $options["updInfoResult"] : "", $nursePage);
        $nursePage = str_replace("%%%VIEWINFOTABLE%%%", isset($options["viewInfoTable"]) ? $options["viewInfoTable"] : "", $nursePage);
        $nursePage = str_replace("%%%VIEWINFORESULT%%%", isset($options["viewInfoResult"]) ? $options["viewInfoResult"] : "", $nursePage);
        $nursePage = str_replace("%%%VACRECRESULT%%%", isset($options["vacRecResult"]) ? $options["vacRecResult"] : "", $nursePage);
        $nursePage = str_replace("%%%SCHEDULETIMERESULT%%%", isset($options["scheduleTimeResult"]) ? $options["scheduleTimeResult"] : "", $nursePage);
        $nursePage = str_replace("%%%SCHEDULETIMETABLE%%%", isset($options["scheduleTimeTable"]) ? $options["scheduleTimeTable"] : "", $nursePage);
        echo $nursePage;
    }
    function renderLoginPage($options = array()) {
        $loginPage = file_get_contents("Login.html");
        $loginPage = str_replace("%%%ERROR%%%", isset($options["error"]) ? $options["error"] : "", $loginPage);
        $loginPage = str_replace("%%%REGRESULT%%%", isset($options["regResult"]) ? $options["regResult"] : "", $loginPage);
        echo $loginPage;
    }
    function renderPatientRegPage($options = array()) {
        $regPage = file_get_contents("PatRegister.html");
        $regPage = str_replace("%%%ERROR%%%", isset($options["error"]) ? $options["error"] : "",  $regPage);
        echo $regPage;
    }
?>