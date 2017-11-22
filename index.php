<h2>Upload CSV here</h2>
<form class="post" action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="csv" value=""><br>
  <input type="submit" name="Upload" value="Upload">
</form>

<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.dandelion.eu/datatxt/sent/v1/?lang=en&text=I%20really%20love%20your%20APIs&token=50e13e6b06bb4b0c9a233b11acb5687e",
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

curl_close($curl);
var_dump($response);

?>
