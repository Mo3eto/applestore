<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include('db.php');
	$pdo = DBFactory::getDBO();


	$username = $_POST['username'];
	$password = $_POST['password'];

	$errors = [];
	
	if ($username == "") {
		array_push($errors, "Insert The UserName, PLease");
	}

	if ($password == "") {
		array_push($errors, "Insert The Password, PLease");
	}

	if (sizeof($errors) == 0) {

		$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
		$stmt->execute([$username]);
		$count = $stmt->rowCount();

		if ($count == 1) {

			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($user['password'] != $password) {
				array_push($errors, "Password Is Not Correct");				
			}
			
		}

		 else {
			array_push($errors, "Wrong UserName/Password Combination");
		}
		
		
	}

	if (sizeof($errors) == 0) {
		$_SESSION['user'] = $user;
		header("Location: index.php");
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
	<main class="logForm">
		<div class="header">
			<img class="black-logo" src="./images/apple-logo-black.svg"/>
			<h2>LOGIN</h2>
		</div>

		<form method="post">
		<?php include('error.php') ?>

			<div class="input-group">
				<label>Username: </label>
				<input class="form-control" type="text" name="username">
		
			</div>

			<div class="input-group">
				<label>Password: </label>
				<input class="form-control" type="password" name="password">
			</div>


			<button type="submit" name="login" class="btn btn-dark">LOGIN</button> 

			<p> 
				Not yet a member → <a href="register.php">SIGN UP</a>
			</p>
		</form>
	</main>


</body>
</html>

