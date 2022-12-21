<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Position</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<style>
table, th, td {
  border: 1px solid black;
}
</style>

<body>
    <div class="container my-5">
        <h2>Position</h2>
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
                    <th>Position Index</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Vote Count</th>
                    <th>Valid Vote</th>
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
                $sql = "SELECT * FROM position";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: ".$connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[positionindex]</td>
                    <td>$row[position]</td>
                    <td>$row[status]</td>
                    <td>$row[votecount]</td>
                    <td>$row[validvote]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/votingsystem/positionupdate.php?id=$row[id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/votingsystem/positiondelete.php?id=$row[id]'>Delete</a>
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