<?php
	require "app/Controller.php";
	$controller = new Controller();
	$products = $controller->index();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Shop</title>
</head>
<body>
    <?php
	  include 'templates\header.php';
    ?>
	<div class="wrapper">
		<main class="list">
            <?php foreach($products as $product): ?>
			<a href="product.php?id=<?= $product->getId(); ?>" class="card">
				<div class="card-image">
					<img src="<?= $product->getImage(); ?>" alt="sunglasses">
				</div>
				<h2 class="product-name"><?= $product->getName(); ?></h2>
				<p class="product-price"><?= $product->getPrice(); ?>.00 $</p>
			</a>
            <?php endforeach; ?>
		</main>
		
	</div>

</body>
</html>