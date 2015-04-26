<?php
    include("dbconnect.php");
?>

<style>
<?php include ("main.css"); ?>
<?php include ("bootstrap.css"); ?>
</style>

<?php

function outputSimilarResults($result)
{
	
	       
          
	//$counter=0;
		//$counter = $counter+1;
  //$to_be_recovered_name=$_POST['searchname'];
  //$sql = "SELECT * FROM education where title ='$to_be_recovered_name'";
  //$counter = 0;
  //print $counter;
  if ($result)
  {
	  //and $counter<8
        while ($row = mysqli_fetch_array($result) )
        {
	  	
        $title =  $row["title"];
	    $temp = $row["lesson_link"];
		$link = $row["lesson_image"];
		
		print "
		<div id=activtyIconSec class=col-md-12>
		<a href=$temp><img src=$link id=activityIconImageSimilar>	</a>
		<p id=activityTextSimilar>$title</p>		
		</div>
        ";
	    //<a href=$temp style=text-decoration:none>
	    //$counter=$counter+1;
        }
        mysqli_free_result($result);
      }
}
?>
