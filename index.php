<h2>Upload CSV here</h2>
<form class="post" action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="csv" value=""><br>
  <input type="submit" name="Upload" value="Upload">
</form>

<?php

include('config.php');

$connection = mysqli_connect($host,$username,$password,$dbname);
if($connection === false) {
    die("Connection failed");
}
else {
  echo "success";
  $sql = "SELECT id, Tweet_Url FROM tweets WHERE tweet_analyzed = 0";
  $result = mysqli_query($connection, $sql);
  // var_dump($data);
  foreach($result as $row)
  {
    var_dump($row);
  }
}


?>

<?php
// $curl = curl_init();
//
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.dandelion.eu/datatxt/sent/v1/?lang=en&url=https://twitter.com/realDonaldTrump/status/797034721075228672&token=50e13e6b06bb4b0c9a233b11acb5687e",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => array(
//     "cache-control: no-cache"
//   ),
// ));
//
// $response = curl_exec($curl);
// $err = curl_error($curl);
//
// curl_close($curl);
// var_dump($response);

?>

<?php

// $file = fopen("https://www.crowdbabble.com/wp-content/uploads/2016/11/Crowdbabble_Social-Media-Analytics_Twitter-Download_Donald-Trump_7375-Tweets.csv","r");
//
// while(! feof($file))
// {
// print_r(fgetcsv($file));
// }
//
// fclose($file);

?>
