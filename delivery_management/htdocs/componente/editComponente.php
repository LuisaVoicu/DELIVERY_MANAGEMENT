<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bd";

$connection = new mysqli($servername, $username, $password, $database);

$idc = "";
$numec ="";
$culoare ="";
$masa = "";
$oras ="";

$errorMessage = "";
$successMessage = "";

// get method or post medthod??
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(!isset($_GET["IDC"]))
    {
        // nu gaseste id-ul in baza de date... nu am ce sa editez

        header("location: /componente/indexComponente.php");
        exit;
    }

    $idc = $_GET["IDC"];

    // read the row of the selected client from databse table
    $sql = "SELECT* FROM componente WHERE IDC = '$idc'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /componente/indexComponente.php");
        exit;
    }

    $idc = $row["IDC"];
    $numec = $row["NUMEC"];
    $culoare = $row["CULOARE"];
    $masa = $row["MASA"];
    $oras = $row["ORAS"];

}
else
{
    // post method
    $idc = $_POST["IDC"];
    $numec = $_POST["NUMEC"];
    $culoare = $_POST["CULOARE"];
    $masa = $_POST["MASA"];
    $oras = $_POST["ORAS"];


    do {

        if (empty($numec) || empty($culoare) || empty($oras) || empty($idc) || empty($masa)) {
            $errorMessage = "Toate campurile sunt obligatorii!";
            break;
        }

        $sql = "UPDATE componente " .
            "SET IDC = '$idc', NUMEC = '$numec', CULOARE = '$culoare', MASA = '$masa', ORAS= '$oras' " .
            "WHERE IDC = '$idc'";

        $result = $connection->query($sql);
        if(!$result)
        {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Componenta adaugat corespunzator!";

        header("location: /componente/indexComponente.php");
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
    <title>Componente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
    <h2>Adauga Componenta</h2>

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
        <input type="hidden" name="IDC" value="<?php echo $idc; ?>">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NumeC</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="NUMEC" value="<?php echo $numec; ?>">
            </div> 
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Culoare</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="CULOARE" value="<?php echo $culoare; ?>">
            </div> 
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Masa</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="MASA" value="<?php echo $masa; ?>">
            </div> 
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Oras</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ORAS" value="<?php echo $oras; ?>">
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

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/componente/indexComponente.php" role="button">Cancel</a>
            </div> 
        </div>

</div>

    
</body>
</html>