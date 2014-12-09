<?php

function connect($sql)
{
	$db_connection = null;
	$errors = array();
	$messages = array();
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!$db_connection->set_charset("utf8")) {
                $errors[] = $db_connection->error;
    }
	if (!$db_connection->connect_errno) {
		$locresult = $db_connection->query($sql);
	}	
	return $locresult;	
}

function ImageCount()
{
	$sql = "SELECT *
            FROM `131034_photos`
            WHERE `owner` = " . "'" . $_SESSION['user_name'] . "'" . ";";
	$locresult = connect($sql);
	$numrows = $locresult->num_rows;
	return $numrows;	
}

function getRating($photo_id)
{
	$sql = "SELECT `rating`
        FROM `131034_ratings`
		WHERE `photo_id` = \"" . $photo_id . "\";";
	$locresult = connect($sql);
	
	$rating = 0.0; $i=0;
	while($locres=$locresult->fetch_object()){
		$rating+=$locres->rating;
		$i++;
	}
	if($rating>0){$rating=$rating/$i;}
	
	return $rating;
}

function getMyRating($photo_id)
{
	if (isset($_SESSION['user_login_status'])){
		$sql = "SELECT `rating`
        FROM `131034_ratings`
		WHERE `photo_id` = \"" . $photo_id . "\" AND `user_id` = " . $_SESSION['user_id'];
	$rating=0;
	$locresult = connect($sql);
		while($locres=$locresult->fetch_object()){
		$rating=$locres->rating;
		}
	return $rating;
	}
	return 0;
}

function CommentCount($photo_id)
{
	$sql = "SELECT *
            FROM `131034_comments`
            WHERE `photo_id` = \"" . $photo_id . "\";";
	$locresult = connect($sql);
	$numrows = $locresult->num_rows;
	return $numrows;
}

function UpdatePhotoRating(){
	$sql1 = "SELECT *
            FROM `131034_photos`;";
	$locresult5 = connect($sql1);
	while($locres5=$locresult5->fetch_object()){
		$photoid5=$locres5->id;
		$rating5=getRating($photoid5);
			$sql2 = "UPDATE 131034_photos
					SET `rating`= \"" . $rating5 . "\"
					WHERE `id` = \"" . $photoid5 . "\";";
					connect($sql2);
	}
}

function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }

?>