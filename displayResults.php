<?php
    include("dbconnect.php");
?>
<?php

function output($result)
{
	print "In";
  //$counter = 0;
  //print $counter;
  if ($result)
  { 
  print "In if";
	  //and $counter<8
        while ($row = mysqli_fetch_array($result) )
        {
        $title =  $row["title"];
	    $temp = $row["lesson_link"];
		$link = $row["lesson_image"];
		print "		<div id=activtyIconSec class=col-md-3>
		<a href=$temp><img src=$link id=activityIconImage>	</a>
		<p id=activityText>$title</p>		
		</div>
        ";
	    //<a href=$temp style=text-decoration:none>
	    //$counter=$counter+1;
        }
		print "Out of if";
        mysqli_free_result($result);
      }
	else{
		print "<p id=main> We do not have any activities with this title.</p>";
	}
}
?>