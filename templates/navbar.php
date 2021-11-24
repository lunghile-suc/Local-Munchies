<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>
<section class="top-descriptions">
    <div class="container">
        <div class="top-content">
            <div class="cell-no"><i class="fas fa-phone-alt"></i> +1235 2355 98</div>
            <div class="email-address"><i class="fas fa-paper-plane"></i> info@Localmunchies.com</div>
            <div class="open-hours">24 hours opening stores</div>
        </div>
    </div>
</section>
<!-- navbar -->
<section class="nav-section">
    <nav>
        <div class="container">
            <span class="logo">
                Local Munchies
            </span>
            <ul>
                <div class="container">
                    <?php if (isset($_SESSION['id'])) : ?>
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="menu.php">Our Menu</a></li>
                        <li><a href="account.php">My Account</a></li>
                        <li><a href="myorders.php">My Orders</a></li>
                        <li>
                            <a href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="cartCount">
                                    <?php if (isset($_SESSION['cart'])): ?>
                                        <?php $count = count($_SESSION['cart']); ?>
                                        <?php echo $count ?>
                                    <?php else:  ?>
                                        <?php echo 0; ?>
                                    <?php endif ?>
                                </span>
                            </a>
                        </li>
                        <li><a href="contact.php">Contact Us</a></li>
                    <?php else : ?>
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="menu.php">Our Menu</a></li>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="signup.php">Sign Up</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li class="book-table"><a href="book.php">Sign up rasturant</a></li>
                    <?php endif ?>
                </div>
            </ul>
            <div class="burger">
                <div class="lines">
                    <div class="line1 line"></div>
                    <div class="line2 line"></div>
                    <div class="line3 line"></div>
                </div>
                <span class="bg-menu">MENU</span>
            </div>
        </div>
    </nav>
</section>