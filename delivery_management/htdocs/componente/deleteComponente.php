<?php

// does it contains the id?
if(isset($_GET["IDC"]))
{
    // read the id

    $IDC = $_GET["IDC"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM componente WHERE IDC = '$IDC'";
    $result = $connection->query($sql);

    
    if(!$result)
    {

        $errorMessage = "Invalid query: " . $connection->error;
       
    }
  }
header("location: /componente/indexComponente.php");
exit;

?>
