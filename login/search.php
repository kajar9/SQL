<?php
require_once("config/db.php");
require_once("classes/Login.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
} else {
	include("views/main_not_logged_in.php");
}

include("views/ImageSearch.php");

require_once("classes/ImageSearch.php");
$ImageSearch = new ImageSearch();
?>
