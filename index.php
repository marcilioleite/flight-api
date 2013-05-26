<?php
	require 'flight/Flight.php';
	Flight::route('/', function(){
    	echo 'hello world!';
	}); 
	Flight::route('/user/@name', function($name){
    	echo "Ola, $name";
	}); 
	Flight::start();
?>