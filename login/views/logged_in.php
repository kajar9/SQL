<!-- if you need user information, just put them into the $_SESSION variable and output them here -->

<head>
<style>

#table
{
	color: white;
	padding: 0px;
}
</style>

</head>

<div id="table">
<table width="100%" cellpadding="5" border="0">
<tr>
<td bgcolor="#B2B2B2" align="center">Sa oled sisse logitud kasutajana : <?php echo $_SESSION['user_name']; ?></td>
<td bgcolor="darkred" width="100px" align="center"><a class="ajax-link" href="login.php?logout"><font color="white">Logi välja!</font></a></td>
<tr>
</table>
</div>
<!-- because people were asking: "login.php?logout" is just my simplified form of "index.php?logout=true" -->

