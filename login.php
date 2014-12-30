<?php require_once('php/core/init.php'); ?>

<?php 

	$users = DB::getInstance()->query("SELECT * FROM users");
	if($users->error()) {
		echo 'no users';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once('views/sections/head.php'); ?>
    <title>Nudostilo</title>
</head>
<body>
	<div class="container">
		<div class="col-md-6 col-md-offset-3 login-box">
			<h2 class="text-center">Login to Nudostilo</h2>
			<form>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password">
				</div>
				<input type="submit" value="Login" class="btn btn-success btn-block">
				<div class="row">
					<div class="col-md-6">
						<a href="register.php">Create an account</a>
					</div>
					<div class="col-md-6 text-right">
						<a href="#">Forgot password?</a>
					</div>
				</div>
			</form>
			<h3 class="text-center">or connect with</h3>
			<div class="form-group row">
				<div class="col-md-6">
					<a href="#" class="btn btn-block btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
				</div>
				<div class="col-md-6">
					<a href="#" class="btn btn-block btn-danger"><i class="fa fa-google"></i> Google+</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>