<?php
// define variables and set to empty values


if(isset($_POST["rating"])){
  $rate_photoid = $rate_rating = $rate_userid = "";
  $rate_photoid = test_input($_POST["photoid"]);
  $rate_rating = test_input($_POST["rating"]);
  $rate_userid = $_SESSION['user_id'];
  $sql12="SELECT * FROM `131034_ratings` WHERE `user_id` = \"" . $rate_userid . "\" AND `photo_id` = \"" . $rate_photoid . "\"";
  $locresult425 = connect($sql12);
  $numrows425 = $locresult425->num_rows;
  if($numrows425>0){
	$sql12="UPDATE `131034_ratings` 
	SET `rating` = \"" . $rate_rating . "\" 
	WHERE `user_id` = \"" . $rate_userid . "\" 
	AND `photo_id` = \"" . $rate_photoid . "\";";
  }else{
	$sql12="INSERT INTO `131034_ratings`
	(`photo_id`, `user_id`, `rating`) 
	VALUES (" . $rate_photoid . "," . $rate_userid . "," . $rate_rating . ")";
  }
  connect($sql12);
  echo "Sinu hinnang pildile on salvestatud!";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<head>
<style>
#menu
{
	position:relative;
	padding-top: 5px;
	padding-bottom: 5px;
	text-align:center;
}

#menu p
{
	color: black;
	outline:none;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:700;
	border: 3px solid white;
	border-radius: 4px;
	margin-right: 2px;
	margin-left: 2px;
	padding: 3px;
	background-color: gray;
	text-decoration: none;
	
}

#menu a
{
	color: black;
	outline:none;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:700;
	border: 3px solid white;
	border-radius: 4px;
	margin-right: 2px;
	margin-left: 2px;
	padding: 3px;
	background-color: gray;
	text-decoration: none;
	
}

#menu a:hover {
    color: blue;
}

#resim
{
	display: block;
	max-height: 400px;
	max-width: 100%;
	margin: auto;
}

#imagebox
{
	display: block;
	background-color: lightblue;
	align: center;
	padding-bottom: 120px;
}
#element {  
  border: 2px solid black;
  width: 5.33%;
  width: calc(60%/3);
  height: 20px;
  float: left;
  text-align: left;
  overflow: hidden;
  word-break: break-all;
}


td{
text-align: center;
}

</style>
</head>
<div id="menu">
<p>Top rated images</p>
</div>

<?php
while($res = $mainresult->fetch_object()){
	echo "<div id=\"imagebox\">";
	$filename = $res->filename . "." . $res->suffix;
	echo "<img id=\"resim\" src=\"uploads/" . $filename . "\">";
	$rating = getRating($res->id);
	echo "<div id=\"element\" style=\"margin-left: 20%\">";
	echo "Author: " . $res->owner;
	echo "</div>";
	echo "<div id=\"element\">";
	echo "Rating: " . number_format($rating,2);
	if(getMyRating($res->id)>0){ echo " My Rating: " . getMyRating($res->id);}
	echo "</div>";
	echo "<div id=\"element\">";
	echo "Date : " . $res->ts;
	echo "</div>";
	echo "<div id=\"element\" style=\"margin-left: 20%; overflow-y: auto; width: calc(60% + 8px); height: 42px\";>";
	echo "Description: " . $res->description;
	echo "</div>";
	if(isUserLoggedIn()){
	echo "<div id=\"element\" style=\" margin-left: 20%;  width: calc(20% + 3px); height: 24px\";>";
	echo "<form method=\"post\" action=\"main.php\">
<select name=\"rating\">
<option value=\"1\">Not interesting&nbsp;&nbsp;( 1 )</option>
<option value=\"2\">Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 2 )</option>
<option value=\"3\">Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 3 )</option>
<option value=\"4\">Great&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 4 )</option>
<option value=\"5\" selected>Amazing&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 5 )</option>
<input type=\"hidden\" name=\"photoid\" value=\"" . $res->id . "\" />
</select>
<input type=\"submit\" value=\"Rate\">
</form>";
	echo "</div>";}
	echo "<div id=\"element\" style=\"margin-left: 40%; text-align: center; margin-top:72px; position:absolute; border: 0; width: calc(17% + 1px); height: 32px\";>";
	echo "<div id=\"menu\"><a href=\"#\">Comments (" . CommentCount($res->id) . ")</a></div>";
	echo "</div>";
	echo "</div><br>";	
}
?>

	