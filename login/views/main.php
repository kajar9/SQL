<?php
// define variables and set to empty values


if(isset($_POST["photoids"])){
  $rate_photoid = $rate_rating = $rate_userid = "";
  $rate_photoid = test_input($_POST["photoids"]);
  $rate_userid = $_SESSION['user_id'];
  $sql12="SELECT * FROM `131034_ratings` WHERE `user_id` = \"" . $rate_userid . "\" AND `photo_id` = \"" . $rate_photoid . "\"";
  $locresult425 = connect($sql12);
  $numrows425 = $locresult425->num_rows;
  if($numrows425>0){
	$sql12="DELETE FROM `131034_ratings` WHERE `user_id` = \"" . $rate_userid . "\" AND `photo_id` = \"" . $rate_photoid . "\"";
	echo "Sinu hinnang pildilt on eemaldatud!";
  }else{
	$sql12="INSERT INTO `131034_ratings`
	(`photo_id`, `user_id`) 
	VALUES (" . $rate_photoid . "," . $rate_userid . ")";
	echo "Sinu hinnang pildile on salvestatud!";
  }
  connect($sql12);
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
	
	align: center;
	padding-bottom: 120px;
}
#element {  
  border: 2px solid black;
  width: 5.33%;
  width: calc(70%/3);
  height: 33px;
  float: left;
  text-align: left;
  overflow: hidden;
  word-break: break-all;
}


td{
text-align: center;
}

.like {
border: none;
background:url("like.png");
	height:33px;
width: 114px;
background-size: 100%;
}

.like:hover {	
    background:url("likeMO.png");
	height:33px;
width: 114px;
background-size: 100%;
}

.liked {
border: none;
background:url("liked.png");
background-size: 100%;
	height:33px;
width: 114px;
background-size: 100%;
}

.liked:hover {	
    background:url("likedMO.png");
	height:33px;
width: 114px;
background-size: 100%;
}

</style>

<script>
function gid(c) {
    return document.getElementById(c);
}
function replace(c) {
	gid(c).className += "d";
}
</script>
</head>
<div id="menu">
<p>Top rated images</p>
</div>

<?php
while($res = $mainresult->fetch_object()){
	echo "<div id=\"imagebox\">";
	$filename = $res->filename . "." . $res->suffix;
	echo "<img id=\"resim\" src=\"uploads/" . $filename . "\">";
	echo "<div id=\"element\" style=\"margin-left: 14.5%\">";
	echo "Author: " . $res->owner;
	$rating = getRating($res->id);
	echo " ( " . $rating . " Likes )";
	echo "</div>";
	
	echo "<div style=\"text-align: center;\" id=\"element\">";
	if(isUserLoggedIn()){
	echo "<form method=\"POST\" action=\"main.php\">";
	echo "<input type=\"hidden\" name=\"photoids\" value=\"" . $res->id . "\">";
	echo "<input type=\"submit\" value=\"\" id=\"" . $res->id . "\" class=\"like\" />";
	echo "</form>";
	if(MyRate($res->id)>0){echo "<script>replace(" . $res->id . ");</script>";}
	}
	echo "</div>";
	echo "<div id=\"element\">";
	echo "Date : " . $res->ts;
	echo "</div>";
	echo "<div id=\"element\" style=\"margin-left: 14.5%; overflow-y: auto; width: calc(70% + 8px); height: 42px\";>";
	echo "Description: " . $res->description;
	echo "</div>";
	echo "<div id=\"element\" style=\"margin-left: 40%; text-align: center; margin-top:86px; position:absolute; border: 0; width: calc(17% + 1px); height: 32px\";>";
	echo "<div id=\"menu\"><a target=\"search_iframe\" href=\"comment.php?photo_id=" . $res->id . "\">Comments (" . CommentCount($res->id) . ")</a></div>";
	echo "</div>";
	echo "</div><br>";	
}
?>