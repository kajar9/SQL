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

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}






if(isset($_GET["photo_id"])){
if($_SESSION['user_name']=="string"){}
echo "<script>function myFunction(){var x;if (confirm(\"Press a button!\") == true) {
    <?php deletephoto($photo_id); ?>
    } else {
    <?php return 0; ?>    
    }
}
</script>";

function deletephoto($photo_id){
	echo $_GET["photo_id"];
}
}
	