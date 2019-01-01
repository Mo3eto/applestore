<?php

include('db.php');
$pdo = DBFactory::getDBO();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['title'];
	$message = $_POST['message'];

	$errors = [];
	
	if ($name == "") {
		array_push($errors, "Insert The Title, PLease");
	}

    if ($message == "") {
        array_push($errors, "Insert YoUr Message, PLease");
    }


	if (sizeof($errors) == 0) {

		$stmt = $pdo->prepare('INSERT INTO `contactus` (`name`, `message`) VALUES (:name, :message)');
		$stmt->execute(array(
			'name' => $name,
            'message' => $message
		));

		header("Location: index.php");
	}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include("include.php") ?>
</head>
<body>
    <?php include("./navbar.php") ?>
    <main class="contact bg-light">
        <h2>Contact Us</h2>
       <form method='post'>
       <?php include('error.php') ?>
            <input class="form-control" type="text" name="title" placeholder="Title">
        <textarea class="form-control" type="text" name="message" placeholder="Message"></textarea>
        <button class="btn btn-dark submit">Submit</button>
       </form>
    </main>
</body>
</html>