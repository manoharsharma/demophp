<?php
	try{	
	$connect = new PDO("mysql:host=localhost;dbname=product","root","");
	
	}
	catch(PDOException $e){
		echo "connection failed".$e->getmessage();
	}

?>