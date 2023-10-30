<?php
ob_start();

$Id = $_GET['Id'];

if (!isset($Id)) {
    header("location: ./select.php");
    exit();
}

define('dbHostname', 'localhost');
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'webform');

$con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

if ($con->connect_error) {
    die("Connect Error " . $con->connect_error);
}

$qry = "SELECT * FROM employee WHERE Id='" . $Id . "'";

$result = $con->query($qry);
$row = $result->fetch_assoc();

if (!isset($row)) {
    header("location: ./select.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update operation (similar to your existing update code)
        $name = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $fathername = $_POST['FatherName'];
        $contact = $_POST['ContactNumber'];
        $cnic = $_POST['CNIC'];
        $age = $_POST['Age'];
        $jobtitle = $_POST['JobTitle'];
        $salary = $_POST['Salary'];

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
            header("Location:./select.php");
            exit();
        } else {
            echo "Data update failed";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete operation
        $qry = "DELETE FROM employee WHERE Id='" . $Id . "'";
        $result = $con->query($qry);

        if ($result) {
            // Reset the auto-increment counter
            $resetAutoIncrementQry = "ALTER TABLE employee AUTO_INCREMENT = 1";
            $con->query($resetAutoIncrementQry);

            header("Location:./select.php");
            exit();
        } else {
            echo "Data deletion failed";
        }
    }
}
$con->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="./update.php" method="post">
    <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : '' ?>">
    <br>

    <label for="FirstName">First name</label>
    <input type="text" id="FirstName" name="FirstName" value="<?php echo isset($row['FirstName']) ? $row['FirstName'] : '' ?>">
    <br>

    <label for="LastName">Last Name</label>
    <input type="text" id="LastName" name="LastName" value="<?php echo isset($row['LastName']) ? $row['LastName'] : '' ?>">
    <br>

    <label for="FatherName">Father Name</label>
    <input type="text" id="FatherName" name="FatherName" value="<?php echo isset($row['FatherName']) ? $row['FatherName'] : '' ?>">
    <br>

    <label for="ContactNumber">Contact Number</label>
    <input type="number" id="ContactNumber" name="ContactNumber" value="<?php echo isset($row['ContactNumber']) ? $row['ContactNumber'] : '' ?>">
    <br>

    <label for="CNIC">CNIC</label>
    <input type="number" id="CNIC" name="CNIC" value="<?php echo isset($row['CNIC']) ? $row['CNIC'] : '' ?>">
    <br>

    <label for="Age">Age</label>
    <input type="text" id="Age" name="Age" value="<?php echo isset($row['Age']) ? $row['Age'] : '' ?>">
    <br>

    <label for="JobTitle">Job Title</label>
    <input type="text" id="JobTitle" name="JobTitle" value="<?php echo isset($row['JobTitle']) ? $row['JobTitle'] : '' ?>">
    <br>

    <label for="Salary">Salary</label>
    <input type="number" id="Salary" name="Salary" value="<?php echo isset($row['Salary']) ? $row['Salary'] : '' ?>">
    <br>

    <input type="submit" name="update" id="update" value="Update">
    <br>
</form>
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
        <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : '' ?>">
        <button type="submit" name="delete">Delete</button>
    </form>
</body>
</html>