<?php
class dbconn {
    public function connect() {
        // localhost connection
    	// $host = 'localhost';
    	// $dbName = 'immersive-flipbook_db';
    	// $user = 'root';
    	// $pass = '';

        // server connection
        $host = 'sql110.infinityfree.com';
    	$dbName = 'if0_39680559_immersiveFlipbookDB';
    	$user = 'if0_39680559';
    	$pass = 'Dwdsl1105';

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

