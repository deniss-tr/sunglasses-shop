<?php

	require "app/Controller.php";
	$controller = new Controller();
	$arr = $controller->prepareCheckout();
	$all = $arr['items'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<script type="text/javascript" src="https://www.omniva.lv/widget/widget.js"> </script>
	<link rel="stylesheet" type="text/css" href="https://www.omniva.lv/widget/widget.css">
	<link rel="stylesheet" href="main.css" type="text/css">
	<title>Checkout</title>
</head>
<body>
	<?php
      include 'templates\header.php';
    ?>
	<div class="wrapper">
		<form class="checkout" method="POST" action="payment.php">
			<h1>Total</h1>
			<div class="product-list">
				<ul>
				<?php
					$sums = Array(); 
					foreach($all as $item): 
					$fullItemPrice = $item['product']->getPrice() * $item['count'];
					$sums[] = $fullItemPrice;
				?>
					<li>
						<span class="name"><?= $item['product']->getName() ?></span>
						<span class="color"><?= $item['color'] ?></span>
						<span class="price"><?= $item['product']->getPrice() ?>.00 $</span>
						<span> x </span>
						<span><?= $item['count'] ?></span>
						<span> = </span>
						<span><?= $fullItemPrice ?>.00 $</span>
					</li>
				<?php endforeach; 
					$total = array_sum($sums);
				?>
				</ul>
				<p class="total-price">Total price <span><?= $total ?>.00$</span></p>
			</div>

			<select class="select select-delivery" name="delivery" required>
				<option value="">Delivery method</option>
				<option>Office</option>
				<option>Omniva</option>

			</select>

			<div id="omniva_container1"></div>
			<p class="delivery-info">Select delivery method before checkout</p>
			<div class="delivery-office">
				<p>You can pick up your order at:</p>
				<p>Rīga, Rīgas iela 1 - 1</p>
			</div>
			<input type="hidden" name="order_id" value="<?= $arr['orderId'] ?>">
			<input type="hidden" name="total_price" value="<?= $total ?>">
			<input type="submit" class="btn checkout-btn" value="CHECKOUT">
		</form>
		
	</div>
	<script>
		var wd1 = new OmnivaWidget({
		
			compact_mode: true,	// Compact widget is not shown
										// If enabled only a dropdown with locations will be shown
		
			show_offices: true,		// Post offices will be shown
										// If disabled post offices will not be shown in the dropdown
		
			show_machines: true,	// Parcel terminals will be shown
										// If disabled parcel terminals will not be shown in the dropdown
		
			custom_html: false,		// Predefined HTML is activated
										// It is allowed to create a custom HTML                                // It will be included in the container
		
			id: 1,			// Will be added to the unique element ids if 
										// there is a need to have more than one widget
		
			selection_value: '',	// Preselected value. (case insensitive, will be trimmed) Can be empty or entirely omitted. Optional
		
			country_id: 'LV',		// Country code
		
			show_logo: true,	        // Omniva logo will be shown
		
			show_explanation: true	// Explanation text will be shown
		});
		</script>
		<script src="js/checkout.js"></script>
</body>
</html>