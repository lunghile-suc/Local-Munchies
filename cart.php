<?php
include './templates/header.php';
include './database/dbconn.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_GET["action"])) {
    if ($_GET["action"] == "remove") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["id"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Product has been Removed...!")</script>';
                echo '<script>window.location="Cart.php"</script>';
            }
        }
    }
}

$total = 0;
$subTotal = 0;


?>
<section class="contact-hero hero">
    <!-- header -->
    <header>
        <?php include './templates/navbar.php'; ?>
    </header>
    <div class="hero-contents">
        <h1>Cart</h1>
    </div>
</section>
<section class="cart-section">
    <div class="container">
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title">
                Shopping cart
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>image</td>
                        <td>Name</td>
                        <td>Quantity</td>
                        <td>Sub Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['cart'])) : ?>
                        <?php foreach ($_SESSION['cart'] as $key => $value) : ?>
                            <?php $subTotal = $value["quantity"] * $value["price"]; ?>
                            <?php $total = $total + $subTotal; ?>
                            <tr>
                                <td>
                                    <a href="cart.php?action=remove&id=<?php echo $value['id'] ?>"><span class="delete-btn"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                </td>
                                <td>
                                    <div class="image">
                                        <img src="./images/<?php echo $value['image']; ?>" />
                                    </div>
                                </td>
                                <td>
                                    <div class="description">
                                        <span><?php echo $value['foodName'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        <input type="text" name="name" value="<?php echo $value['quantity'] ?>" id="number">
                                    </div>
                                </td>
                                <td>
                                    <div class="total-price">
                                        R<?php echo number_format($subTotal, 2); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
            <div class="checkout">
                <h3>Grand Total: <?php echo number_format($total,2); ?></h3>
                <div class="checkout-btn">
                    <a href="shipping.php">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include './templates/footer.php'; ?>