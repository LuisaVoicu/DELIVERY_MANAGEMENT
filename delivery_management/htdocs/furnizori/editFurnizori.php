<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bd";

$connection = new mysqli($servername, $username, $password, $database);

$idf = "";
$numef ="";
$stare ="";
$oras ="";

$errorMessage = "";
$successMessage = "";

// get method or post medthod??
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(!isset($_GET["IDF"]))
    {
        header("location: /furnizori/indexFurnizori.php");
        exit;
    }

    $idf = $_GET["IDF"];

    // read the row of the selected client from databse table
    $sql = "SELECT* FROM furnizori WHERE IDF = '$idf'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /furnizori/indexFurnizori.php");
        exit;
    }

    $idf = $row["IDF"];
    $numef = $row["NUMEF"];
    $stare = $row["STARE"];
    $oras = $row["ORAS"];

}
else
{
    // post method
    $idf = $_POST["IDF"];
    $numef = $_POST["NUMEF"];
    $stare = $_POST["STARE"];
    $oras = $_POST["ORAS"];

    do {

        if (empty($idf) || empty($numef) || empty($stare) || empty($oras)) {
            $errorMessage = "Toate campurile sunt obligatorii!";
            break;
        }

        $sql = "UPDATE furnizori " .
            "SET IDF = '$idf', NUMEF = '$numef', STARE = '$stare', ORAS= '$oras' " .
            "WHERE IDF = '$idf'";

        $result = $connection->query($sql);
        if(!$result)
        {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Furnizor adaugat corespunzator!";

        header("location: /furnizori/indexFurnizori.php");
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
    <title>Furnizori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
    <h2>Adauga Furnizor</h2>

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

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NumeF</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="NUMEF" value="<?php echo $numef; ?>">
            </div> 
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Stare</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="STARE" value="<?php echo $stare; ?>">
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
                <a class="btn btn-outline-primary" href="/furnizori/indexFurnizori.php" role="button">Cancel</a>
            </div> 
        </div>

</div>

    
</body>
</html>