<?php
// used to connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "webprodb1";
 
try {
    $con = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    // echo "connect successfully";
}
 
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>