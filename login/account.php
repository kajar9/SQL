<?php
require_once("config/db.php");
require_once("classes/Login.php");
require_once("classes/Functions.php");
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
	margin: 10px;
	text-align: center;
}
#submenu a
{
	top:20px;
	color: black;
	outline:none;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:700;
	border: 3px solid darkblue;
	
	border-radius: 4px;
	margin-right: 2px;
	margin-left: 2px;
	padding: 3px;
	background-color: lightblue;
	text-decoration: none;
}

#resim
{
	display: block;
	max-height: 100px;
	max-width: 100%;
	margin: auto;
}


</style>
</head>
<div id="submenu">
	<a href="upload.html" target="search_iframe"=>Lae üles uus foto</a>
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
</tr>
<td></td>
<tr>
</tr>
<tr>
<td bgcolor="darkgreen"><font color="white">Konto piltide arv</font></td>
<td bgcolor="green" ><font color="white"><?php echo ImageCount(); ?></font></td>
</tr>
</table>

<br>
<div width="90%">
<?php
$sql="SELECT * FROM `131034_photos` WHERE `owner` = \"" . $_SESSION['user_name'] . "\"";
$result=connect($sql);
while($res = $result->fetch_object()){

echo "<table align=\"center\" border=\"3\" style=\"float: left; width: calc(100%/3); text-align: center;\">\n";
echo "<tr>\n";
echo "<td rowspan=\"3\"><a href=\"uploads/" . $res->filename . "." . $res->suffix . "\" target=\"_blank\" ><img id=\"resim\" src=\"uploads/" . $res->filename . "." . $res->suffix . "\"></a></td>\n";
echo "<td><a href=\"uploads/" . $res->filename . "." . $res->suffix . "\" target=\"_blank\" >VIEW</a></td>\n";
echo "</tr>\n";
echo "<tr><td><a target=\"search_iframe\" href=\"comment.php?photo_id=" . $res->id . "\">Comments (" . CommentCount($res->id) . ")</a></td></tr>\n";
echo "<tr><td><a target=\"search_iframe\" href=\"delete.php?photo_id=" . $res->id . "\">DELETE</a></td></tr>\n";
echo "</table>";

}
?>
</div>