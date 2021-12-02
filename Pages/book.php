<?php 

    include './database/dbconn.php';

    // form validation
    $name = $rasturantName =  $phoneNo = $email = $password = $confirmPass = $streetName = $cuisineType = '';

    $errors = array('name' => '', 'rasturantName' => '', 'phoneNo' => '', 'email' => '', 'password' => '', 'confirmPass' => '', 'streetName' => '', 'cuisineType' => '');

    if(isset($_POST['submit'])){

        // name validation
        if(empty($_POST['name'])){
            $errors['name'] = 'Please enter name';
        }else{
            $name = $_POST['name'];
            if(!preg_match("/^[a-zA-z]*$/", $name)){
                $errors['name'] = 'Only alphabets and whitespace are allowed.';
            }
        }

        // last Name validation
        if(empty($_POST['rasturantName'])){
            $errors['rasturantName'] = 'Please enter Last Name';
        }else{
            $rasturantName = $_POST['rasturantName'];
            if(!preg_match("/^[a-zA-z]*$/", $rasturantName)){
                $errors['rasturantName'] ='Only alphabets and whitespace are allowed.';
            }
        }

        // phone number validation
        if(empty($_POST['phoneNo'])){
            $errors['phoneNo'] = 'Please enter phone no.';
        }else{
            $phoneNo = $_POST['phoneNo'];
            if(!preg_match("/^[0-9]*$/", $phoneNo)){
                $errors['phoneNo'] = 'Invalid Phone No.';
            }
        }

        // email validaton
        if(empty($_POST['email'])){
            $errors['email'] = 'Please enter email';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Please enter valid email';
            }
        }

        // validate password
        if(empty($_POST['password'])){
            $errors['password'] = 'Please enter password';
        }else{
            $password = $_POST['password'];
            if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
                $errors['password'] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            }
        }

        // confirm password validation
        if($_POST['password'] !== $_POST['confirm-password']){
            $errors['confirmPass'] = 'Passwords do not match';
        }

        // address validation
        if(empty($_POST['streetName'])){
            $errors['streetName'] = 'Please store address';
        }

        // insert into database
        if(array_filter($errors)){

        }else{
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $rasturantName = mysqli_real_escape_string($conn, $_POST['rasturantName']);
            $phoneNo = mysqli_real_escape_string($conn, $_POST['phoneNo']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $streetName = mysqli_real_escape_string($conn, $_POST['streetName']);
            $cuisineType = mysqli_real_escape_string($conn, $_POST['cuisineType']);

            $sql = "INSERT INTO storeowners(
                ownerName,
                storeEmail,          
                phoneNo, 
                rasturantName,
                rasturantAddress,
                cuisine_id,  
                passwod) VALUES (

                '$name',
                '$email',
                '$phoneNo',
                '$rasturantName',
                '$streetName',
                '$cuisineType',
                '$password'
            )";

            if(mysqli_query($conn, $sql)){
                // saved
            }else{
                echo mysqli_error($conn);
            }
        }
    }

    // get cuisine name from database
    $cuisineSql = "SELECT * FROM cuisine";
    $results = mysqli_query($conn, $cuisineSql);
    $cuisines = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_free_result($results);

?>
<?php include './templates/header.php'; ?>
    <section class="contact-hero hero">
        <!-- header -->
        <header>
            <?php include './templates/navbar.php'; ?>
        </header>
    </section>
    <section class="contact-section rmv-bg">
        <div class="container">
            <div class="contact-contents">
                <div class="contact-header header">
                    <h1 class="cursive-hd b-partner">Become a Restaurant Partner</h1>
                    <h5 class="partner">Partner with Local Munchies and access more customers, increase sales and make your restaurant a local legend.</h2>
                </div>
                <div class="contact-inputs">
                    <form action="" method="POST">
                        <div class="input-items">
                            <div class="input-items-1">
                                <label>Name</label>
                                <span class="error"><?php echo $errors['name']; ?></span>
                                <input type="text" placeholder="Your Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ""); ?>">
                                
                                <label>Phone</label>
                                <span class="error"><?php echo $errors['phoneNo']; ?></span>
                                <input type="text" placeholder="Phone" name="phoneNo" value="<?php echo htmlspecialchars($_POST['phoneNo'] ?? ""); ?>">
                                
                                <label>Rasturant Street Name</label>
                                <span class="error"><?php echo $errors['streetName']; ?></span>
                                <input type="text" placeholder="Rasturant St. Name" name="streetName" value="<?php echo htmlspecialchars($_POST['streetName'] ?? ""); ?>">
                                
                                <label>Password</label>
                                <span class="error"><?php echo $errors['password']; ?></span>
                                <input type="password" placeholder="Enter Password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? ""); ?>">
                                
                            </div>
                            <div class="input-items-2">
                                <label>Email</label>
                                <span class="error"><?php echo $errors['email']; ?></span>
                                <input type="email" placeholder="Your Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ""); ?>">
                                
                                <label>Rasturant Name</label>
                                <span class="error"><?php echo $errors['rasturantName']; ?></span>
                                <input type="text" placeholder="Rasturant name" name="rasturantName" value="<?php echo htmlspecialchars($_POST['rasturantName'] ?? ""); ?>">
                                
                                <label>Cuisine Type</label>
                                <select aria-placeholder="cuisine" name="cuisineType">
                                    <?php foreach($cuisines as $cuisine): ?>
                                        <option value="<?php echo $cuisine['cuisine_id']?>"><?php echo htmlspecialchars($cuisine['cuisine_name']) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label>Confirm Password</label>
                                <span class="error"><?php echo $errors['confirmPass']; ?></span>
                                <input type="password" placeholder="Confirm password" name="confirm-password" value="<?php echo htmlspecialchars($_POST['confirm-password'] ?? ""); ?>">
                            </div>
                        </div>
                        <input type="submit" value="Create Account" class="input-btn1" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include './templates/footer.php'; ?>