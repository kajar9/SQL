<?php
  require_once("config/db.php");
  require_once("classes/Login.php");
  $login = new Login();
if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
} else {
	include("views/account_not_logged_in.php");
	return 0;
}
  
  
  function upload_my_file($fileid) {
  echo "File upload started...<br>";
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $imageFileType = strtolower($imageFileType);
  $imagefilename = pathinfo($target_file)['filename'];
  $saved_file = $target_dir . $fileid . "." . $imageFileType;
  $comment="";
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          echo "File is not an image.<br>";
          $uploadOk = 0;
		  return 0;
      }
	  if(isset($_POST["comment"])){
		$comment=$_POST["comment"];
	  }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.<br>";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "Sorry, your file is too large.<br>";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
      $uploadOk = 0;
  }
  // SQL
	if ($uploadOk == 1) {
    $db_connection = null;
	$errors = array();
	$messages = array();
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$sql = "INSERT INTO `131034_photos` (`name`, `description`, `suffix`, `filename`, `owner`)\n"
    . "VALUES (\"". $imagefilename. "\",\"". $comment. "\",\"". $imageFileType. "\",\"". $fileid. "\",\"". $_SESSION['user_name']. "\")";
	if (!$db_connection->set_charset("utf8")) {
                $errors[] = $db_connection->error;
				$uploadOk = 0;
				echo "Sorry, something went wrong with SQL connection.<br>";
    }
	if (!$db_connection->connect_errno) {
		$locresult = $db_connection->query($sql);
	}else{
		$uploadOk = 0;
		echo "Sorry, something went wrong with SQL connection.<br>";
	}}
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file(
           $_FILES["fileToUpload"]["tmp_name"], $saved_file)) {
          echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
      } else {
          echo "<p>Sorry, there was an error uploading your file.<br>";
      }
  }
}

function randString()
{
	$length=12;
    $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}
echo "<div align=\"center\">";
upload_my_file(randString());
echo "</div>";
include("upload.html");
?>