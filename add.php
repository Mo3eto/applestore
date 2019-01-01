<?php

session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] == 0) {
	header("Location: index.php");    
}

include('db.php');
$pdo = DBFactory::getDBO();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$image = $_POST['image'];
	$description = $_POST['description'];

	$errors = [];
	
	if ($name == "") {
		array_push($errors, "Insert The Title, PLease");
	}

    if ($subtitle == "") {
        array_push($errors, "Insert The Subtitle, PLease");
    }

    if ($image == "") {
        array_push($errors, "Insert The Image URL, PLease");
    } else if (!filter_var($image, FILTER_VALIDATE_URL)) {
        array_push($errors, "InValid Image URL ");
    }

    if ($description == "") {
        array_push($errors, "Insert The Description, PLease");
    }


	if (sizeof($errors) == 0) {

		$stmt = $pdo->prepare('INSERT INTO `products` (`name`, `subtitle`, `image`, `description`) VALUES (:name, :subtitle, :image, :description)');
		$stmt->execute(array(
			'name' => $name,
			'subtitle' => $subtitle,
			'image' => $image,
			'description' => $description
		));

		header("Location: admin.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <?php include("include.php") ?>
</head>
<body>
    <?php include("./navbar.php") ?>
    <main class="add-product bg-light">
        <h2>ADD PRODUCT</h2>
       <form method='post'>
       <?php include('error.php') ?>
        <input class="form-control" type="text" name="title" placeholder="Title">
        <input class="form-control" type="text" name="subtitle" placeholder="Subtitle">
        <input class="form-control" type="text" name="image" placeholder="image url">
        <textarea class="form-control" type="text" name="description" placeholder="Description"></textarea>
        <button class="btn btn-dark">Submit</button>
       </form>
    </main>
</body>
</html>
