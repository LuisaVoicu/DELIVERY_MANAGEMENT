<?php

// does it contains the id?
if(isset($_GET["IDF"]))
{
    // read the id

    $IDF = $_GET["IDF"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM furnizori WHERE IDF = '$IDF'";
    $result = $connection->query($sql);

    
    if(!$result)
    {

        $errorMessage = "Invalid query: " . $connection->error;
       
    }
  }
header("location: /furnizori/indexFurnizori.php");
exit;

?>
