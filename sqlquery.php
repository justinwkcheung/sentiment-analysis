<?php

// ini_set('display_errors', 1);

// Try and connect to the database
include('config.php');
$connection = mysqli_connect($host,$username,$password,$dbname);
// var_dump($connection);
// If connection was not successful, handle the error
if($connection === false) {
    die("Connection failed");
}
else {
  echo "success";
  // $sql = "ALTER TABLE tweets ADD tweet_analyzed BOOLEAN DEFAULT 0";
  // mysqli_query($connection, $sql);
}

?>
