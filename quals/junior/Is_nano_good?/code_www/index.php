<?php
$page = $_GET["page"];
$type = $_GET["type"];
if (strpos($page, './../') !== false){
	header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
	die();
}

if (strpos($page, '..././') !== false){
	header("Location: http://leekspin.com/");
	die();
}

if (strpos($page, '%') !== false){
	header("Location: http://www.nyan.cat/");
	die();
}

if (strpos($page, 'fille') !== false){
	header("Location: https://www.youtube.com/watch?v=o1eHKf-dMwo");
	die();
}

if (strpos($page, '/etc/passwd') === 0) {
	header("Location: https://www.youtube.com/watch?v=djV11Xbc914");
	die();
}
# I wonder if I can bypass path traversal restriction by going back and forward within the directories....
if ($type == ""){
	echo file_get_contents($page.".php");
} else {
	#maybe we need something from the website 
	echo file_get_contents($page); 
}
?>