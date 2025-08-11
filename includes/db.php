<?php
class dbconn {
    public function connect() {

    	$host = 'localhost';
    	$dbName = 'immersive-flipbook_db';
    	$user = 'root';
    	$pass = '';

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}


?>

