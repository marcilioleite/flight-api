<?php
require 'libs/flight/Flight.php';

// Root rooute
Flight::route('/', 
	function(){
		Flight::render("home.php", array('date' => date('d-m-Y')));
	}
);

Flight::route('/plays/reset/@user',
	function($user){
		session_start();
		unset($_SESSION[$user]);
		session_commit();
	}
);

Flight::route('POST /plays/?$',
	function(){
		$data = Flight::request()->data;
		$user = $data['user'];
		$play = $data['play'];
		session_start();
		if (!isset($_SESSION[$user]))
			$_SESSION[$user] = array('readtime' => 0, 'plays' => array());
		$play = array('t' => time(), 'play' => $play);
		array_push($_SESSION[$user]['plays'], $play);
		session_commit();
	}
);

Flight::route('/plays/@user', 
	function($user){
		session_start();
		if (isset($_SESSION[$user])){
			$plays = $_SESSION[$user]['plays'];
			$newPlays = array();
			foreach ($plays as $play){
				if ($play['t'] > $_SESSION[$user]['readtime'])
					array_push($newPlays, $play);
			}
			$_SESSION[$user]['readtime'] = time();
		    echo json_encode($newPlays);
		} 
		else{
			Flight::notFound();	
		}
		session_commit();
	}
);

Flight::start();
?>