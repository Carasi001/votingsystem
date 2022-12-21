<?php
$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

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

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $student  = $_POST["studentId"];
    $lname  = $_POST["lastname"];
    $fname  = $_POST["firstname"];
    $mname  = $_POST["middlename"];
    $program  = $_POST["program"];
    $yearlevel  = $_POST["yearlevel"];
    $status  = $_POST["votestatus"];
    $key  = $_POST["voterskey"];

    do {
        if ( empty($student) || empty($lname) || empty($fname) || empty($mname) || empty($program) || empty($yearlevel) || empty($status) || empty($key)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //add new voting to database
        $sql = "INSERT INTO student (studentId, lastname, firstname, middlename, program, yearlevel, votestatus, voterskey) ".
                "VALUES ('$student', '$lname', '$fname', '$mname', '$program', '$yearlevel', '$status', '$key')";
        $result = $connection->query($sql);

        if (!result) {
            $errorMessage = "Invalid query; " . $connection->error;
            break;
        }

        $student  = "";
        $lname  = "";
        $fname  = "";
        $mname  = "";
        $program  = "";
        $yearlevel  = "";
        $status  = "";
        $key  = "";

        $successMessage = "student added correctly";

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
    <title>Student</title>
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
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student Id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentId" value="<?php echo $student; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Name</label>
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
                <label class="col-sm-3 col-form-label">Year Level</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="yearlevel" value="<?php echo $yearlevel; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vote Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="votestatus" value="<?php echo $status; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Voters Key</label>
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
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/votingsystem/studentindex.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>