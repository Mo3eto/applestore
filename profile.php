<?php 
session_start();
include('db.php');
$pdo = DBFactory::getDBO();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['delete'] == 'true') {
        $stmt = $pdo->prepare('DELETE FROM user WHERE id = :id');
		$stmt->execute(array(
            'id' => $_SESSION['user']['id']
        ));

        $_SESSION = array();
        session_destroy();

        header("Location: register.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	$errors = [];
    
    if ($username != $_SESSION['user']['username']) {

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
    }

    
    if ($email != $_SESSION['user']['email']) {
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
    }

    if ($password != $_SESSION['user']['password']) {   
        if ($password == "") {
            array_push($errors, "Insert The Password, PLease");
        }
        
        if ($confirmPassword == "") {
            array_push($errors, "Confirm YoUr Password, PLease");
        }
        
        if ($password != "" && $confirmPassword != "" && $password != $confirmPassword) {
            array_push($errors, "Passwords Don’t Match");
        }
    }
        
	if (sizeof($errors) == 0) {

        $stmt = $pdo->prepare('UPDATE user SET username = :username, email = :email, `password` = :password, isAdmin = :isAdmin WHERE id = :id');
		$stmt->execute(array(
            'id' => $_SESSION['user']['id'],
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'isAdmin' => $_SESSION['user']['isAdmin']
        ));

        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['password'] = $password;
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>






</head>
<body>
<div class="header">
	<h2>Profile</h2>
</div>
<form method="post">
<?php include('error.php') ?>

		<div class="input-group">
		<label>USERNAME</label>
		<input type="text" name="username" value="<?php echo $_SESSION['user']['username']; ?>">
	</div>

	<div class="input-group">
		<label>E-MAIL</label>
		<input type="email" name="email"  value="<?php echo $_SESSION['user']['email']; ?>">
	</div>

	<div class="input-group">
		<label>PASSWORD</label>
		<input type="password" name="password" value="<?php echo $_SESSION['user']['password']; ?>">
	</div>

	<div class="input-group">
		<label>CONFIRM PASSWORD</label>
		<input type="password" name="confirmPassword" value="<?php echo $_SESSION['user']['password']; ?>">
	</div>

	<div class="input-group">
		<button type="submit" name="register" class="btn">REGISTER</button> 
	</div>

    <p>
		Sign Out → <a href="signout.php">Here</a>
	</p>

    <p>
		Delete Account → <a href="profile.php?delete=true">Here</a>
	</p>
</form>


</body>
</html>