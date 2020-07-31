<?php

	require "app/Controller.php";
	$controller = new Controller();
	$controller->addInCart();
	$product = $controller->product();
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Product</title>
</head>
<body>
	<?php
	  include 'templates\header.php';
    ?>
	<div class="wrapper">
		<main class="product-view">
			<form class="product-container" action="product.php?id=<?= $product->getId(); ?>" method="POST">
			<input type="hidden" name='product_id' value="<?= $product->getId(); ?>">
				<div class="product-image">
					<img src="<?= $product->getImage(); ?>" alt="sunglasses">
				</div>
				<h2 class="product-name"><?= $product->getName(); ?></h2>
				<p class="product-discription"><?= $product->getDescription(); ?></p>
				<p class="product-price"><?= $product->getPrice(); ?>.00 $</p>
				<div class="product-container__bottom">
					<input class="btn" type="submit" value="Add to cart">
					<select class="select" name="color" required>
						<option value="">color</option>
						<?php foreach($product->getColors() as $color): ?>
							<option><?= $color ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</form>
			<?php if($controller->currentUser()->checkAuth()): ?>
			<a class="btn" href="edit.php?id=<?= $product->getId(); ?>" >EDIT PRODUCT</a>
			<?php endif; ?>
		</main>
	</div>

</body>
</html>