<?php
$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$cid  = "";
$csid  = "";
$cindex  = "";
$cname  = "";
$cposition  = "";
$clevel  = "";
$ccount  = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET method: Show the data of the candidate

    if ( !isset($_GET["id"])) {
        header("location: /votingsystem/candidatesindex.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected candidate from database table
    $sql = "SELECT * FROM candidate WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /votingsystem/candidatesindex.php");
        exit;
    }

    $cid  = $row["candidateID"];
    $csid  = $row["studentID"];
    $cindex  = $row["positionindex"];
    $cname  = $row["candidatename"];
    $cposition  = $row["position"];
    $clevel  = $row["yearlevel"];
    $ccount  = $row["votecount"];
}
else{
    //POST method: Update the data of the candidate

    $id  = $_POST["id"];
    $cid  = $_POST["candidateID"];
    $csid  = $_POST["studentID"];
    $cindex  = $_POST["positionindex"];
    $cname  = $_POST["candidatename"];
    $cposition  = $_POST["position"];
    $clevel  = $_POST["yearlevel"];
    $ccount  = $_POST["votecount"];

    do {
        if ( empty($cid) || empty($csid) || empty($cindex) || empty($cname) || empty($cposition) || empty($clevel) || empty($ccount)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE candidate " .
                "SET candidateID = '$cid', studentID = '$csid', positionindex = '$cindex', candidatename = '$cname', position = '$cposition', yearlevel = '$clevel', votecount = '$ccount' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if ( !$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Candidate updated correctly";

        header("location: /votingsystem/candidatesindex.php");
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
    <title>Candidate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Candidates</h2>

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
                <label class="col-sm-3 col-form-label">Candidate Id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="candidateID" value="<?php echo $cid; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student Id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentID" value="<?php echo $csid; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Position Index</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="positionindex" value="<?php echo $cindex; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Candidate Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="candidatename" value="<?php echo $cname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="position" value="<?php echo $cposition; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Year Level</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="yearlevel" value="<?php echo $clevel; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vote Count</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="votecount" value="<?php echo $ccount; ?>">
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