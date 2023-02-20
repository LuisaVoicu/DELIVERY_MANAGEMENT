<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bd";

$connection = new mysqli($servername, $username, $password, $database);

$idf = "";
$idc ="";
$idp ="";
$cantitate ="";
$um ="";

$errorMessage = "";
$successMessage = "";

// get method or post medthod??
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(!isset($_GET["IDF"]))
    {
        header("location: /livrari/indexLivrari.php");
        exit;
    }

    $idf = $_GET["IDF"];
    $idc = $_GET["IDC"];
    $idp = $_GET["IDP"];


    // read the row of the selected client from databse table
    $sql = "SELECT* FROM livrari WHERE IDF = '$idf' AND  IDC = '$idc' AND IDP = '$idp'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /livrari/indexLivrari.php");
        exit;
    }

    $idf = $row["IDF"];
    $idp = $row["IDP"];
    $idc = $row["IDC"];
    $cantitate = $row["CANTITATE"];
    $um = $row["um"];
}
else
{
    // post method
 
    $idf = $_POST["IDF"];
    $idp = $_POST["IDP"];
    $idc = $_POST["IDC"];
    $cantitate = $_POST["CANTITATE"];
    $um = $_POST["um"];

    do {

        if (empty($idf) || empty($idp) || empty($idc) || empty($cantitate || empty($um))) {
            $errorMessage = "Toate campurile sunt obligatorii!";
            break;
        }

        $sql = "UPDATE livrari " .
            "SET IDF = '$idf', IDP = '$idp', IDC = '$idc', CANTITATE= '$cantitate', um = '$um' " .
            "WHERE IDF = '$idf' AND IDP = '$idp' AND IDC = '$idc'";

        $result = $connection->query($sql);
        if(!$result)
        {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Livrare adaugata corespunzator!";

        header("location: /livrari/indexLivrari.php");
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
    <title>Livrari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
    <h2>Adauga Livrari</h2>

    <?php
    if(!empty($errorMessage))
    {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }

    ?>


    <form method="post">
        <input type="hidden" name="IDF" value="<?php echo $idf; ?>">
        <input type="hidden" name="IDC" value="<?php echo $idc; ?>">
        <input type="hidden" name="IDP" value="<?php echo $idp; ?>">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Cantitate</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="CANTITATE" value="<?php echo $cantitate; ?>">
            </div> 
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">UM</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="um" value="<?php echo $um; ?>">
            </div> 
        </div>


        <?php
        if(!empty($successMessage))
        {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        
        ?>
.

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/livrari/indexLivrari.php" role="button">Cancel</a>
            </div> 
        </div>

</div>

    
</body>
</html>