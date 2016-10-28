<?php 
	include('./FCM_Helper.php');
	
	$msg[
		'title' => '', // title of push 
		'subtitle' => '',  // Subtitle of push
		'user' => '',  // Key of especific user
	];

echo ((new FCM())->sendToUser($msg));
