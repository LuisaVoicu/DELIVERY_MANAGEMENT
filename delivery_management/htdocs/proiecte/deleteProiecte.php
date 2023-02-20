<?php

// does it contains the id?
if(isset($_GET["IDP"]))
{
    // read the id

    $IDP = $_GET["IDP"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM proiecte WHERE IDP = '$IDP'";
    $result = $connection->query($sql);

    
    if(!$result)
    {

        $errorMessage = "Invalid query: " . $connection->error;
       
    }
  }
header("location: /proiecte/indexProiecte.php");
exit;

?>
