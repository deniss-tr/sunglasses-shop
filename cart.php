<?php
	require "app/Controller.php";
	$controller = new Controller();
	$connector = new Connector();
	$cart = $controller->getCart();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Cart</title>
</head>
<body>
	<?php
      include 'templates\header.php';
    ?>
	<div class="wrapper">
		<main class="table">
			<form action="checkout.php">
				<table class="table-list">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Price</th>
							<th>Color</th>
							<th>Quantity</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($cart as $item):
						$nr += 1;
						$product = $connector->getProduct($item['productId']);
					?>
						<tr class="product-row" product_nr="<?= $nr ?>">
							<td><?= $nr ?></td>
							<td><?= $product->getName() ?></td>
							<td><span class="item-price"><?= $product->getPrice() ?></span>.00 $</td>
							<td><?= $item['color'] ?></td>
							<td>
								<button class="table-btn q plus">+</button> 
								<input type="number" class="item_count" value="1" min="1" max="10" readonly> 
								<button class="table-btn q minus">-</button>
							</td>
							<td><button class="table-btn del"><i class="fas fa-trash-alt"></i></button></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<div class="total-block">
				<h3>TOTAL PRICE:</h3>
				<p><span class="total">0</span>.00 $</p>
			</div>
			<input type="submit" class="btn checkout-btn" value="CHECKOUT">
			</form>
		</main>
	</div>
	<script src="js/cart.js"></script>
</body>
</html>