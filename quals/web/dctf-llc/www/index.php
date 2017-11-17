<?php
	include_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>DCTF LLC</title>
	<script src="jquery.js.min"></script>
	<style>
		@import url(https://fonts.googleapis.com/css?family=Merriweather);
		*,
		*:before,
		*:after {
		  -moz-box-sizing: border-box;
		  -webkit-box-sizing: border-box;
		  box-sizing: border-box;
		}

		html, body {
		  background: #f1f1f1;
		  font-family: 'Merriweather', sans-serif;
		  padding: 1em;
		}

		h1 {
		  text-align: center;
		  color: #a8a8a8;
		  text-shadow: 1px 1px 0 white;
		}

		form {
		  max-width: 600px;
		  text-align: center;
		  margin: 20px auto;
		}
		form input, form textarea {
		  border: 0;
		  outline: 0;
		  padding: 1em;
		  -moz-border-radius: 8px;
		  -webkit-border-radius: 8px;
		  border-radius: 8px;
		  display: block;
		  width: 100%;
		  margin-top: 1em;
		  font-family: 'Merriweather', sans-serif;
		  -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		  resize: none;
		}
		form input:focus, form textarea:focus {
		  -moz-box-shadow: 0 0px 2px #e74c3c !important;
		  -webkit-box-shadow: 0 0px 2px #e74c3c !important;
		  box-shadow: 0 0px 2px #e74c3c !important;
		}
		form #input-submit {
		  color: white;
		  background: #e74c3c;
		  cursor: pointer;
		}
		form #input-submit:hover {
		  -moz-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
		  -webkit-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
		  box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
		}
		form textarea {
		  height: 126px;
		}

		.half {
		  float: left;
		  width: 48%;
		  margin-bottom: 1em;
		}

		.right {
		  width: 50%;
		}

		.left {
		  margin-right: 2%;
		}

		@media (max-width: 480px) {
		  .half {
		    width: 100%;
		    float: none;
		    margin-bottom: 0;
		  }
		}
		/* Clearfix */
		.cf:before,
		.cf:after {
		  content: " ";
		  /* 1 */
		  display: table;
		  /* 2 */
		}

		.cf:after {
		  clear: both;
		}

		h3 {
			color:#ccc;
		}
	</style>
</head>
<body>
	<h1>DCTF LLC</h1>
	<div align="center"><h3>Our website is work in progress but you could send us some of your wishes! </h3></div>
	<?php
	if(isset($_POST) && sizeof($_POST)) {
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			die("Invalid email.");
		}

		$file = '';
		if(sizeof($_FILES['file']) && !$_FILES['file']['error']) {
			$target_dir    = $file_dir.'/';
			$random_dir    = '__'.bin2hex(random_bytes(16)).'/';
			$basefile 	   = basename($_FILES["file"]["name"]);
			$target_file   = $target_dir . $random_dir. $basefile;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
			}

			if(getimagesize($_FILES["file"]["tmp_name"]) === false) {
				die('Invalid image size.');
			}

			if ($_FILES["file"]["size"] > 500) {
				die('File too large. This must be less than 500 bytes.');
			}

			@mkdir($target_dir.$random_dir);
			if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				die('Could not upload the image.');
			}

			$file = $random_dir.$basefile;
		}

		$db->query('INSERT INTO `messages` (name, email, message,ip, file) VALUES ("'.$db->real_escape_string($_POST['name']).'", "'.$db->real_escape_string($_POST['email']).'", "'.$db->real_escape_string($_POST['message']).'","'.$_SERVER['REMOTE_ADDR'].'","'.$file.'") ');

		echo "<div align='center'><h4>Message Sent. Here's the preview:</h4>
		<div>
		Name: ".$_POST['name']."<br>
		Email: ".$_POST['email']."<br>
		Message: ".$_POST['message']."<br>
		<img src='".$file."'>
		</div></div>";
	}
	?>
	<form class="cf" method="POST" enctype="multipart/form-data">
	  <div class="half left cf">
	    <input type="text" id="name" name="name" placeholder="Name">
	    <input type="email" id="email" name="email" placeholder="Email address">
	    <input type="file" id="file" name="file" placeholder="Upload Attachments">
	  </div>
	  <div class="half right cf">
	    <textarea name="message" type="text" id="message" name="message" placeholder="Message"></textarea>
	  </div>  
	  <input type="submit" value="Submit" id="input-submit">
	</form>
</body>
</html>