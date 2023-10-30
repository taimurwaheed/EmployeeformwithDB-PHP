<?php
    $name = $_POST['name'];
    $lastname = $_POST['lname']; 
    $fathername = $_POST['fathername'];
    $contact = $_POST['contact'];
    $cnic = $_POST['cnic'];
    $age = $_POST['age'];
    $jobtitle = $_POST['jobtitle'];
    $salary = $_POST['salary'];

    define('dbHostname','localhost');
    define('dbUsername','root');
    define('dbPassword','');
    define('dbName','webform');

    $con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);   
    
    if($con->connect_error) 
    {
        die("Connection Error".$con->connect_error);
    }
    $qry = 'INSERT INTO employee (FirstName, LastName, FatherName, ContactNumber, CNIC, Age, JobTitle, Salary) VALUES ("'.$name.'", "'.$lastname.'","'.$fathername.'","'.$contact.'","'.$cnic.'","'.$age.'","'.$jobtitle.'","'.$salary.'")';

    $result = $con->query($qry);
    if($result){
        echo "Data has been saved successfully.";
    }
    else {
        echo "Data didn't save";
    }
    $con->close();
?>