<?php
include("classes/redis.php");
include("classes/links.php");

function notFound() {
//	header("HTTP/1.1 404 Not Found");
	echo file_get_contents('404.html');
	exit();
}

if (array_key_exists('q', $_GET) && $_GET['q'] != '') {
	$id = $_GET['q'];
	
	$link = new Links();
	
	$url = $link->get($id);
	
	if (!$url) {
		notFound();
	}

	header("HTTP/1.1 301 Moved Permanently");
	header('Location: ' . $url);
	exit();
}

notFound();