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
              <input type="checkbox" name="gradeLevel" value="grade_k" id="grade">
              k
              <input type="checkbox" name="gradeLevel" value="grade_6" id="grade">
              6 </div>
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_1" id="grade">
              1
              <input type="checkbox" name="gradeLevel" value="grade_7" id="grade">
              7 </div>
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_2" id="grade">
              2
              <input type="checkbox" name="gradeLevel" value="grade_8" id="grade">
              8 </div>
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_3" id="grade">
              3
              <input type="checkbox" name="gradeLevel" value="grade_9" id="grade">
              9 </div>
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_4" id="grade">
              4
              <input type="checkbox" name="gradeLevel" value="grade_10" id="grade">
              10 </div>
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_5" id="grade">
              5
              <input type="checkbox" name="gradeLevel" value="grade_11" id="grade">
              11 </div>
          </div>
          <div class="row col-md-12">
            <div class="col-md-2">
              <input type="checkbox" name="gradeLevel" value="grade_12" id="grade">
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
                <input type="checkbox" name="career" value="astronaut">
                Astronaut</div>
              <div class="row">
                <input type="checkbox" name="career" value="computer">
                Computer Scientist</div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <input type="checkbox" name="career" value="doctor">
                Doctor </div>
              <div class="row">
                <input type="checkbox" name="career" value="engineer">
                Engineer</div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <input type="checkbox" name="career" value="geology">
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
  $to_be_recovered_name=$_POST['searchname'];
  //Mike changes code here to get search by grade level working.
  //Gavin changes code here to get search by grade level working.
  if(empty($to_be_recovered_name))
  {
	  $result = mysqli_query($conn,"SELECT * FROM education");
  }
  else
  {
	  //Nick changes something here to get exclude from search feature working.
      $keywords = preg_split("/[\s]+/", $to_be_recovered_name);
      $count = count($keywords);
      
      $includedTerms="";
      $excludedTerms="";
      
      $query = "SELECT * FROM education WHERE";

      for ($i = 0; $i < $count; $i++) {
        if ( strcmp( mb_substr($keywords[$i], 0, 1), "-") !=0 ) {
            if(strlen($keywords[$i])>0)
                $includedTerms = $includedTerms . " (category LIKE '%$keywords[$i]%') OR (title LIKE '%$keywords[$i]%') OR";
        } else {
            $term = mb_substr($keywords[$i], 1, strlen($keywords[$i])-1);
            if(strlen($term)>0)
                $excludedTerms= $excludedTerms . " (category NOT LIKE '%$term%') AND (title NOT LIKE '%$term%') AND";
        }
      }
      if(strlen($includedTerms) > 0)
        $includedTerms = mb_substr($includedTerms, 0, strlen($includedTerms)-strlen("OR") );
        
      
      if(strlen($excludedTerms) > 0)
        $excludedTerms = mb_substr($excludedTerms, 0, strlen($excludedTerms)-strlen("AND") );
      
      if(strlen($includedTerms) > 0 && strlen($excludedTerms) > 0 ){
        $includedTerms = "(" . $includedTerms . ")";
        $excludedTerms = "(" . $excludedTerms . ")";
        $query = $query . $includedTerms . " AND " . $excludedTerms;
      } else {
        $query = $query . $includedTerms . $excludedTerms;  
      }
      
	  $result = mysqli_query($conn, $query);
  }
  //Change the following to get similar features working properly-Alvin
  $similarResults =  mysqli_query($conn, "SELECT * FROM education WHERE (category LIKE '%$to_be_recovered_name%') OR (title LIKE '%$to_be_recovered_name%')");
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