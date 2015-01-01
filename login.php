<?php require_once('php/core/init.php'); ?>
<?php
	$login = new User();
	if($login->isLoggedIn()) {
		Redirect::to('index.php');
	}
?>

<?php
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'email' => array(
					'required' => true
				),
				'password' => array(
					'required' => true
				)
			));

			if($validation->passed()) {
				$user = new User();
				$login = $user->login(Input::get('email'), Input::get('password'));

				if($login) {
					echo 'You good';
				}
			} else {
				print_r($validation->errors());
			}
		}
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
			<form action="login.php" method="POST">
				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email or Handle" name="email" value="<?php echo Input::old('email'); ?>">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
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