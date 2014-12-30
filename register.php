<?php require_once('php/core/init.php'); ?>

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
			<form>
				<div class="row form-group">
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="First name">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Last name">
					</div>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email">
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<input type="password" class="form-control" placeholder="Password">
					</div>
					<div class="col-md-6">
						<input type="password" class="form-control" placeholder="Confirm Password">
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
						<div class="col-md-4">
							<select>
								<option>Month</option>
							</select>
						</div>
						<div class="col-md-4">
							<select>
								<option>Day</option>
							</select>
						</div>
						<div class="col-md-4">
							<select>
								<option>Year</option>
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