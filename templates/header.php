<?php

?>
<header class="header">
    <div class="header-left">
        <div class="user-name">Guest</div>
    </div>
    <nav class="nav">
        <ul>
            <li><a href="/">Product List</a></li>
        </ul>	
    </nav>
    <div class="header-right">
        <a class="cart-btn" href="cart.php">Cart: (<span class="cart-count"><?= count($controller->getCart()) ?></span>)</a>
        <a href="login.php">Log in</a>
    </div>
</header>