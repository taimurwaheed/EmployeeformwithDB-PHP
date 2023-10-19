<?php
$Id = $_POST['Id'];
$name = $_POST['FirstName'];  // Make sure the names match the actual column names
$lastname = $_POST['LastName'];
$fathername = $_POST['FatherName'];
$contact = $_POST['ContactNumber'];
$cnic = $_POST['CNIC'];
$age = $_POST['Age'];
$jobtitle = $_POST['JobTitle'];
$salary = $_POST['Salary'];

define('dbHostname', 'localhost');
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'webform');

$con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

if ($con->connect_error) {
    die("Connection Error" . $con->connect_error);
}

$qry = "UPDATE employee SET
        FirstName = '$name',
        LastName = '$lastname',
        FatherName = '$fathername',
        ContactNumber = '$contact',
        CNIC = '$cnic',
        Age = '$age',
        JobTitle = '$jobtitle',
        Salary = '$salary'
        WHERE Id='$Id'";

$result = $con->query($qry);

if ($result) {
    header("Location: ./select.php");
    exit();
} else {
    echo "Data didn't update: " . $con->error;
}

$con->close();
?>
