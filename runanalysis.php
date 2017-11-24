<h1>Sentiment Analysis Runs Here</h1><br>
<?php

$dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $dburl["host"];
$username = $dburl["user"];
$password = $dburl["pass"];
$dbname = substr($dburl["path"], 1);
$dandelion_token = getenv('DANDELION_TOKEN');

$connection = mysqli_connect($host,$username,$password,$dbname);

if($connection === false) {
    die("Connection failed");
}
else {
  $sql = "SELECT Id, Tweet_Url, Tweet_Text FROM tweets WHERE tweet_analyzed = 0 LIMIT 250";
  $result = mysqli_query($connection, $sql);

  $curl = curl_init();

  foreach ($result as $row) {
    $tweet_url = $row['Tweet_Url'];
    $url = "https://api.dandelion.eu/datatxt/sent/v1/?lang=en&url=".$tweet_url."&token=".$dandelion_token;
    var_dump($tweet_url);
    var_dump($row['Tweet_Text']);
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $response = json_decode($response, true);
    var_dump($response);
    echo "<br><br>";
    $id = $row['Id'];
    $language = $response['lang'];
    $sentiment_type = $response['sentiment']['type'];
    $sentiment_score = $response['sentiment']['score'];

    $sqlUpdate = "UPDATE tweets SET tweet_analyzed = 1, language = '$language', sentiment_type = '$sentiment_type', sentiment_score = '$sentiment_score' WHERE Id = '$id'";
    $sqlUpdateResult = mysqli_query($connection, $sqlUpdate);
    ini_set('display_errors', 1);
  }




  curl_close($curl);
}



?>

<br><a href="/index.php">Back to Main Page</a>
