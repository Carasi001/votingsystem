<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<style>
table, th, td {
  border: 1px solid black;
}
</style>

<body>
    <div class="container my-5">
        <h2>Student</h2>
        <a class="btn btn-primary" href="/votingsystem/studentcreate.php" role="button">Create New Student Info.</a><br>
        <table class="student">
        <br>
        <a class="btn btn-danger" href="/votingsystem/positioncreate.php" role="button">Create New Position</a><br>
        <table class="position">
        <br>
        <a class="btn btn-primary" href="/votingsystem/candidatescreate.php" role="button">Create New Candidates</a><br>
        <table class="candidate">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Id</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Program</th>
                    <th>Year Level</th>
                    <th>Vote Status</th>
                    <th>Voters Key</th>
                    <th>Date And Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $servername  = "localhost";
                $username  = "root";
                $password  = "";
                $database  = "votingsystem";

                //Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //Check connection
                if ($connection->connect_error) {
                    die("Connection Failed: ".$connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM student";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: ".$connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[studentId]</td>
                    <td>$row[lastname]</td>
                    <td>$row[firstname]</td>
                    <td>$row[middlename]</td>
                    <td>$row[program]</td>
                    <td>$row[yearlevel]</td>
                    <td>$row[votestatus]</td>
                    <td>$row[voterskey]</td>
                    <td>$row[date_and_time]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/votingsystem/studentupdate.php?id=$row[id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/votingsystem/studentdelete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                ";
            }
                ?>

                
            </tbody>
        </table>
    </div>
</body>
</html>