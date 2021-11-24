<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include './database/dbconn.php';
include './templates/dashboardnav.php';

$storeID = $_SESSION['storeID'];


$sql = "SELECT * FROM orders WHERE store_id='$storeID'";
$results = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
// mysqli_free_result($results);

$salesCount = mysqli_num_rows($results);

$revenue = 0;

foreach ($orders as $order) {
    $revenue = $revenue + $order['food_price'];
}

?>
<section>
    <div class="container">
        <div class="cardContainer">
            <div class="card">
                <div class="cardIcon">
                    R
                </div>
                <div class="carditems">
                    <h2>R <?php echo number_format($revenue, 2); ?></h2>
                    <h3>Revenue</h3>
                </div>
            </div>
            <div class="card">
                <div class="cardIcon">
                    C
                </div>
                <div class="carditems">
                    <h2>
                        <?php
                        $Csql = "SELECT * FROM orders WHERE OrderStatus='complete'";
                        $result = mysqli_query($conn, $Csql);

                        echo mysqli_num_rows($results);
                        ?>
                    </h2>
                    <h3>Complete Orders</h3>
                </div>
            </div>
            <div class="card">
                <div class="cardIcon">
                    S
                </div>
                <div class="carditems">
                    <h2>
                        <?php echo $salesCount; ?>
                    </h2>
                    <h3>Sales</h3>
                </div>
            </div>
        </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <form action="">
                            <?php foreach ($orders as $order) : ?>
                                <?php $revenue = $revenue + $order['food_price']; ?>
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
                                </tr>
                            <?php endforeach ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="./js/jquery-3.4.1.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/aos.js"></script>
<script src="./js/jquery.datetimepicker.js"></script>
<script src="./js/jquery.timepicker.min.j"></script>
<script src="./js/main.js"></script>
</body>

</html>