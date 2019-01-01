<?php

include('db.php');
$pdo = DBFactory::getDBO();

session_start();

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
        array_push($errors, "InValid Image URL");
    }

    if ($description == "") {
        array_push($errors, "Insert The Description, PLease");
    }


	if (sizeof($errors) == 0) {

		$stmt = $pdo->prepare('UPDATE `products` set  name = :name, subtitle = :subtitle, image = :image, description = :description WHERE id = :id');
		$stmt->execute(array(
            'id' => $_GET['id'],
			'name' => $name,
			'subtitle' => $subtitle,
			'image' => $image,
			'description' => $description
		));

		header("Location: admin.php");
    }
    else {
        $product = array(
            'id' => $_GET['id'],
			'name' => $name,
			'subtitle' => $subtitle,
			'image' => $image,
			'description' => $description
        );
    }
}
 else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
    $stmt->execute(array(
        'id' => $_GET['id']
    ));

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <?php include("include.php") ?>
</head>
<body>
    <?php include("./navbar.php") ?>
    <main class="add-product bg-light">
        <h2>EDIT PRODUCT</h2>
       <form method='post'>
       <?php include('error.php') ?>
        <input class="form-control" type="text" name="title" placeholder="Title" value="<?php echo $product['name'] ?>">
        <input class="form-control" type="text" name="subtitle" placeholder="Subtitle" value="<?php echo $product['subtitle'] ?>">
        <input class="form-control" type="text" name="image" placeholder="image url" value="<?php echo $product['image'] ?>">
        <textarea class="form-control" type="text" name="description" placeholder="Description"><?php echo $product['description'] ?></textarea>
        <button class="btn btn-dark">Submit</button>
       </form>
    </main>
</body>
</html>
