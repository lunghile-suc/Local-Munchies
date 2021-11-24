<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <!-- navbar -->
    <section class="nav-section">
        <nav>
            <div class="container">
                <span class="logo">
                    <?php if(isset($_SESSION['Storename'])): ?>
                    <?php echo $_SESSION['Storename']; ?>
                    <?php else: ?>
                        Local Munchies
                    <?php endif ?>
                </span>
                <ul>
                    <div class="container">
                        <li><a href="dashboard.php" class="active">Dashboard</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="fooditems.php">Add/Delete Food</a></li>
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