<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Records</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="./insertemployee.html">Add New Record</a>
    <table>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Father Name</th>
            <th>Contact Number</th>    
            <th>CNIC</th>    
            <th>Age</th>    
            <th>Job Title</th>    
            <th>Salary</th>    
        </tr> 

        <?php
            define('dbHostname', 'localhost');
            define('dbUsername', 'root');
            define('dbPassword', '');
            define('dbName', 'webform');

            $con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

            if ($con->connect_error) { 
                die("Connect Error " . $con->connect_error);
            }

            $qry = "SELECT * FROM employee";

            $result = $con->query($qry);

            while ($row = $result->fetch_assoc()) {
                // Check if 'Id' is set before accessing it
                $Id = isset($row['Id']) ? $row['Id'] : '';
                
                echo "<tr>
                    <td>".$Id."</td>
                    <td>".$row['FirstName']."</td>
                    <td>".$row['LastName']."</td>
                    <td>".$row['FatherName']."</td>
                    <td>".$row['ContactNumber']."</td>
                    <td>".$row['CNIC']."</td>
                    <td>".$row['Age']."</td>
                    <td>".$row['JobTitle']."</td>
                    <td>".$row['Salary']."</td>
                    <td>
                        <a href='./edit.php?Id=".$Id."'>Edit</a>
                    </td>
                </tr>";
            }
            $con->close();
        ?>
    </table>
</body>
</html>
