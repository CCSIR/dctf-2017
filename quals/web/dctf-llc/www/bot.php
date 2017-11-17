<html>
<head>
<script src='jquery.js.min'></script>
</head>
<body>
<?php

include('config.php');

if (!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', '10.13.37.12'])) {
	die();
}

if(isset($_GET['id'])) {
	$q = $db->query('SELECT * FROM messages where id="'.$db->real_escape_string($_GET['id']).'"');
	
	if(!$q->num_rows) {
		die('invalid id');
	}
	$row = $q->fetch_array();
	if($row['read']) {
		die('already seen');
	}

	echo "

<a href='admin.php'>Dashboard</a>
<div align='center'><h4>Message Sent. Here's the preview:</h4>
	<div>
	Name: ".$row['name']."<br>
	Email: ".$row['email']."<br>
	Message: ".$row['message']."<br>
	<img src='".$row['file']."'>
	</div>
</div>
";

	$db->query('UPDATE messages set `read` = 1 where id="'.$db->real_escape_string($_GET['id']).'"');
	//echo $db->error;
	die();	
}

$q = $db->query('SELECT * FROM `messages` WHERE `read`=0');
while($row = $q->fetch_array()) {
	echo '<a href="'.$root_url.'/bot.php?id='.$row['id'].'">Read message '.$row['id'].'</a>';
}?>
</body></html>