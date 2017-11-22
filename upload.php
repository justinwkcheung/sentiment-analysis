<?php
var_dump('hello');

$tmpName = $_FILES['csv']['tmp_name'];
$csvAsArray = array_map('str_getcsv', file($tmpName));

if (!empty($_FILES["csv"])) {
  $myFile = $_FILES["csv"];
}

if($myFile['error'] > 0){
  die('<div> An error occurred while uploading the file </div>');
}

$csv_mimetypes = array(
    'text/csv',
    'text/plain',
    'application/csv',
);
if (!in_array($myFile['type'], $csv_mimetypes)) {
  die('<div> An error occurred while uploading the file as CSV </div>');
}

var_dump($myFile);
var_dump($csvAsArray);
?>
