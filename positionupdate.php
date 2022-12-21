<?php
$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$pindex  = "";
$pposition  = "";
$pstatus  = "";
$pcount  = "";
$pvote  = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET method: Show the data of the position

    if ( !isset($_GET["id"])) {
        header("location: /votingsystem/positionindex.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected position from database table
    $sql = "SELECT * FROM position WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /votingsystem/positionindex.php");
        exit;
    }

    $pindex  = $row["positionindex"];
    $pposition  = $row["position"];
    $pstatus  = $row["status"];
    $pcount  = $row["votecount"];
    $pvote  = $row["validvote"];
}
else{
    //POST method: Update the data of the position

    $id  = $_POST["id"];
    $pindex  = $_POST["positionindex"];
    $pposition = $_POST["position"];
    $pstatus = $_POST["status"];
    $pcount  = $_POST["votecount"];
    $pvote  = $_POST["validvote"];

    do {
        if ( empty($pindex) || empty($pposition) || empty($pstatus) || empty($pcount) || empty($pvote)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE position " .
                "SET positionindex = '$pindex', position = '$pposition', status = '$pstatus', votecount = '$pcount', validvote = '$pvote' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if ( !$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Position updated correctly";

        header("location: /votingdatabase/positionindex.php");
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
    <title>Position</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Position</h2>

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
                <label class="col-sm-3 col-form-label">Position Index</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="positionindex" value="<?php echo $pindex; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="position" value="<?php echo $pposition; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status" value="<?php echo $pstatus; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vote Count</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="votecount" value="<?php echo $pcount; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Valid Vote</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="validvote" value="<?php echo $pvote; ?>">
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