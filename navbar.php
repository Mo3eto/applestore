<nav class="navbar position-fixed navbar-expand-lg navbar-light">
	<div class="navbar-container">
	<a class="navbar-brand  text-light" href="index.php">   <img class="logo" src="./images/apple-logo.svg">   </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php
        $stmt = $pdo->query('SELECT * FROM products');
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $prod) {
          echo "
            <li class='nav-item'>
              <a class='nav-link text-light' href='product.php?id=${prod['id']}'>    ${prod['name']}      </a>
            </li>
          ";
        }
      ?>
    </ul>
  </div>
	</div>
	<div class="navBtnContainer">
  <a href='contact.php' class='btn btn-dark'>Contact </a>

  <?php
  session_start();
  if (!isset($_SESSION['user'])) {
    echo "
      <a href='login.php' class='btn btn-dark'>sign in</a>
      <a href='register.php' class='btn btn-dark'>sign up</a>
    ";
  
}
  else {
    if($_SESSION['user']['isAdmin'])
    {
      echo "   <a href='admin.php' class='btn btn-dark'>Admin </a>";
    }
    echo "<a href='signout.php' class='btn btn-dark'>sign out</a>";

  }
  ?>
	</div>
</nav>

