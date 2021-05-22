<?php include('functions.php') ?>
<!DOCTYPE html>
//login
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
	<title>Login</title>
	<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
	<link rel="stylesheet" type="text/css" href="css/webstyle.css">
	<link rel="stylesheet" type="text/css" href="uacss/bg.css">
</head>
<body>
	<div class="header">
			<h1>
				<i class="ace-icon fa fa-book green"></i>
						<span>Archive Books</span>
			</h1>
		<h4>&copy; Online Library Inc.</h4>
	</div>
	
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>


</body>
</html>