<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tweet CSV Analyzer</title>
    <style media="screen">
      table {
        border: 1px solid black;
        margin-top: 40px;
      }
      td {
        border: 1px solid black;
        margin-bottom: 5px;
        padding: 10px;
      }
    </style>
  </head>
  <body>

    <h2>Upload new CSV here</h2>
    <form class="post" action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="csv" value=""><br>
      <input type="submit" name="Upload" value="Upload">
    </form><br><br>

    <a href="runanalysis.php">Run Tweet Sentiment Analysis Here</a><br>

    <?php $tweet_header = "<a href='/index.php?filter=asc-tweet-text'>Sort by tweets asc</a>"; ?>
    <?php $language_header = "<a href='/index.php?filter=asc-language'>Sort by lang asc</a>"; ?>
    <?php $score_header = "<a href='/index.php?filter=asc-score'>Sort by score asc</a>"; ?>
    <?php $type_header = "<a href='/index.php?filter=asc-type'>Sort by type asc</a>"; ?>

    <?php
      $filter = $_GET['filter'];
      if ($filter == 'asc-tweet-text') {
        $tweet_header = "<a href='/index.php?filter=desc-tweet-text'>Sort by tweets desc</a>";
      }
      else if ($filter == 'asc-language') {
        $language_header = "<a href='/index.php?filter=desc-language'>Sort by language desc</a>";
      }
      else if ($filter == 'asc-score') {
        $score_header = "<a href='/index.php?filter=desc-score'>Sort by score desc</a>";
      }
      else if ($filter == 'asc-type') {
        $type_header = "<a href='/index.php?filter=desc-type'>Sort by type desc</a>";
      }
    ?>

    <table>
      <tr>
        <td><?php echo $tweet_header ?></td>
        <td><?php echo $language_header ?></td>
        <td><?php echo $score_header ?></td>
        <td><?php echo $type_header ?></td>
      </tr>

    <?php

    $dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $host = $dburl["host"];
    $username = $dburl["user"];
    $password = $dburl["pass"];
    $dbname = substr($dburl["path"], 1);

    $connection = mysqli_connect($host,$username,$password,$dbname);
    if($connection === false) {
        die("Connection failed");
    }
      if ($filter == 'asc-tweet-text' || $filter == NULL) {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY Tweet_Text ASC";
      }
      else if ($filter == 'desc-tweet-text') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY Tweet_Text DESC";
      }
      else if ($filter == 'asc-language') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY language ASC";
      }
      else if ($filter == 'desc-language') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY language DESC";
      }
      else if ($filter == 'asc-score') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY sentiment_score ASC";
      }
      else if ($filter == 'desc-score') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY sentiment_score DESC";
      }
      else if ($filter == 'asc-type') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY sentiment_type ASC";
      }
      else if ($filter == 'desc-type') {
        $sql = "SELECT id, Tweet_Text, language, sentiment_type, sentiment_score FROM tweets WHERE tweet_analyzed = 1 ORDER BY sentiment_type DESC";
      }
      $result = mysqli_query($connection, $sql);

      foreach($result as $row) {
        echo
          "<tr>
            <td>".$row['Tweet_Text']."</td>
            <td>".$row['language']."</td>
            <td>".$row['sentiment_score']."</td>
            <td>".$row['sentiment_type']."</td>
          </tr>";
      }
    ?>

    </table>
  </body>
</html>
