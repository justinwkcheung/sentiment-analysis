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

//Now I can map those keys to each array
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

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'crowdbabble_test';

$connection = mysqli_connect($host,$username,$password,$dbname);

if($connection === false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
    die("Connection failed");
}
else {
  foreach ($csvAsArray as $j=>$jvalue) {
    if ($j == 0) {
      continue;
    }
    $time = $csvAsArray[$j]['Time'];
    $date = $csvAsArray[$j]['Date'];
    $text = $csvAsArray[$j]['Tweet_Text'];
    $type = $csvAsArray[$j]['Type'];
    $media_type = $csvAsArray[$j]['Media_Type'];
    $hashtags = $csvAsArray[$j]['Hashtags'];
    $tweet_id = $csvAsArray[$j]['Tweet_Id'];
    $tweet_url = $csvAsArray[$j]['Tweet_Url'];
    $retweets = $csvAsArray[$j]['Retweets'];
    $is_this_like_question = $csvAsArray[$j]['twt_favourites_IS_THIS_LIKE_QUESTION_MARK'];
    $sql = "INSERT INTO tweets (`Date`, `Time`, Tweet_Text, Type, Media_Type, Hashtags, Tweet_Id, Tweet_Url, twt_favourites_IS_THIS_LIKE_QUESTION_MARK, Retweets, tweet_analyzed)
    VALUES ('$date', '$time', '$text', '$type', '$media_type', '$hashtags', '$tweet_id', '$tweet_url', '$is_this_like_question', '$retweets', 0)";
    ini_set('display_errors', 1);

    mysqli_query($connection, $sql);
  }
}

// foreach($result as $row)
// {
//   var_dump($row);
// }

// $curl = curl_init();
// $firstKey = true;

// foreach($csvAsArray as $arrayKey=>$arrayRow) {
  // if ($firstKey) {
  //   $firstKey = false;
  //   continue;
  // }
  // $tweet_url = $arrayRow['Tweet_Url'];
//   $url = "https://api.dandelion.eu/datatxt/sent/v1/?lang=en&url=".$csvAsArray[2]['Tweet_Url']."&token=50e13e6b06bb4b0c9a233b11acb5687e";
//   var_dump($url);
//   curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://api.dandelion.eu/datatxt/sent/v1/?lang=en&url=".$csvAsArray[2]['Tweet_Url']."&token=50e13e6b06bb4b0c9a233b11acb5687e",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//       "cache-control: no-cache"
//     ),
//   ));
//
//   $response = curl_exec($curl);
//   $err = curl_error($curl);
//
//   var_dump($response);
// }
//
// curl_close($curl);


?>
