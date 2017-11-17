<?php

session_start();
$need_to_solve = 50;

$flag          = 'DCTF{' .hash('sha256','i-hate-weak-captchas').  '}';
$sounds_path   = '../sounds/';

if(!isset($_SESSION['started_at'])) {
	$_SESSION['started_at'] = 0;	
}

if(!isset($_SESSION['solved'])) {
	$_SESSION['solved']     = 0;
}

if(isset($_GET['audio'])) {

	$response = json_decode(trim(exec('python '.$sounds_path.'/captcha.py')), TRUE);
	//var_dump($response);
    //setcookie('answer',$response[1]);
	header('Content-Description: File Transfer');
    header("Content-Transfer-Encoding: binary"); 
    header('Content-Type: audio/x-wav, audio/wav');
    header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
	header("Pragma: no-cache"); //HTTP 1.0
  	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

  	readfile($sounds_path. $response[0]);
	$_SESSION['audio_answer'] = $response[1];
	
	unlink($sounds_path. $response[0]);
	die();
} 
?>
<html>
<head><title>Audio Captcha Breaking Skils</title></head>
<body>
<?php

if(isset($_GET['audio_answer']) && is_string($_GET['audio_answer']) && $_SESSION['audio_answer'] != null) {
	if($_GET['audio_answer'] != $_SESSION['audio_answer']) {
		$_SESSION['started_at']   = 0;
		$_SESSION['solved']       = 0;
		$_SESSION['audio_answer'] = null;

		die('Invalid answer.');
	}

	if($_SESSION['started_at'] && time()-$_SESSION['started_at'] >= 120) {
		$_SESSION['started_at']   = 0;
		$_SESSION['solved']       = 0;
		$_SESSION['audio_answer'] = null;

		die('Time expired.');	
	}


	$_SESSION['solved'] += 1;
	$_SESSION['audio_answer'] = null;
	if(!$_SESSION['started_at']) {
		$_SESSION['started_at'] = time();
	}
}

if($_SESSION['solved'] === $need_to_solve) {
	echo $flag;
}
?>

<h4>Hi there. I know you have awesome skills for breacking image based captcha, but are you strong enought to do the same for audio? Show us your skills.</h4>

<form method="get">
	Audio:
	<audio src="index.php?audio" controls>
	Your browser does not support the audio element.
	</audio><br>
	 <input type="text" value="" name="audio_answer"></input>
	<input type="submit" value="Send">

	<h4>So far:</h4>
	<ul>
		<li>Solved: <?=$_SESSION['solved']?></li>
		<li>Started At: <?=$_SESSION['started_at']?gmdate('M d Y H:i:s', $_SESSION['started_at']) :'Not Started'?></li>
		<li>Time Remainings: <?=$_SESSION['started_at']? 120-(time()-$_SESSION['started_at']) :'Not Started'?></li>
	</ul>
</form>
</body>
</html>