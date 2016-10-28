<?php 
	include('./FCM_Helper.php');
	
	$msg[
		'title' => '', // title of push 
		'body' => '',  // Body of push
		'user' => '',  // Key of especific user
	];

echo ((new FCM())->sendToUser($msg));
