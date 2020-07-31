<?php
	require "app/Controller.php";
	$controller = new Controller();
	$orders = $controller->orders();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Orders</title>
</head>
<body>
	<?php
      include 'templates\header.php';
    ?>
	<div class="wrapper">
		<main class="table">
				<table class="table-list">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Address</th>
							<th>Price</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($orders as $item):
						$nr += 1;
					?>
						<tr>
							<td><?= $nr ?></td>
							<td><?= $item['date'] ?></td>
							<td><?= $item['address'] ?></td>
							<td><?= $item['price'] ?></td>
							<td><?= $item['status'] ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

		</main>
	</div>
</body>
</html>