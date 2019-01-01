<?php
include('db.php');
$pdo = DBFactory::getDBO();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
<?php include("include.php") ?>
</head>
<body>
<?php include("./navbar.php") ?>
<div class="position-relative overflow-hidden p-3 p-md-3 text-center hero iphoner">
  <div class="col-md-5 p-lg-5 mx-auto text-light" id="mu3">
    <h1 class="display-4 font-weight-normal">MU3 STORE</h1>
    <p class="lead font-weight-normal">WE ARE AGENTS FOR APPLE IN EGYPT. WE ARE NOT THE ONLY ONES BUT WE ARE THE DISTINCT ONE.</p>
    <a class="btn btn-outline-secondary" href="#">Coming soon</a>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<div class="position-relative overflow-hidden p-3 p-md-3 text-center hero iphones">
  <div class="col-md-5 p-lg-5 mx-auto text-light">
    <h1 class="display-4 font-weight-normal">iPHONE X</h1>
    <p class="lead font-weight-normal">LARGEST SUPER RETINA DISPLAY. FASTEST PERFORMANCE WITH A12 BIONIC. MOST SECURITY WITH FACE-ID</p>
    <a class="btn btn-outline-secondary" href="#">Coming soon</a>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 product-row">
  <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center product overflow-hidden">
    <div class="my-3 py-3">
      <h2 class="display-5">iPAD PRO</h2>
      <p class="lead">ALL NEW. ALL SCREEN. ALL POWERFUL</p>
    </div>
	<img src="./images/ipad-pro.jpg" alt="">
  </div>
  <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center product overflow-hidden">
    <div class="my-3 p-3">
      <h2 class="display-5">MACBOOK AIR</h2>
      <p class="lead">LIGHTNESS STRIKES AGAIN.</p>
    </div>
    <img src="./images/macbook-air.jpg" alt="">
  </div>
</div>
<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 product-row">
  <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center product mini text-white overflow-hidden">
    <div class="my-3 py-3">
      <h2 class="display-5">MAC MINI</h2>
      <p class="lead">RE-ENGINEERED IN NO SMALL WAY.</p>
    </div>
  </div>
  <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center product overflow-hidden">
    <div class="my-3 p-3">
      <h2 class="display-5">AIR PODS</h2>
      <p class="lead">WIRELESS. EFFORTLESS. MAGICAL</p>
    </div>
	<img src="./images/airpod.jpg" alt="">
  </div>
</div>

<div class="end">
<P>ALL COPY RIGHTS &copy; ARE RESERVED FOR MR.MO3 TEAM &reg; </P>
</div>

</body>
</html>