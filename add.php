<?php
include("classes/redis.php");
include("classes/links.php");

function returnJSON($mixed) {
	echo json_encode($mixed);
	exit();
}

function getBaseURL() {
	return 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/';
}

if (array_key_exists('url', $_POST) && $_POST['url'] != '') {
	$url = $_POST['url'];
	
	$link = new Links();
	
	$shortedLink = $link->add($url);
	
	$shortedLink = getBaseURL() . $shortedLink;

	$result = array(
		'status' => 'OK',
		'url' => $shortedLink
	);
	
	returnJSON($result);
}

$result = array('status' => 'ERR');
returnJSON($result);