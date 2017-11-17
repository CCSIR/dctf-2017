<?php

if(!isset($_GET['image'])) {
	die();
}
$file = realpath('file-secure-1274812412/'.$_GET['image']);
if(stripos($file, 'file-secure-1274812412/') === FALSE) {
	die('Do not cheat.');
}

if(file_exists($file)) {
	if(preg_match('/^.+\.(js)/', $file)) {
		header('Content-Type: text/javascript');
	} elseif(preg_match('/^.+\.(jpg|jpeg|gif|png|ico|swf)/', $file)) {
		header('Content-Type: '.mime_content_type($file));
	} 
	readfile($file);	
}
