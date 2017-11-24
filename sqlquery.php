<?php

// ini_set('display_errors', 1);

// Try and connect to the database
$dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $dburl["host"];
$username = $dburl["user"];
$password = $dburl["pass"];
$dbname = substr($dburl["path"], 1);
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
