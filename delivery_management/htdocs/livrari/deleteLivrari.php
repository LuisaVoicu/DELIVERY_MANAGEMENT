<?php

// does it contains the id?
if(isset($_GET["IDF"]) && Isset($_GET["IDP"]) && isset($_GET["IDC"]))
{
    // read the id

    $IDF = $_GET["IDF"];
    $IDC = $_GET["IDC"];
    $IDP = $_GET["IDP"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM livrari WHERE IDF = '$IDF' and IDP = '$IDP' and IDC = '$IDC'";
    $result = $connection->query($sql);

    
    if(!$result)
    {

        $errorMessage = "Invalid query: " . $connection->error;
       
    }
  }
header("location: /livrari/indexLivrari.php");
exit;

?>
