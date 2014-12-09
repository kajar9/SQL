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

<h1>Image Search</h1>

<form method="post" action="search.php" name="searchform">
	Otsi kasutajanime ja/või pildinime järgi!<br>
    <label for="search_user_input">Kasutajanimi</label>
    <input id="search_user_input" type="text" name="search_user" />

    <label for="search_imgname_input">Pildinimi</label>
    <input id="search_imgname_input" type="text" name="search_imgname" />
<br><br>
    <input type="submit"  name="search" value="Search" />

</form>
</div>