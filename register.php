<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include('db.php');
	$pdo = DBFactory::getDBO();
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	$errors = [];
	
	if ($username == "") {
		array_push($errors, "Insert The UserName, PLease");
	} else {
		$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
		$stmt->execute([$username]);
		$count = $stmt->rowCount();

		if ($count > 0) {
			array_push($errors, "UserName Is Already Taken");
		}
	}

	if ($email == "") {
		array_push($errors, "Insert The E-Mail, PLease");
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($errors, "Wrong Formula For E-Mail");
	} else {
		$stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
		$stmt->execute([$email]);
		$count = $stmt->rowCount();

		if ($count > 0) {
			array_push($errors, "E-Mail Is Already Taken");
		}
	}

	if ($password == "") {
		array_push($errors, "Insert The Password, PLease");
	}

	if ($confirmPassword == "") {
		array_push($errors, "Confirm Your Password, Please");
	}

	if ($password != "" && $confirmPassword != "" && $password != $confirmPassword) {
		array_push($errors, "Passwords don't Match");
	}

	if (sizeof($errors) == 0) {

		$stmt = $pdo->prepare('INSERT INTO `user` (`username`, `email`, `password`, `isAdmin`) VALUES (:username, :email, :password, :isAdmin)');
		$stmt->execute(array(
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'isAdmin' => 0
		));

		header("Location: login.php");

	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration System</title>
	<?php include("include.php") ?>
</head>
<body>
<div class="logForm">
	<div class="header">
		<img class="black-logo" src="./images/apple-logo-black.svg"/>
		<h2>REGISTER</h2>
	</div>
	<form method="post">
	<?php include('error.php') ?>
		<div class="input-group">
			<label>USERNAME</label>
			<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
				</div>

		<div class="input-group">
			<label>E-MAIL</label>
			<input class="form-control" type="email" name="email"  value="<?php echo $email; ?>">
		</div>

		<div class="input-group">
			<label>PASSWORD</label>
			<input class="form-control" type="password" name="password">
		</div>

		<div class="input-group">
			<label>CONFIRM PASSWORD</label>
			<input class="form-control" type="password" name="confirmPassword">
		</div>

		<div class="input-group">
			<button type="submit" name="register" class="btn btn-dark">REGISTER</button> 
		</div>

		<p> 
			Already a member → <a href="login.php">SIGN IN</a>
		</p>
	</form>
</div>


</body>
</html>