<?php

ini_set("auto_detect_line_endings", true);

$tmpName = $_FILES['csv']['tmp_name'];
$csvAsArray = array_map('str_getcsv', file($tmpName));
// array_map('str_getcsv', file('data.csv' , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

//First I want to grab the values from the first row to be the keys of the next rows
$keys = [];
foreach ($csvAsArray[0] as $titleKeys=>$titleValues) {
  array_push($keys, $titleValues);
}

foreach ($csvAsArray as $i=>$row) {
    $csvAsArray[$i] = array_combine($keys, $row);
}

if (!empty($_FILES["csv"])) {
  $myFile = $_FILES["csv"];
}

if($myFile['error'] > 0){
  die('<div> An error occurred while uploading the file </div>');
}

// $csv_mimetypes = array(
//     'text/csv',
//     'text/plain',
//     'application/csv',
// );
// if (!in_array($myFile['type'], $csv_mimetypes)) {
//   die('<div> An error occurred while uploading the file </div>');
// }

// var_dump($_FILES['csv']);
// var_dump($csvAsArray);
?>
