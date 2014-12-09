<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<head>
	<style>
*
{
	margin:0;
}

#form
{	
	text-align:center;
	align: center;
	position: relative;
	padding-top: 20px;
	padding-bottom: 20px;
	width: 67%;
	margin-top: 20px;
	margin-left: auto;
	margin-right: auto;
	border: 5px solid black;
}
	</style>
</head>

<!-- register form -->
<div id="form">

<h1>Account registration</h1><br>

<form method="post" action="register.php" name="registerform">
<table width="100%" cellpadding="5" border="2">
<tr>
<td><label for="login_input_username">Username (Ainult tähed ja numbrid, 2 kuni 64 märki)</label></td>
<td><input id="login_input_username" class="login_input" type="text" size="45" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /></td>
</tr>
<tr>
<td><label for="login_input_email">Kasutaja Email</label></td>
<td><input id="login_input_email" class="login_input" type="email" size="45" name="user_email" required /></td>
</tr>
<tr>
<td><label for="login_input_password_new">Parool (min. 6 märki)</label></td>
<td><input id="login_input_password_new" class="login_input" size="45" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></td>
</tr>
<tr>
<td><label for="login_input_password_repeat">Korda parooli</label></td>
<td><input id="login_input_password_repeat" class="login_input" size="45" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></td>
</tr>
</table>
<br>
<input type="submit"  name="register" value="Register" />

</form>
<br>
<!-- backlink -->
<a class="ajax-link" href="login.php">Tagasi sisselogimise lehele!</a>
