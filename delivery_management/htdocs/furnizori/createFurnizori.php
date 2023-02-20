<?php

// conectare la baza de date

$servername = "localhost";
$username = "root";
$password = "";
$database = "bd";

$connection = new mysqli($servername, $username, $password, $database);


// citire date trimise

$idf = "";
$numef = "";
$stare = "";
$oras = "";

$errorMessage = "";
$successMessage = "";

// verificam daca datele au fost transmise prin metoda POST
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $idf = $_POST["IDF"];
    $numef = $_POST["NUMEF"];
    $stare = $_POST["STARE"];
    $oras = $_POST["ORAS"];

    do {

        if (empty($numef) || empty($stare) || empty($oras) || empty($idf)) {
            $errorMessage = "Toate campurile sunt obligatorii!";
            break;
        }

        // else

        $sql = "INSERT INTO furnizori (IDF,NUMEF,STARE,ORAS) " .
        "VALUES ('$idf', '$numef', '$stare', '$oras')";
         $result = $connection->query($sql);

    if(!$result)
    {
        $errorMessage = "Invalid query: " . $connection->error;
        break;
    }

        $idf = "";
        $numef = "";
        $stare = "";
        $oras = "";
        $successMessage = "Furnizor adaugat corespunzator";

        // the statement allows us to redirect the user to the index file
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

        // afisarea erorilor
        
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">IDF</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="IDF" value="<?php echo $idf; ?>">
                </div> 
            </div>

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



