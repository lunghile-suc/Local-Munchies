<?php 

    include './database/dbconn.php';

    session_start();

    $email = $password ='';
    $errors = '';

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM `storeowners` WHERE storeEmail = '$email' and passwod='$password'";
        $results = mysqli_query($conn, $sql);

        if($results){
            $getUsers = mysqli_num_rows($results);
            $user  = mysqli_fetch_array($results);

            if($getUsers == 1){
                $_SESSION['Storename'] = $user['rasturantName'];
                $_SESSION['storeID'] = $user['storeID'];
                header('Location: dashboard.php');
            }else{
                $errors = 'Incorrect Username/Password';
            }
        }
    }
?>
<?php include './templates/header.php'; ?>
    <section class="contact-hero hero">
        <!-- header -->
        <header>
            <?php include './templates/navbar.php'; ?>
        </header>
        <div class="hero-contents">
            <h1>Log In</h1>
        </div>
    </section>
    <!-- contact -->
    <section class="contact-page">
        <div class="container">
            <div class="contact-inputs loginF">
                <h4>Admin Log In</h4>
                <form method="POST" class="login">
                    <div class="input-items">
                        <span class="error"><?php echo $errors; ?></span>
                        <input type="text" placeholder="Your Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ""); ?>">
                        <input type="password" placeholder="Password" name="password">
                        <input type="submit" value="Log In" class="input-btn1" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php include './templates/footer.php'; ?>