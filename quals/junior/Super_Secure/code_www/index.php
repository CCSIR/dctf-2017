
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Starter Template for Bootstrap</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Secure Secret Platform</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#about">About</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="starter-template">
				<h1>Please Log In</h1>
				<p class="lead">Use this platfrom to store your biggest secrets. </p>
				<form name="loginform" onSubmit="return validateForm();" action="secureifnotonline.html" method="post">
					<div class="container">

						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Username:</span>
							<!-- Oscar! this is how we will trick our attackers to only imput emails and how we will avoid future bruteforce!!!  -->

							<input type="email"  name="usr" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
						</div>
					</div>
					<br>
					<div class="container">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Password:</span>
							<input type="password"  name="pword" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
						</div>
					</div>
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
					<button type="submit" class="btn btn-default">Log in</button>
				</form>
			</div>
		</div>
	</div><!-- /.container -->
	<script>
		function validateForm() {
			var un = document.loginform.usr.value;
			var pw = document.loginform.pword.value;
			var username = "th1s1sn0tadmin3mail"; 
			var password = "averysafesecurepassword"; //also this is bruteforce tested!
			if ((un == username) && (pw == password)) {
				return true;
			}
			else {
				alert ("Login was unsuccessful, please check your username and password");
				return false;
			}
		}
	</script>
</body>
</html>