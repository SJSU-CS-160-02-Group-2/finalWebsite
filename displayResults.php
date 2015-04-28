<?php
    include("dbconnect.php");
?>
<?php

function output($result)
{
$counter = 0;
  if ($result)
  {	
        while ($row = mysqli_fetch_array($result) )
        {
		$counter = $counter+1;
        	$title =  $row["title"];
		while(strlen($title)>27)
		{
			$pos = strrpos($title," ");
			$title = substr($title , 0,$pos); 
		}
	    	$temp = $row["lesson_link"];
		$link = $row["lesson_image"];
		print "		<div id=activtyIconSec class=col-md-3>
		<a href=$temp><img src=$link id=activityIconImage>	</a>
		<p id=activityText>$title</p>		
		</div>
        ";
        }
	if($counter==0){
		print "<p id=main> We do not have any activities with this title.</p>";
	}
        mysqli_free_result($result);
   }
   else{
		print "<p id=main> We do not have any activities with this title.</p>";
	}
	
	
}
?>