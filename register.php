<?php require_once('php/core/init.php'); ?>

<?php

	if(Input::exists()) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'first_name' => array(
				'required' => true,
				'min' => 2,
				'max' => 20
			),
			'last_name' => array(
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
			echo 'all that data passed';
		} else {
			echo '<pre>';
			print_r($validation->errors());
			echo '</pre>';
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
			<form action="" method="post">
				<div class="row form-group">
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="First name" name="first_name" autocomplete="off" value="<?php echo Input::old('first_name') ?>">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Last name" name="last_name" autocomplete="off" value="<?php echo Input::old('last_name') ?>">
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
						<label class="radio-inline"><input type="radio" name="gender" value="M"> Male</label> 
						<label class="radio-inline"><input type="radio" name="gender" value="F"> Female</label>
					</div>
					<div class="col-md-6 row">
						<label>Birthday</label><br>
						<div class="col-md-5">
							<select name="birth_month">
								<option value="0">Month</option>
								<?php
									foreach(cal_info(0)['months'] as $key => $month) {
										echo "<option value={$key}>".$month."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<select name="birth_day">
								<option value="0">Day</option>
								<?php
									foreach(range(1, 31) as $key => $day) {
										echo "<option value={$key}>".$day."</option>";
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
										echo "<option value={$year}>".$year."</option>";
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