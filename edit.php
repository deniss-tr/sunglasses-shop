<?php

	require "app/Controller.php";
	$controller = new Controller();
	$product = $controller->product();
	$controller->edit();
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Edit product</title>
</head>
<body>
	<?php
	  include 'templates\header.php';
    ?>
	<div class="wrapper">
		<main class="product-view">
			<form class="edit-container" action="edit.php?id=<?= $product->getId(); ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name='product_id' value="<?= $product->getId(); ?>">
			<textarea name="discription"><?= $product->getDescription(); ?></textarea>
			<label>Price in $</label>
			<input name="price" type="number" value=<?= $product->getPrice(); ?>>
			<input type="hidden" value="<?= $product->getImage(); ?>" name="oldImage">
			<input name="photo" type="file">
			<?php foreach($product->getColors() as $color): ?>
				<input type="text" name="colors[]" value="<?= $color ?>">
			<?php endforeach; ?>
			<div>
				<button id="add-color">Add color</button>
			</div>
			<input class="btn" type="submit" value="SAVE">
			</form>

		</main>
	</div>
	<script src="js/edit.js"></script>
</body>
</html>

