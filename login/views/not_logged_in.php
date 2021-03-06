<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
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
	padding:0;
}

#form
{	
	text-align:center;
	position: relative;
	padding-top: 20px;
	padding-bottom: 20px;
	width: 50%;
	margin-top: 20px;
	margin-left: auto;
	margin-right: auto;
	border: 5px solid black;
}
	</style>
</head>

<!-- login form box -->
<div id="form">

<h1>Account Login</h1><br>

<form method="post" action="login.php" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />

    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

    <input type="submit"  name="login" value="Log in" />

</form>
<br><br>Or...
<a class="ajax-link" href="register.php">Registreeri uus kasutaja</a>
</div>