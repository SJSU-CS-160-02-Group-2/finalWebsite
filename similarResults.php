<?php
    include("dbconnect.php");
?>

<style>
<?php include ("main.css"); ?>
<?php include ("bootstrap.css"); ?>
</style>

<?php

function fisherYates(&$array)
{
    for ($i = count($array) - 1; $i > 0; $i--)
    {
        $j = rand(0, $i);
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }
}

function outputSimilarResults($result, $numResults)
{

  if ($result)
  {
    $generatedHTML;
    $i = 0;
    while ($row = mysqli_fetch_array($result) )
    {
      $title =  $row["title"];
      $temp = $row["lesson_link"];
      $link = $row["lesson_image"];
    
      $generatedHTML[$i] = "
    <div id=activtyIconSec class=col-md-12>
    <a href=$temp><img src=$link id=activityIconImageSimilar>  </a>
    <p id=activityTextSimilar>$title</p>    
    </div>
      ";
      $i++;
    }
    mysqli_free_result($result);
    fisherYates($generatedHTML);
    for ($i = 0; $i < $numResults; $i++) { //Display only 10, at random.
      print $generatedHTML[$i];
    }
  }
}
?>
