SELECT INSERT INTO vaccination_record (PFname,PLname,NFname,NLname,day,date,time,VACCINENAME,dose) values ($_POST['PFname'], $_POST['PLname'],$_POST['NFname'], $_POST['NLname'],$_POST['day'], $_POST['date'],$_POST['time'], $_POST['VACCINENAME'],$_POST['dose']);
