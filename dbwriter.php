<?php include("dbconnect.php");
$handle = @fopen("data.txt", "r");
if ($handle) {
    $counter = 1;
    $title = 'temp';
    $description = 'temp';
    $lesson_link = 'temp';
    $lesson_image = 'temp';
    $category = 'A';
    $student_grades = '1';
    $author = 'temp';
    $content_type = 'temp';
    $time_scraped = new DateTime('2015-04-10');
    while (($buffer = fgets($handle, 4096)) !== false)
    {
	//depending on the counter's value, use counter to read the data to appropriate fields
  $counter++;
  if($counter == 2)
	{ $title = $buffer;
	}
	else if($counter == 3)
	{ $description = $buffer;
	}
	else if($counter == 4)
	{ $lesson_link = $buffer;
	}
	else if($counter == 5)
	{ $lesson_image = $buffer;
	}
	else if($counter == 6)
	{ $category = $buffer;
	}
	else if($counter == 7)
	{ $student_grades = $buffer;
	}
	else if($counter == 8)
	{ $author = $buffer;
	}
	else if($counter == 9)
	{ $content_type = $buffer;
	}
	else if($counter == 10)
	{
	$time_scraped = $buffer;
	//if it is the last entry, write the whole row into the database.
  $query = "insert into education "
                ." (title,description,lesson_link,lesson_image,category,student_grades,author,content_type,time_scraped) values "
                ."('$title','$description','$lesson_link','$lesson_image','$category','$student_grades','$author','$content_type','$time_scraped')"
        ;
  mysqli_query($conn,$query);
	$counter = 1;
	}
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
?>
