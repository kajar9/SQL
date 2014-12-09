<?php

/**
 * Class ImageSearch
 * handles the image search process
 */
 class ImageSearch
 {
	/**
     * @var object The database connection
     */
	private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();
	
	private $user_name = "'%%'";
		private $image_name = "'%%'";
	
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
	public function __construct()
    {
		// create/read session, absolutely necessary
        if(isset($_POST["search"])){
		$this->doImageSearch();
		}
		
		
	}
	
	private function doImageSearch()
    {
		// check for form data
		if (empty($_POST['search_user']) && empty($_POST['search_imgname'])) {
			echo "Viga! - Vähemalt üks otsinguväli peab täidetud olema!";
		} else {
			if(!empty($_POST['search_user'])){
			$user_name = "'%" . $_POST['search_user'] . "%'";} else {
			$user_name = "'%%'";}
			
			if(!empty($_POST['search_imgname'])){
			$image_name = "'%" . $_POST['search_imgname'] . "%'";} else {
			$image_name = "'%%'";}
			
			//echo $user_name . " " . $image_name . "<br><br>";
			// create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			
			// change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
			
				// database query
				$sql = "SELECT name, description, suffix, ts, filename, owner
                        FROM `131034_photos`
                        WHERE `name` LIKE " . $image_name . " AND `owner` LIKE " . $user_name . ";";
			
			//echo $sql . "<br><br>";
			$result = $this->db_connection->query($sql);
			$_SESSION['search_result'] = $result;
			$i=0;
			while($res = $result->fetch_object()){
			$i++;
			echo $i . ". " . $res->name  . " " . $res->filename . "." . $res->suffix . " " . " " . $res->ts . " " . $res->owner . " " . $res->description . ";<br>";
			}
			echo "<br>End of results";
			}
		}
	}
}
