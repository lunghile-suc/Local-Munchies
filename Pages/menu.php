<?php

include './templates/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include './database/dbconn.php';



?>
<section class="menu-hero hero">
    <!-- header -->
    <header>
        <?php include './templates/navbar.php'; ?>
    </header>
    <div class="hero-contents">
        <h1>Our Dishes</h1>
        <div class="hero-links">
            <a href="index.php">Home ></a>
            <a href="menu.php">Menu ></a>
        </div>
    </div>
</section>
<!-- menu section -->
<section class="menu-section">
    <div class="menu-contents contents">
        <div class="container">
            <div class="tab-list">
                <div class="tabs">
                    <li data-target="#breakfast" class="tab p-active"><span></span>Kota</li>
                    <li data-target="#lunch" class="tab"><span></span>Chicken</li>
                    <li data-target="#dinner" class="tab"><span></span>Beef</li>
                    <li data-target="#drinks" class="tab"><span></span>Other</li>
                </div>
            </div>
            <div class="breakfast panel p-active" id="breakfast">
                <div class="menu-items">
                    <form action="">
                        <?php
                        $sql = "SELECT * FROM menu WHERE cuisine_id='1'";
                        $results = mysqli_query($conn, $sql);
                        $menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
                        mysqli_free_result($results);
                        ?>
                        <?php foreach ($menuItems as $menuItem) : ?>
                            <div class="menu-item">
                                <div class="menu-img img-1">
                                    <img src="./images/<?php echo $menuItem['food_img'] ?>" alt="" srcset="">
                                </div>
                                <div class="menu-description">
                                    <h4><?php echo $menuItem['food_name'] ?> <span>R<?php echo $menuItem['food_price'] ?></span></h4>
                                    <p><?php echo $menuItem['food_desc'] ?></p>
                                    <div class="order-btn btn">
                                        <a href="about.php?id=<?php echo $menuItem['food_id']; ?>">Order now</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
            <div class="lunch panel" id="lunch">
                <div class="menu-items">
                <form action="">
                        <?php
                        $sql = "SELECT * FROM menu WHERE cuisine_id='3'";
                        $results = mysqli_query($conn, $sql);
                        $menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
                        mysqli_free_result($results);
                        ?>
                        <?php foreach ($menuItems as $menuItem) : ?>
                            <div class="menu-item">
                                <div class="menu-img img-1">
                                    <img src="./images/<?php echo $menuItem['food_img'] ?>" alt="" srcset="">
                                </div>
                                <div class="menu-description">
                                    <h4><?php echo $menuItem['food_name'] ?> <span>R<?php echo $menuItem['food_price'] ?></span></h4>
                                    <p><?php echo $menuItem['food_desc'] ?></p>
                                    <div class="order-btn btn">
                                        <a href="about.php?id=<?php echo $menuItem['food_id'] ?>">Order now</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
            <div class="dinner panel" id="dinner">
                <div class="menu-items">
                <form action="">
                        <?php
                        $sql = "SELECT * FROM menu WHERE cuisine_id='5'";
                        $results = mysqli_query($conn, $sql);
                        $menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
                        mysqli_free_result($results);
                        ?>
                        <?php foreach ($menuItems as $menuItem) : ?>
                            <div class="menu-item">
                                <div class="menu-img img-1">
                                    <img src="./images/<?php echo $menuItem['food_img'] ?>" alt="" srcset="">
                                </div>
                                <div class="menu-description">
                                    <h4><?php echo $menuItem['food_name'] ?> <span>R<?php echo $menuItem['food_price'] ?></span></h4>
                                    <p><?php echo $menuItem['food_desc'] ?></p>
                                    <div class="order-btn btn">
                                        <a href="about.php?id=<?php echo $menuItem['food_id'] ?>">Order now</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
            <div class="drinks panel" id="drinks">
                <div class="menu-items">
                <form action="">
                        <?php
                        $sql = "SELECT * FROM menu WHERE cuisine_id='6'";
                        $results = mysqli_query($conn, $sql);
                        $menuItems = mysqli_fetch_all($results, MYSQLI_ASSOC);
                        mysqli_free_result($results);
                        ?>
                        <?php foreach ($menuItems as $menuItem) : ?>
                            <div class="menu-item">
                                <div class="menu-img img-1">
                                    <img src="./images/<?php echo $menuItem['food_img'] ?>" alt="" srcset="">
                                </div>
                                <div class="menu-description">
                                    <h4><?php echo $menuItem['food_name'] ?> <span>R<?php echo $menuItem['food_price'] ?></span></h4>
                                    <p><?php echo $menuItem['food_desc'] ?></p>
                                    <div class="order-btn btn">
                                        <a href="about.php?id=<?php echo $menuItem['food_id'] ?>">Order now</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include './templates/footer.php'; ?>