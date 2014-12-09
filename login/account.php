<?php
require_once("config/db.php");
require_once("classes/Login.php");
require_once("classes/ImageCount.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
} else {
	include("views/account_not_logged_in.php");
	return 0;
}
?>
<head>
<style>
#submenu
{
	
}
#submenu a
{
	top:20px;
	color: black;
	outline:none;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:700;
	border: 3px solid white;
	border-radius: 4px;
	margin-top: 15px;
	margin-right: 2px;
	margin-left: 2px;
	background-color: gray;
	text-decoration: none;
	
}
</style>
</head>
<div id="submenu">
	<a href="#">test</a>
</div>

<table border="0" cellpadding="3">
<tr>
<td bgcolor="darkgreen" width="120"><font color="white">Kasutajanimi</font></td>
<td bgcolor="green" ><font color="white"><?php echo $_SESSION['user_name']; ?></font></td>
<td></td>
</tr>
<tr>
<td bgcolor="darkgreen"><font color="white">Email</font></td>
<td bgcolor="green" width="200"><font color="white"><?php echo $_SESSION['user_email']; ?></font></td>
<td bgcolor="darkred" ><font color="white">Muuda</font></td>
</tr>
<tr>
<td bgcolor="darkgreen"><font color="white">Parool</font></td>
<td></td>
<td bgcolor="darkred" ><font color="white">Muuda</font></td>
</tr>
<td></td>
<tr>
</tr>
<tr>
<td bgcolor="darkgreen"><font color="white">Konto piltile arv</font></td>
<td bgcolor="green" ><font color="white"><?php echo ImageCount(); ?></font></td>
</tr>
</table>
