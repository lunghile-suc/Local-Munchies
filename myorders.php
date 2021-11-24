<?php

include './database/dbconn.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$C_id = $_SESSION['id'] ?? "";

$sql = "SELECT * FROM orders WHERE customer_id='$C_id'";
$results = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
mysqli_free_result($results);

?>
<?php include './templates/header.php'; ?>
<section class="contact-hero hero">
    <!-- header -->
    <header>
        <?php include './templates/navbar.php'; ?>
    </header>
    <div class="hero-contents">
        <h1>My Orders</h1>
    </div>
</section>
<section>
    <div class="container">
        <div class="contents">
            <div class="recentOrders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="">
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td data-label="Name"><?php echo $order['food_name'] ?></td>
                                    <td data-label="Price">R<?php echo $order['food_price'] ?></td>
                                    <td data-label="Status">
                                        <div class="status <?php if ($order['OrderStatus'] == 'complete') {
                                                                echo 'processing';
                                                            } else {
                                                                echo 'delivered';
                                                            } ?>"><?php echo $order['OrderStatus'] ?>
                                        </div>
                                    </td>
                                    <td data-label="Order"><?php echo $order['OrderDate'] ?></td>
                                    <td data-label="Action">
                                        <div class="status delete">
                                            <input type="hidden" name="cancelID" value="<?php echo $order['food_id']; ?>">
                                            <input type="submit" name="delete" value="Cancel Order" class="btn-delete">
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include './templates/footer.php'; ?>