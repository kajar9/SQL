<head>
<style>
#resim
{
	display: block;
	max-width: 100%;
	margin: auto;
}
</style>
</head>
<?php

require_once("config/db.php");
require_once("classes/Login.php");
require_once("classes/Functions.php");
UpdatePhotoRating();
$login = new Login();

if(isset($_POST["comment"])){
  $comment = "";
  $comment = test_input($_POST["comment"]);
  $comment_photoid = test_input($_GET["photo_id"]);
  $comment_userid = $_SESSION['user_id'];
  $sql12="INSERT INTO `131034_comments` 
  (`photo_id`, `user_id`, `comment`)
  VALUES (\"" . $comment_photoid . "\",\"" . $comment_userid . "\",\"" . $comment . "\");";
  echo "Sinu kommentaar on lisatud!";
  connect($sql12);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($login->isUserLoggedIn() == true) {
		}else{
		include("views/main_not_logged_in.php");
	}
	
	if(isset($_GET["photo_id"])){
		$photo_id = $_GET["photo_id"];
		
		$sql = "SELECT * FROM `131034_photos` WHERE `id` = \"" . $photo_id . "\" LIMIT 1";
		$locresult = connect($sql);
		while($res=$locresult->fetch_object()){
			echo "<img id=\"resim\" src=\"uploads/" .$res->filename . "." . $res->suffix . "\">";
		}
		
		echo "<table width=\"100%\">";
			$sql = "SELECT * FROM `131034_comments` WHERE `photo_id` = \"" . $photo_id . "\" ORDER BY `ts` ASC";
			$locresult = connect($sql);
			$username="";
			while($res=$locresult->fetch_object()){
			$username=getUser($res->user_id);
			echo "<tr><td width=\"100%\">";
				echo $username . " @ " . $res->ts . " --- " . $res->comment;
			echo "</td></tr>";
			}
		echo "</table>";
		//Comment box
		if ($login->isUserLoggedIn() == true) {
		echo "<div width=\"100%\" align=\"center\"><form method=\"POST\" action=\"comment.php?photo_id=" . $photo_id . "\">";
		echo "<textarea name=\"comment\" maxlength=\"1000\" cols=\"5\" style=\"width: 99%;\"></textarea><br>";
		echo "<input type=\"submit\" value=\"Lisa kommentaar!\" name=\"submit\"></div>";
		}
} else {
	
	echo "Viga kommentaaride laadimisel!";
}
?>