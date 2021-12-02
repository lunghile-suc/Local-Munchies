<?php

include './templates/dashboardnav.php';
include './database/dbconn.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$storeID = $_SESSION['storeID'];

$sql = "SELECT * FROM orders WHERE store_id='$storeID'";
$results = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
mysqli_free_result($results);

if (isset($_POST['complete'])) {
  $updateID = mysqli_real_escape_string($conn, $_POST['updateID']);
  $sql = "UPDATE orders SET OrderStatus='Complete' WHERE order_id='$updateID'";

  if (mysqli_query($conn, $sql)) {
    header('Location: orders.php');
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

?>
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
            <form action="orders.php" method="POST">
              <?php foreach ($orders as $order) : ?>
                <tr>
                  <td data-label="Name"><?php echo $order['food_name'] ?></td>
                  <td data-label="Price">R<?php echo $order['food_price'] ?></td>
                  <td data-label="Status">
                    <div class="status delivered"><?php echo $order['OrderStatus'] ?></div>
                  </td>
                  <td data-label="Order"><?php echo $order['OrderDate'] ?></td>
                  <td data-label="Action">
                    <div class="status delete">
                      <input type="hidden" name="updateID" value="<?php echo $order['order_id']; ?>">
                      <input type="submit" name="complete" value="Complete Order" class="btn-delete">
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
<script src="./js/jquery-3.4.1.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/aos.js"></script>
<script src="./js/jquery.datetimepicker.js"></script>
<script src="./js/jquery.timepicker.min.j"></script>
<script src="./js/main.js"></script>
</body>

</html>