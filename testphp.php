<?php
  $json_string = file_get_contents("https://api.dandelion.eu/datatxt/sent/v1/?lang=en&text=I%20really%20love%20your%20APIs&token=50e13e6b06bb4b0c9a233b11acb5687e");
  $parsed_json = json_decode($json_string, TRUE);
  var_dump($parsed_json);
?>
