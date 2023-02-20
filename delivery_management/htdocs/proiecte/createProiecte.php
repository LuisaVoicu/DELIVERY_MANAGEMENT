<?php

// conectare la baza de date

$servername = "localhost";
$username = "root";
$password = "";
$database = "bd";

$connection = new mysqli($servername, $username, $password, $database);


// citire date trimise

$idp = "";
$numep = "";
$oras = "";

$errorMessage = "";
$successMessage = "";

// verificam daca datele au fost transmise prin metoda POST
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $idp = $_POST["IDP"];
    $numep = $_POST["NUMEP"];
    $oras = $_POST["ORAS"];

    do {

        if (empty($numep) || empty($oras) || empty($idp)) {
            $errorMessage = "Toate campurile sunt obligatorii!";
            break;
        }

        // else

        $sql = "INSERT INTO proiecte (IDP,NUMEP,ORAS) " .
        "VALUES ('$idp', '$numep', '$oras')";
         $result = $connection->query($sql);

    if(!$result)
    {
        $errorMessage = "Invalid query: " . $connection->error;
        break;
    }

        $idp = "";
        $numep = "";
        $oras = "";
        $successMessage = "Furnizor adaugat corespunzator";

        // the statement allows us to redirect the user to the index file
        header("location: /proiecte/indexProiecte.php");
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
    <title>Proiecte</title>
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
                <label class="col-sm-3 col-form-label">IDP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="IDP" value="<?php echo $idp; ?>">
                </div> 
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NumeP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NUMEP" value="<?php echo $numep; ?>">
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
                    <a class="btn btn-outline-primary" href="/proiecte/indexProiecte.php" role="button">Cancel</a>
            </div> 
        </div>

    </div>
   
</body>
</html>



