<?php 

session_start();

if(!isset($_SESSION['user'])) {
	header("Location: index.php");    
}

include('db.php');
$pdo = DBFactory::getDBO();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if(!isset($_GET['id'])) {
        header("Location: index.php");    
    }

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
    <title>Document</title>
    <?php include("include.php") ?>
</head>
<body>
    <?php include("./navbar.php") ?>
    <main class="product-hero bg-light">
        <h2><?php echo $product['name'] ?></h2>
        <h4><?php echo $product['subtitle'] ?></h4>
        <img src="<?php echo $product['image'] ?>"/>
        <p><?php echo $product['description'] ?></p>
    </main>
</body>
</html>