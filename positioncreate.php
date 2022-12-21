<?php
$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$pindex  = "";
$pposition  = "";
$pstatus  = "";
$pcount  = "";
$pvote  = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $pindex  = $_POST["positionindex"];
    $pposition  = $_POST["position"];
    $pstatus  = $_POST["status"];
    $pcount  = $_POST["votecount"];
    $pvote  = $_POST["validvote"];

    do {
        if ( empty($pindex) || empty($pposition) || empty($pstatus) || empty($pcount) || empty($pvote)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //add new voting to database
        $sql = "INSERT INTO position (positionindex, position, status, votecount, validvote) ".
                "VALUES ('$pindex', '$pposition', '$pstatus', '$pcount', '$pvote')";
        $result = $connection->query($sql);

        if (!result) {
            $errorMessage = "Invalid query; " . $connection->error;
            break;
        }

        $pindex  = "";
        $pposition  = "";
        $pstatus  = "";
        $pcount  = "";
        $pvote  = "";

        $successMessage = "Position added correctly";

        header("location: /votingsystem/positionindex.php");
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
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/votingsystem/positionindex.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>