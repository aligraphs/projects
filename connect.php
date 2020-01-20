<?php
    function myconnect(){
	$host = 'dragon.ukc.ac.uk';
	$dbname = 'au62';
	$user = 'au62';
	$pwd = 'ax1omid';
   
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($conn) {
            return $conn;
			// here goes some other code that uses $conn ...
			//$conn = null; //(Uncomment to kill the connection)
		} else {
			echo 'Failed to connect';
		}
	} catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}
    }
?>
