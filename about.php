<?php

include './templates/header.php';
include './database/dbconn.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM menu WHERE food_id='$id'";
    $results = mysqli_query($conn, $sql);
    $menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_free_result($results);
}

?>
<section class="about-hero hero">
    <!-- header -->
    <header>
        <?php include './templates/navbar.php'; ?>
    </header>
</section>
<main>
    <!-- about section -->
    <section class="about-section section">
        <div class="container">
            <div class="about-content content">
                <form action="manage_cart.php" method="POST">
                    <?php if (isset($menuItems)) : ?>
                        <?php foreach ((array) $menuItems as $menuItem) : ?>
                            <div class="content-items">
                                <div class="about-imgs imgs">
                                    <div class="abt-img">
                                        <img src="./images/<?php echo $menuItem['food_img']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="about-description">
                                    <div class="about-header header">
                                        <h1 class="cursive-hd"><?php echo $menuItem['food_name']; ?></h1>
                                    </div>
                                    <div class="about-desc">
                                        <h3>R<?php echo $menuItem['food_price']; ?></h3>
                                        <p><?php echo $menuItem['food_desc'] ?></p>
                                        <textarea name="specialMsg" placeholder="Special Message About your order, Eg. Allergies" cols="30" rows="5"></textarea>
                                        <div class="items-increment">
                                            <label>Quantity</label><br>
                                            <input type="button" onclick="decrementValue()" value="-" />
                                            <input type="text" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" />
                                            <input type="button" onclick="incrementValue()" value="+" />
                                        </div>
                                        <input type="submit" value="Add to cart" class="input-btn1" name="addToCart">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="name" value="<?php echo $menuItem['food_name'] ?>">
                            <input type="hidden" name="id" value="<?php echo $menuItem['food_id'] ?>">
                            <input type="hidden" name="storeid" value="<?php echo $menuItem['storeID'] ?? "" ?>">
                            <input type="hidden" name="price" value="<?php echo $menuItem['food_price'] ?>">
                            <input type="hidden" name="image" value="<?php echo $menuItem['food_img'] ?? "" ?>">
                        <?php endforeach ?>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include './templates/footer.php'; ?>