<?php

	try{

		$db = new PDO("mysql:host=localhost;dbname=seyahate_sistem;charset=utf8", 'seyahate_sistem', 'talha2019');

		// echo 'Başarılı';

	} catch (PDOException $e) {

		echo $e->getMessage();

	}

?>
