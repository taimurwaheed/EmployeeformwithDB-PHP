<?php
    $name = $_POST['name'];
    $lastname = $_POST['lname']; 
    $fathername = $_POST['fathername'];
    $contact = $_POST['contact'];
    $cnic = $_POST['cnic'];
    $age = $_POST['age'];
    $jobtitle = $_POST['jobtitle'];
    $salary = $_POST['salary'];


    // echo 'Name:'.$name;
    // echo "email".$email;
    // echo "password".$password;
    
    define('dbHostname','localhost');
    define('dbUsername','root');
    define('dbPassword','');
    define('dbName','webform');

    $con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);
    
    // $con = new mysqli("localhost","root","","webform");

    /*
    1- Establish the connection
    2- Open up the connection
    3- make a query
    4- execute the query
    5- according to the query get the result
    6- close the connection
    majority we have four types of queries: insert, delete & search/select
    In which insert, update, delete are going to return boolean either the data saved or delete or not
    search/select is going to return the dataset
    */
    
    if($con->connect_error) 
    {
        die("Connection Error".$con->connect_error);
    }
    // $qry = "INSERT INTO Users (name, email, password) VALUES ($name, $email, $password)";
    // $qry = 'INSERT INTO employee (First Name, Last Name, Father's Name, Contact Number, CNIC, Age, Job Title, Salary) VALUES ("'.$name.'", "'.$lastname.'","'.$fathername.'","'.$contact.'","'.$cnic.'","'.$age.'","'.$jobtitle.'","'.$salary.'")';
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