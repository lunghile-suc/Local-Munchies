<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// session_destroy();
// unset($_SESSION['cart']);

include './database/dbconn.php';

$sql = "SELECT * FROM menu LIMIT 6";
$results = mysqli_query($conn, $sql);
$menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
mysqli_free_result($results);


?>
<?php include './templates/header.php'; ?>
<!-- header -->
<header>
    <?php include './templates/navbar.php'; ?>
    <!-- carousel -->
    <section class="header-carousel">
        <div class="carousel-content">
            <div class="header-slider slider-1">
                <div class="container">
                    <div class="slider-items">
                        <h1 class="item-subheading cursive-hd">You hungry?<br> Of course you are!</span>
                            <h3>Order Mouth watering food from our local rasturants</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<!-- end header -->

<!-- main -->
<main>
    <!-- services section -->
    <section class="services-section">
        <div class="services-contents">
            <div class="container">
                <div class="services-items">
                    <div class="services-item">
                        <i class="fas fa-credit-card"></i>
                        <h3>Secure Payments</h3>
                        <p>Secure payments with credit/debit card</p>
                    </div>
                    <div class="services-item">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>Free Delivery or Pick Up</h3>
                        <p>Free delivery for orders in a specified area or you can pick it up</p>
                    </div>
                    <div class="services-item">
                        <i class="fas fa-utensils"></i>
                        <h3>Choose A Tasty Dish</h3>
                        <p>We've got you covered with menus from over various delivery restaurants online!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="menu-section">
        <div class="menu-contents contents">
            <div class="container">
                <div class="menu-header header">
                    <h2>Our Menu</h2>
                </div>
                <div class="menu-items">
                    <form action="" method="POST">
                        <?php foreach ($menuItems as $menuItem) : ?>
                            <div class="menu-item">
                                <div class="menu-img img-1">
                                    <img src="./images/<?php echo $menuItem['food_img']; ?>" alt="">
                                </div>
                                <div class="menu-description">
                                    <h4><?php echo $menuItem['food_name']; ?> <span>R<?php echo $menuItem['food_price']; ?></span></h4>
                                    <p><?php echo $menuItem['food_desc']; ?></p>
                                    <input type="hidden" name="name" value="<?php echo $menuItem['food_name'] ?>">
                                    <input type="hidden" name="id" value="<?php echo $menuItem['food_id'] ?>">
                                    <input type="hidden" name="price" value="<?php echo $menuItem['food_price'] ?>">
                                    <div class="order-btn btn">
                                        <!-- <input type="submit" value="Add To Cart" name="addToCart" class="input-btn1"> -->
                                        <a href="about.php?id=<?php echo $menuItem['food_id'] ?>">add to cart</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include './templates/footer.php';
