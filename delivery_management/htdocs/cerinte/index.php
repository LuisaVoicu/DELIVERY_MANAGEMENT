<html>
    <head>
        <title> ohp </title>
    </head>

<body>
    <?php
    if (isset($_POST['submit']))
    {
        echo "firstname: " . $_POST['firstname'] . '<br />';
        echo "lastname: " . $_POST['lastname'] . '<br />';
    }
    ?>
    <form action="" method="POST">
        <p>firstname: <input type = "text" name="firstname" value=""></p>
        <p>lastname: <input type = "text" name="lastname"value=""></p>
        <input type ="submit" name="submit" value="Submit">
    </form>
</body> 
</html> action

<?php
function pre_r( $array ){
    echo '<pre> ';
        print_r($array);
        echo'</pre>';
} 
?>