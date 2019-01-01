<?php

session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] == 0) {
	header("Location: index.php");    
}

include('db.php');
$pdo = DBFactory::getDBO();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['delete'] == 'true') {
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
		$stmt->execute(array(
            'id' => $_GET['id']
        ));

        header("Location: admin.php");
	}
	 else {
        $stmt = $pdo->query('SELECT * FROM products');
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<?php include("include.php") ?>
</head>
<body>
	<?php include("./navbar.php") ?>
	<main class="admin bg-light">
		<div class="admin-container">
			<div class="admin-header">
				<h2>Admin</h2>
				<a href='add.php' class="btn btn-primary">+ Add Product</a>
			</div>
			<?php
				foreach ($products as $prod) {
					echo "
						<div class='product-card'>
							<h2>${prod['name']}</h2>
							<h4>${prod['subtitle']}</h4>
							<div class='d-flex align-items-start'>
								<img src='${prod['image']}' alt=''>
								<p>${prod['description']}</p>
							</div>
							<div class='btn-container'>
								<a href='edit.php?id=${prod['id']}' class='btn btn-primary'>Edit</a>
								<a href='admin.php?delete=true&id=${prod['id']}'class='btn btn-danger'>  Delete </a>
							</div>
						</div>
					";
				}
			?>
		</div>
	</main>
</body>
</html>

