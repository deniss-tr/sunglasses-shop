<?php
    $login = $controller->currentUser()->getLogin();
?>
<header class="header">
    <div class="header-left">
        <div class="user-name"><?= $login ?></div>
    </div>
    <nav class="nav">
        <ul>
            <li><a href="/">Product List</a></li>
        <?php if($controller->currentUser()->checkAdmin()): ?>
            <li><a href="orders.php">Order List</a></li>
        <?php endif; ?>
        </ul>	
    </nav>
    <div class="header-right">
        <a class="cart-btn" href="cart.php">Cart: (<span class="cart-count"><?= count($controller->getCart()) ?></span>)</a>
        <?php if($controller->currentUser()->checkAuth()): ?>
            <a href="logout.php">Log out</a>
        <?php else: ?>    
            <a href="login.php">Log in</a>
        <?php endif; ?>
    </div>
</header>