<?php
    include './templates/dashboardnav.php';
    include './database/dbconn.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $storeID = $_SESSION['storeID'];

    // select all menu food
    $sql = "SELECT * FROM menu WHERE storeID = '$storeID'";
    $results = mysqli_query($conn, $sql);
    $foods = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_free_result($results);

    foreach($foods as $food){
        $cuisine_id = $food['cuisine_id'];
    }

    // delete from menu
    if(isset($_POST['delete'])){
        $deleteID = mysqli_real_escape_string($conn, $_POST['deleteID']);
        $sql = "DELETE FROM menu WHERE food_id='$deleteID'";
        if (mysqli_query($conn, $sql)) {
            header('Location: fooditems.php');
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
?>
    <section>
        <div class="container">
            <div class="contents">
                <div class="add-btn">
                    <a href="add.php">Add Food</a>
                </div>
                <div class="recentOrders">
                    <h2>Your Food Items</h2>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Cuisine Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($foods as $food): ?>
                            <tr>
                                <td data-label="Name"><?php echo $food['food_name']; ?></td>
                                <td data-label="Description"><?php echo $food['food_desc']; ?></td>
                                <td data-label="Price">R<?php echo $food['food_price']; ?></td>
                                <td data-label="Cuisine">
                                    <?php
                                        $cuisine_id = $food['cuisine_id'];
                                        $cuisineSql = "SELECT cuisine_name FROM cuisine WHERE cuisine_id='$cuisine_id'";
                                        $results = mysqli_query($conn, $cuisineSql);
                                        $cuisines = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                        mysqli_free_result($results);

                                        foreach($cuisines as $cuisine){
                                            $cuisine = $cuisine['cuisine_name'];
                                        }

                                        echo $cuisine;
                                    ?>
                                </td>
                                <form action="fooditems.php" method="POST">
                                    <td data-label="Status">
                                        <div class="status delete">
                                            <input type="hidden" name="deleteID" value="<?php echo $food['food_id']; ?>">
                                            <input type="submit" name="delete" value="Delete" class="btn-delete">
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            <?php endforeach ?>
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