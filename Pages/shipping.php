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

$error = array('address' => '');
// place order
if (isset($_POST['placeOrder'])) {
    //address validation
    if (empty($_POST['address'])) {
        $error['address'] = 'Please Enter shipping address';
    }

    if (array_filter($error)) {
    } else {
        $foodName = mysqli_real_escape_string($conn, $_POST['foodname']);
        $customerID = mysqli_real_escape_string($conn, $_POST['customerID']);
        $foodID = mysqli_real_escape_string($conn, $_POST['foodID']);
        $storeID = mysqli_real_escape_string($conn, $_POST['storeID']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $sql = "INSERT INTO orders(
            food_id,
            customer_id,
            store_id,
            food_name,
            food_price,
            quantity,
            OrderStatus,
            customerAddress,
            OrderDate
        ) values (
            '$foodID',
            '$customerID',
            '$storeID',
            '$foodName',
            '$price',
            '$quantity',
            '$status',
            '$address',
            now()
        )";

        if (mysqli_query($conn, $sql)) {
            // saved
        } else {
            echo mysqli_error($conn);
        }

        unset($_SESSION['cart']);
    }
}

$total = 0;

?>
<section class="contact-hero hero">
    <!-- header -->
    <header>
        <?php include './templates/navbar.php'; ?>
    </header>
    <div class="hero-contents">
        <h1>Checkout</h1>
    </div>
</section>
<section class="cart-section">
    <div class="container">
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title">
                Order Preview
            </div>
            <form action="" method="post">
                <table>
                    <thead>
                        <tr>
                            <td></td>
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
                                            <?php echo $value['quantity'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total-price">R<?php echo number_format($subTotal, 2); ?></div>
                                    </td>
                                </tr>
                                <input type="hidden" name="customerID" value="<?php echo $_SESSION['id'] ?? ""; ?>">
                                <input type="hidden" name="foodID" value="<?php echo $value['id'] ?? ""; ?>">
                                <input type="hidden" name="storeID" value="<?php echo $value['storeid'] ?? ""; ?>">
                                <input type="hidden" name="foodname" value="<?php echo $value['foodName'] ?? "" ?>">
                                <input type="hidden" name="price" value="<?php echo number_format($subTotal, 2); ?>">
                                <input type="hidden" name="quantity" value="<?php echo $value['quantity'] ?>">
                                <input type="hidden" name="status" value="Processing">
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <div class="checkout">
                    <h3>Grand Total: <?php echo number_format($total, 2); ?></h3>
                    <div class="checkout-ads">
                        <label>Shipping Address</label>
                        <textarea name="address" placeholder="Shipping Address" cols="30" rows="5"></textarea>
                        <span class="error"><?php echo $error['address'] ?></span>
                    </div>
                    <div class="payment">
                        <h4>Payment</h4>
                        <input type="radio" name="" checked><label>Cash on Delivery</label>
                    </div>
                    <input type="submit" name="placeOrder" value="Place Order" class="placeorder-btn">
                </div>
            </form>
        </div>
    </div>
</section>
<?php include './templates/footer.php'; ?>