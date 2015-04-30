<?php
	include("dbconnect.php");
	include("displayResults.php");
	include("similarResults.php");
?>
<style>
<?php include ("main.css");
?> <?php include ("bootstrap.css");
?>
</style>

<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400' rel='stylesheet' type='text/css'>
<link type="text/css" rel="stylesheet" href="main.css"/>
<link type="text/css" rel="stylesheet" href="bootstrap.css"/>
</head>
<title>Chimera.com</title>
<body>
<div class="container-fluid">
	<form method=post action="index.php">
	<!--row for heading-->
	<div class="row" id="header">
		<div class="col-md-2" id="name">CHIMERA</div>
		<!--Search bar div-->
		<div class="col-md-8"></div>
		<div class="col-md-2">
		<div class="col-md-4  text-center"></div>
		<div class="col-md-3  text-center"></div>
		<div class="col-md-3  text-center button-design" id="mail-button"><a href="mailto:27aishwarya@gmail.com"><img src="mailB.png" class="icon-size"/></a></div>
		<div class="col-md-2  text-center"></div>
		</div>
	</div>
	<div class="row" id="header">
		<div class="col-md-12 plainSpaceInSearch"> </div>
	</div>
	<div class="row" id="searchBarDiv">
	<div class="row">
		<div class="col-md-12">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<input type="text" name=searchname placeholder="Type any activity title or subject" id="searchBar">
				<input type="submit" name=searchButton value="S" id="searchButton" >
			</div>
			<div class="col-md-2"></div>
			</div>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
	<div class="col-md-12 plainSpaceInSearch"> </div>
	<!--for the refine results area-->
	<div class="row">
		<div class="col-md-12 ">
		<p id="searchBarHeadingMain" class="text-center" >REFINE RESULTS</p>
		</div>
		<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-4">
			<div class="row col-md-12">
			<p id="searchBarHeading" class="text-center">By GRADE LEVEL:</p>
			</div>
			<div class="row col-md-12 text-left">
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_k" id="grade">
				k
				<input type="checkbox" name="gradeLevel[]" value="grade_6" id="grade">
				6 </div>
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_1" id="grade">
				1
				<input type="checkbox" name="gradeLevel[]" value="grade_7" id="grade">
				7 </div>
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_2" id="grade">
				2
				<input type="checkbox" name="gradeLevel[]" value="grade_8" id="grade">
				8 </div>
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_3" id="grade">
				3
				<input type="checkbox" name="gradeLevel[]" value="grade_9" id="grade">
				9 </div>
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_4" id="grade">
				4
				<input type="checkbox" name="gradeLevel[]" value="grade_10" id="grade">
				10 </div>
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_5" id="grade">
				5
				<input type="checkbox" name="gradeLevel[]" value="grade_11" id="grade">
				11 </div>
			</div>
			<div class="row col-md-12">
			<div class="col-md-2">
				<input type="checkbox" name="gradeLevel[]" value="grade_12" id="grade">
				12</div>
			<div class="col-md-6">
				<input type="checkbox" onClick="toggle(this,'gradeLevel')">
				Select all</div>
			</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class="row col-md-12">
			<p id="searchBarHeading" class="text-center">By CAREER:</p>
			</div>
			<div class="row col-md-12">
			<div class="col-md-4">
				<div class="row">
				<input type="checkbox" name="career[]" value="astronaut">
				Astronaut</div>
				<div class="row">
				<input type="checkbox" name="career[]" value="computer">
				Computer Scientist</div>
			</div>
			<div class="col-md-4">
				<div class="row">
				<input type="checkbox" name="career[]" value="doctor">
				Doctor </div>
				<div class="row">
				<input type="checkbox" name="career[]" value="engineer">
				Engineer</div>
			</div>
			<div class="col-md-4">
				<div class="row">
				<input type="checkbox" name="career[]" value="geology">
				Geologist </div>
				<div class="row">
				<input type="checkbox" onClick="toggle(this,'career')">
				Select all </div>
			</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="col-md-12 extraSpace"></div>
		</div>
	</div>
	<!--for the actualsearch results-->
	<div class="secondPart row">
	<div class="col-md-1" id="extraCol" > </div>
	<div class="col-md-9" id="results">
	<div class="row">
		<div class="col-md-12">
		<h2 class="text-center" id="main">SEARCH RESULTS</h2>
		</div>
	</div>
	<div class="row">
		<?php
		//use this function to check if any boxes are checked at all
	function IsValueChecked($array_name,$value)
	{
		if(!empty($_POST[$array_name]))
		{
			foreach($_POST[$array_name] as $check_value)
			{
				if($check_value == $value)
				{
					return true;
				}
			}
		}
		return false;
	}
	//Returns $A . $middle . $B, unless $A is 0-length, in which case it just returns $B
	function concatBOOL($A, $middle, $B)
	{
		if (!strlen($A)>0) {
			$middle = "";
		}
		return $A . $middle . $B;
	}

	$to_be_recovered_name=isset($_POST['searchname'])?$_POST['searchname'] : '';

	$selected_grade = isset($_POST['gradeLevel'])?$_POST['gradeLevel'] : [];
	$selected_career = isset($_POST['career'])?$_POST['career']:[];
	$careerSql = "";
	$gradeSql = "";
	$termsSql = "";
	$relatedSql = "";
	$relatedGradeSql = "";
	$relatedGrades;
	$relatedCareerSql = "";
	//Generate the SQL for career filtering.
	if(!empty($selected_career)) {
		if (IsValueChecked('career', 'astronaut')) {
			$careerSql = concatBOOL($careerSql, " OR ", "(category LIKE '%space%') OR (category LIKE '%physic%') OR (category LIKE '%astronomy%') OR (category LIKE '%moon%')");
			//Astronaut is like engineer.
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%mathematics%') OR (category LIKE '%engineering%') OR (category LIKE '%algebra%') OR (category LIKE '%geometry%') OR (category LIKE '%discrete%') OR (category LIKE '%number%') OR (category LIKE '%graph%') OR (category LIKE '%calculus%') OR (category LIKE '%probability%')");
		}
		if (IsValueChecked('career', 'doctor')) {
			$careerSql = concatBOOL($careerSql, " OR ", "(category LIKE '%chemistry%') OR (category LIKE '%biology%') OR (category LIKE '%health%') OR (category LIKE '%medicine%')");
			//Doctor is like geologist?
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%physics%') OR (category LIKE '%earth%')");
		}
		if (IsValueChecked('career', 'engineer')) {
			$careerSql = concatBOOL($careerSql, " OR ", "(category LIKE '%physic%') OR (category LIKE '%mathematics%') OR (category LIKE '%engineering%') OR (category LIKE '%algebra%') OR (category LIKE '%geometry%') OR (category LIKE '%discrete%') OR (category LIKE '%number%') OR (category LIKE '%graph%') OR (category LIKE '%calculus%') OR (category LIKE '%probability%')");
			//Engineer is like computer scientist.
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%technology%')");
		}
		if (IsValueChecked('career', 'geology')) {
			$careerSql = concatBOOL($careerSql, " OR ", "(category LIKE '%chemistry%') OR (category LIKE '%biology%') OR (category LIKE '%physics%') OR (category LIKE '%earth%')");
			//Biologist is like doctor.
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%health%') OR (category LIKE '%medicine%')");
		}
		if (IsValueChecked('career', 'computer')) {
			$careerSql = concatBOOL($careerSql, " OR ", "(category LIKE '%physic%') OR (category LIKE '%mathematics%') OR (category LIKE '%technology%') OR (category LIKE '%algebra%') OR (category LIKE '%geometry%') OR (category LIKE '%discrete%') OR (category LIKE '%number%') OR (category LIKE '%graph%') OR (category LIKE '%calculus%') OR (category LIKE '%probability%')");
			//Computer scientist is like engineer and astronaut.
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%engineering%')");
			$relatedCareerSql = concatBOOL($relatedCareerSql, " OR ", "(category LIKE '%space%') OR (category LIKE '%astronomy%') OR (category LIKE '%moon%')");
		}
	}
	//Generate the SQL for grade level filtering.
	if (!empty($selected_grade)) {
		if (IsValueChecked('gradeLevel', 'grade_k')) {
			$gradeSql = concatBOOL($gradeSql, " OR ", "(FIND_IN_SET('k', student_grades) > '0')");
		}
		for ($i = 1; $i <= 12; $i++) {
			if (IsValueChecked('gradeLevel', 'grade_' . $i)) {
				$gradeSql = concatBOOL($gradeSql, " OR ", "(FIND_IN_SET('" . $i . "', student_grades) > '0')");
				$relatedGrades[$i]   = TRUE;
				$relatedGrades[$i+1] = TRUE; //Related shows one grade level up, and one level down.
				$relatedGrades[$i-1] = TRUE;
			}
		}
		for ($i = 1; $i <= 12; $i++) {
			if (isset($relatedGrades[$i])) {
				$relatedGradeSql = concatBOOL($relatedGradeSql, " OR ", "(FIND_IN_SET('" . $i . "', student_grades) > '0')");
			}
		}
	}
	//Generate the SQL for search terms and filter terms.
	$includedTerms=""; //Moved outside the block to be used for related terms.
	if (!empty($to_be_recovered_name)){
		$keywords = preg_split("/[\s]+/", $to_be_recovered_name);
		$count = count($keywords);
		
		$excludedTerms="";
		for ($i = 0; $i < $count; $i++) {
			if ( strcmp( mb_substr($keywords[$i], 0, 1), "-") !=0 ) {
				if(strlen($keywords[$i])>0)
					$includedTerms = concatBOOL($includedTerms, " OR ", "(category LIKE '%$keywords[$i]%') OR (title LIKE '%$keywords[$i]%')");
			} else {
				$term = mb_substr($keywords[$i], 1, strlen($keywords[$i])-1);
				if(strlen($term)>0)
					$excludedTerms = concatBOOL($excludedTerms, " AND ", "(category NOT LIKE '%$term%') AND (title NOT LIKE '%$term%')");
			}
		}
		
		if(strlen($includedTerms) > 0 && strlen($excludedTerms) > 0 ) {
			$includedTerms = "(" . $includedTerms . ")";
			$excludedTerms = "(" . $excludedTerms . ")";
			$termsSql .= $includedTerms . " AND " . $excludedTerms;
		} else {
			$termsSql .= $includedTerms . $excludedTerms;
		}
		//uncomment to see sql statement (for debugging)
		//print "<p id=main>$termsSql</p>";
	}
	//Concatenate the individual parts of the SQL together.
	$concatSql = "";
	//Grade part
	if (strlen($gradeSql)>0) {
		$concatSql .= "(" . $gradeSql . ")";
	}
	if (strlen($relatedGradeSql)>0) {
		$relatedSql .= "(" . $relatedGradeSql . ")";
	}
	//Career part
	if (strlen($careerSql)>0) {
		if (strlen($concatSql)>0) {
			$concatSql .= " AND ";
		}
		$concatSql .= "(" . $careerSql . ")";
	}
	if (strlen($relatedCareerSql)>0) {
		if (strlen($relatedSql)>0) {
			$relatedSql .= " AND ";
		}
		$relatedSql .= "(" . $relatedCareerSql . ")";
	}
	//Search terms part
	if (strlen($termsSql)>0) {
		if (strlen($concatSql)>0) {
			$concatSql .= " AND ";
		}
		$concatSql .= "(" . $termsSql . ")";
	}
	if (strlen($includedTerms)>0) {
		if (strlen($relatedSql)>0) {
			$relatedSql .= " AND ";
		}
		$relatedSql .= "(" . $includedTerms . ")"; //Related will shows results from omitted terms.
	}
	//Related will not show results that are already on the main page.
	$relatedSql = concatBOOL("(" . $relatedSql . ")", " - ", "(" . $concatSql . ")");

	if (strlen($concatSql)>0) {
		//print "<p id=main>$concatSql</p>";
		$result = mysqli_query($conn, "SELECT * FROM education WHERE " . $concatSql);
	} else {
		//just return everything
		$result = mysqli_query($conn, "SELECT * FROM education");
	}

	//print "<p id=main>$relatedSql</p>";
	$similarResults = mysqli_query($conn, "SELECT * FROM education WHERE " . $relatedSql);
	output($result);
	 print "</div>
		</div>
		<div class=col-md-2 id=similarResults >
		<div class=row> 
			<div class=col-md-12>
			<h2 id=head>SIMILAR RESULTS</h2>
			</div>
		</div>
		<div class=row>";
	outputSimilarResults($similarResults);
		print "
		</div>
		</div>";
?>
		</div>
	</form>
</div>
</body>
</html><script language="JavaScript">
function toggle(source,type) {
	checkboxes = document.getElementsByName(type);
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}
</script>
