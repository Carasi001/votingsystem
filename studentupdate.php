<?php
$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$student  = "";
$lname  = "";
$fname  = "";
$mname  = "";
$program  = "";
$yearlevel  = "";
$status  = "";
$key  = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET method: Show the data of the student

    if ( !isset($_GET["id"])) {
        header("location: /votingsystem/studentindex.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected student from database table
    $sql = "SELECT * FROM student WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /votingsystem/studentindex.php");
        exit;
    }

    $student  = $row["studentId"];
    $lname  = $row["lastname"];
    $fname  = $row["firstname"];
    $mname  = $row["middlename"];
    $program  = $row["program"];
    $yearlevel  = $row["yearlevel"];
    $status  = $row["votestatus"];
    $key  = $row["voterskey"];
}
else{
    //POST method: Update the data of the student

    $id  = $_POST["id"];
    $student  = $_POST["studentId"];
    $lname  = $_POST["lastname"];
    $fname  = $_POST["firstname"];
    $mname  = $_POST["middlename"];
    $program  = $_POST["program"];
    $yearlevel  = $_POST["yearlevel"];
    $status  = $_POST["votestatus"];
    $key  = $_POST["voterskey"];

    do {
        if ( empty($id) ||empty($student) ||empty($lname) ||empty($fname) ||empty($mname) ||empty($program) ||empty($yearlevel) ||empty($status) ||empty($key) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE student " .
                "SET studentId = '$student', lastname = '$lname', firstname = '$fname', middlename = '$mname', program = '$program', yearlevel = '$yearlevel', votestatus = '$status', voterskey = '$key' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if ( !$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "student updated correctly";

        header("location: /votingsystem/studentindex.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Student</h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class'btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">StudentId</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentId" value="<?php echo $student; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">LastName</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">FirstName</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">MiddleName</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="middlename" value="<?php echo $mname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Program</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="program" value="<?php echo $program; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">YearLevel</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="yearlevel" value="<?php echo $yearlevel; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">VoteStatus</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="votestatus" value="<?php echo $status; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">key</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="voterskey" value="<?php echo $key; ?>">
                </div>
            </div>


            <?php
            if ( !empty($successMessage) ) {
            echo"
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class'btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>