<?php 

    include './templates/header.php';
    include './database/dbconn.php';
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['id'])){
        $customerID = $_SESSION['id'];
        $sql = "SELECT * FROM customers WHERE customerID='$customerID'";
        $results = mysqli_query($conn, $sql);
        $details = mysqli_fetch_all($results, MYSQLI_ASSOC);
        mysqli_free_result($results);
    }


?>
    <section class="stories-hero hero">
        <!-- header -->
        <header>
            <?php include './templates/navbar.php'; ?>
        </header>
        <div class="hero-contents">
            <h1><?php echo $_SESSION['name'] ?></h1>
        </div>
    </section>
    <section class="contact-section rmv-bg">
        <div class="container">
            <div class="contact-contents">
                <div class="contact-header header">
                    <h1 class="cursive-hd b-partner">Account Details</h1>
                </div>
                <div class="contact-inputs">
                    <form action="">
                        <?php foreach($details as $detail): ?>
                        <div class="input-items">
                            <div class="input-items-1">
                                <label>Name</label>
                                <input type="text" placeholder="Your Name" value="<?php echo $detail['Fname'];  ?>">
                                <label>Phone</label>
                                <input type="text" placeholder="Phone" value="<?php echo $detail['phoneNo'];  ?>">
                                <label>Password</label>
                                <input type="password" placeholder="Enter Password">
                                <label>Address</label>
                                <input type="text" placeholder="Your Address" value="<?php echo $detail['c_address'];  ?>">  
                            </div>
                            <div class="input-items-2">
                                <label>Last Name</label>
                                <input type="email" placeholder="Last Name" value="<?php echo $detail['surname'];  ?>">
                                <label>Email</label>
                                <input type="email" placeholder="Your Email" value="<?php echo $detail['email'];  ?>">
                                <label>Confirm Password</label>
                                <input type="password" placeholder="Confirm password">
                            </div>
                        </div>
                        <input type="submit" value="Update" class="input-btn1" name="submit">
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include './templates/footer.php'; ?>