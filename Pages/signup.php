<?php 

    include './database/dbconn.php';

    // form validation


    $name = $lastName = $phoneNo = $email = $password = $confirmPass = $address = $gender = '';

    // errors array
    $errors = array('name' => '', 'lastName' => '', 'phoneNo' => '', 'email' => '', 'password' => '', 'confirmPass' => '', 'address' => '', 'gender' => '');
    
    if(isset($_POST['submit'])){
        
        // name validation
        if(empty($_POST['name'])){
            $errors['name'] = 'Please enter name';
        }else{
            $name = $_POST['name'];
            if(!preg_match("/^[a-z ,.'-]+$/i", $name)){
                $errors['name'] = 'Only alphabets and whitespace are allowed.';
            }
        }

        // last Name validation
        if(empty($_POST['last-name'])){
            $errors['lastName'] = 'Please enter Last Name';
        }else{
            $lastName = $_POST['last-name'];
            if(!preg_match("/^[a-zA-z]*$/", $name)){
                $errors['lastName'] ='Only alphabets and whitespace are allowed.';
            }
        }

        // phone number validation
        if(empty($_POST['phone'])){
            $errors['phoneNo'] = 'Please enter phone no.';
        }else{
            $phoneNo = $_POST['phone'];
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

        // validate address
        if(empty($_POST['address'])){
            $errors['address'] = 'Please enter address';
        }

        if(array_filter($errors)){

        }else{
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
            $phoneNo = mysqli_real_escape_string($conn, $_POST['phone']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            $sql = "INSERT INTO customers(
                Fname, 
                surname, 
                phoneNo, 
                email, 
                passwod, 
                c_address, 
                gender) VALUES (

                '$name',
                '$lastName',
                '$phoneNo',
                '$email',
                '$password',
                '$address',
                '$gender'
            )";

            if(mysqli_query($conn, $sql)){
                header('Location: login.php');
            }else{
                echo mysqli_error($conn);
            }
        }
    }

?>
<?php include './templates/header.php'; ?>
    <section class="stories-hero hero">
        <!-- header -->
        <header>
            <?php include './templates/navbar.php'; ?>
        </header>
    </section>
    <section class="contact-section rmv-bg">
        <div class="container">
            <div class="contact-contents">
                <div class="contact-header header">
                    <h1 class="cursive-hd b-partner">Sign up with us</h1>
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
                                <input type="text" placeholder="Phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ""); ?>">
                                <label>Password</label>
                                <span class="error"><?php echo $errors['password']; ?></span>
                                <input type="password" placeholder="Enter Password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? ""); ?>">
                                <label>Address</label>
                                <span class="error"><?php echo $errors['address']; ?></span>
                                <input type="text" placeholder="Your Address" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ""); ?>">
                            </div>
                            <div class="input-items-2">
                                <label>Last Name</label>
                                <span class="error"><?php echo $errors['lastName']; ?></span>
                                <input type="text" placeholder="Last Name" name="last-name" value="<?php echo htmlspecialchars($_POST['last-name'] ?? ""); ?>">
                                <label>Email</label>
                                <span class="error"><?php echo $errors['email']; ?></span>
                                <input type="email" placeholder="Your Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ""); ?>">
                                <label>Confirm Password</label>
                                <span class="error"><?php echo $errors['confirmPass']; ?></span>
                                <input type="password" placeholder="Confirm password" name="confirm-password" value="<?php echo htmlspecialchars($_POST['confirm-password'] ?? ""); ?>">
                                <label>Gender</label>
                                <select aria-placeholder="Gender" name="gender" value="<?php echo htmlspecialchars($_POST['gender'] ?? ""); ?>">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Create Account" class="input-btn1" name="submit">
                    </form>
                    <p>Already have an account <a href="login.php">Log In</a></p>
                </div>
            </div>
        </div>
    </section>
<?php include './templates/footer.php'; ?>