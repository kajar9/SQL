<?php
require_once("config/db.php");
require_once("classes/Login.php");
require_once("classes/Functions.php");
UpdatePhotoRating();
$login = new Login();
if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
} else {
	include("views/main_not_logged_in.php");
}
$mainfirst=true;
$result=NULL;
$sql = "SELECT *
        FROM `131034_photos`
		WHERE `rating` > \"0\"
		ORDER BY `rating` DESC, `ts` DESC
		LIMIT 3;";
$mainresult=connect($sql);
include("views/main.php");
?>