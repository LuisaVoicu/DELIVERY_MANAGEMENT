

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerinta 4 A</title>
    <link rel= "stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>


<body style="background-color: gray;">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>



<nav class="navbar navbar-expand-lg bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                        Delivery
                            </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/firstPage/index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tabele
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href ="/furnizori/indexFurnizori.php">Furnizori</a></li>
                        <li><a class="dropdown-item" href ="/componente/indexComponente.php">Componente</a></li>
                        <li><a class="dropdown-item"  href ="/proiecte/indexProiecte.php" >Proiecte</a></li>
                        <li><a class="dropdown-item" href ="/livrari/indexLivrari.php" >Livrari</a></li>
                    
                    </ul>
                    </li>
                
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cerinte
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href ="/cerinte/c3a.php">Cerinta 3 a</a></li>
                        <li><a class="dropdown-item" href ="/cerinte/c3b.php">Cerinta 3 b</a></li>
                        <li><a class="dropdown-item"  href ="/cerinte/c4a.php">Cerinta 4 a</a></li>
                        <li><a class="dropdown-item" href ="/cerinte/c4b.php">Cerinta 4 b</a></li>
                        <li><a class="dropdown-item" href ="/cerinte/c5a.php">Cerinta 5 a</a></li>
                        <li><a class="dropdown-item" href ="/cerinte/c5b.php">Cerinta 5 b</a></li>
                        <li><a class="dropdown-item"  href ="/cerinte/c6a.php">Cerinta 6 a</a></li>
                        <li><a class="dropdown-item" href ="/cerinte/c6b.php">Cerinta 6 b</a></li>
                    
                    </ul>
                    </li>

                </ul>
                
                </div>
            </div>
        </nav>
        <div class="container p-5 my-5 bg-light text-white"> 
        <h1 style = "color: black">Cerinta 4 a</h1>
    
        
        <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
            Enunt
        </button>
        </p>
            <div class="collapse collapse-horizontal" id="collapseWidthExample"  style="min-height: 120px; color: black;">
                <div class="card card-body" style="width: 300px;">
                11.04. Să se exprime în SQL următoarele interogări folosind operatorul JOIN:
                a) Să se găsească numele furnizorilor, numele proiectelor, numele componentelor și orașul astfel încât toate se află în același oraș și există livrare.
                </div>
            </div>


        <table class="table">
            <thread>
                <tr>
                    <th>NumeF</th>
                    <th>NumeP</th>
                    <th>NumeC</th>
                    <th>Oras</th> 
                </tr>    
            </thred>      
                <tbody>
                    <?php

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "bd";

                    // creare conexiune cu baza de date
                    $connection = new mysqli($servername, $username, $password, $database);
                    
                    // verificare realizare conexiune
                    if($connection->connect_error)
                        die("Connection failed: " . $connection->connect_error);
                    

                    // citim toate randurile din baza de date

                    $sql = "CALL Cerinta4a ";
                    $result = $connection->query($sql);

                    // verificare realizare query
                    if(!$result)
                        die("invalid query: ". $connection->error);
                    

                    // afisam rezultatele
                    while($row = $result->fetch_assoc())
                    {
                        echo 
                        "<tr> <td> " 
                        . $row["Nume Furnizori"] . 
                        "</td> <td> "
                        . $row["Nume Proiecte"] .
                        "</td> <td>"
                        . $row["Nume Componente"] . 
                        "</td> <td>"
                        . $row["Oras"] .
                        "</td> </tr>";
                    }
                    ?>

                </tbody>
        
        </table>
    </div>
</body>
</html>