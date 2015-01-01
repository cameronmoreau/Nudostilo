<?php require_once('php/core/init.php'); ?>

<?php
	if(Input::exists()) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'handle' => array(
				'required' => true,
				'unique'=> 'users',
				'limited_chars' => true,
				'min' => 3,
				'max' => 15
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 20
			),
			'email' => array(
				'required' => true,
				'email' => true,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6,
				'max' => 32
			),
			'password_confirm' => array(
				'required' => true,
				'same' => 'password'
			),
			'gender' => array(
				'required' => true
			),
			'birth_month' => array(
				'required' => true
			),
			'birth_day' => array(
				'required' => true
			),
			'birth_year' => array(
				'required' => true
			)
		));

		if($validation->passed()) {
			//register user
			if(Token::check(Input::get('token'))) {
				$user = new User();
				$salt = Hash::salt(32);
				$active_key = Hash::generateKey();
				try {
					$salt = Hash::salt(32);
					$user->create(array(
						'handle' => Input::get('handle'),
						'email' => Input::get('email'),
						'password' => Hash::make(Input::get('password'), $salt),
						'password_salt' => $salt,
						'active_key' => $active_key,
						'last_login_ip' => '0',
						'name' => Input::get('name'),
						'gender' => Input::get('gender'),
						'birthdate' => date('Y-m-d'),
						'created_at' => date('Y-m-d H:i:s')
					));
				} catch(Exception $e) {
					die($e->getMessage());
				}

				Session::flash('success', 'You registered successfully');
				Redirect::to('index.php');
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
			<h2 class="text-center">Register for Nudostilo</h2>
			<?php
				if(Input::exists()) {
					if(!$validation->passed()) {
						echo "<div class='alert alert-danger'><ul>";
						foreach($validation->errors() as $error) {
							echo '<li>'.$error.'</li>';
						}
						echo '</ul></div>';
					}
				}
			?>
			<form action="" method="post">
				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<div class="row form-group">
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Nickname" name="handle" autocomplete="off" value="<?php echo Input::old('handle') ?>">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Name" name="name" autocomplete="off" value="<?php echo Input::old('name') ?>">
					</div>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" name="email" autocomplete="off" value="<?php echo Input::old('email') ?>">
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="col-md-6">
						<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<label>Gender</label><br>
						<label class="radio-inline"><input type="radio" name="gender" value="M" <?php echo Input::radioOld('gender', 'M', true); ?>> Male</label> 
						<label class="radio-inline"><input type="radio" name="gender" value="F" <?php echo Input::radioOld('gender', 'F'); ?>> Female</label>
					</div>
					<div class="col-md-6 row">
						<label>Birthday</label><br>
						<div class="col-md-5">
							<select name="birth_month">
								<option value="0">Month</option>
								<?php
									foreach(cal_info(0)['months'] as $key => $month) {
										$s = ($key == Input::old('birth_month') ? ' selected' : '');
										echo "<option value={$key}{$s}>".$month."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<select name="birth_day">
								<option value="0">Day</option>
								<?php
									foreach(range(1, 31) as $key => $day) {
										$s = ($day == Input::old('birth_day') ? ' selected' : '');
										echo "<option value={$day}{$s}>".$day."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-4">
							<select name="birth_year">
							<option value="0">Year</option>
								<?php
									$year = date('Y');
									foreach(range($year, $year - 110) as $year) {
										$s = ($year == Input::old('birth_year') ? ' selected' : '');
										echo "<option value={$year}{$s}>".$year."</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Register" class="btn btn-success btn-block">
				</div>
			</form>
		</div>
	</div>
</body>
</html>