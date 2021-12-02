<?php

    include './database/dbconn.php';

    // form validation
    $name = $email = $message = '';

    $errors = array('name' => '', 'email' => '', 'message' => '');


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

        // email validation
        if(empty($_POST['email'])){
            $errors['email'] = 'Please enter email';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Please enter valid email';
            }
        }

        // message validation
        // if(empty($_POST['message'])){
        //     $errors['message'] = 'Please write your message';
        // }

        if(array_filter($errors)){

        }else{
            // $to = 'chauke.ls2000@gmail.com';
            // $subject = $_POST['subject'];
            // $message = wordwrap($_POST['message'], 70);
            // $headers = 'From: webmaster@example.com' . "\r\n" .
            // 'Reply-To: webmaster@example.com';
           
            // mail($to, $subject, $message, $headers);
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
            <h1>Contact</h1>
            <div class="hero-links">
                <a href="index.html">Home ></a>
                <a href="contact.html">Contact Us ></a>
            </div>
        </div>
    </section>
    <!-- contact -->
    <section class="contact-page">
        <div class="container">
            <div class="contact-inputs">
                <h4>Contact Us</h4>
                <form method="POST">
                    <div class="input-items">
                        <span class="error"><?php echo $errors['name']; ?></span>
                        <input type="text" placeholder="Your Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ""); ?>">  
                        <span class="error"><?php echo $errors['email']; ?></span>           
                        <input type="text" placeholder="Your Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ""); ?>">
                        <input type="text" placeholder="Subject" name="subject">
                        <span class="error"><?php echo $errors['message']; ?></span>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Your Message" name="message" value="<?php echo htmlspecialchars($_POST['message'] ?? ""); ?>"></textarea>                     
                        <input type="submit" value="Send Message" class="input-btn1" name="submit">
                    </div>
                </form>
                <div class="contact-ads">
                    <p>Address: 11423 Violet Crescent St., Kagiso 6, Krugersdorp</p>
                    <p>Phone: <span>+1235235598</span></p>
                    <p>Email: <span>info@localmunchies.com</span></p>
                    <p>Website: <span>Localmunchies.com</span></p>
                </div>
            </div>
        </div>
    </section>
<?php include './templates/footer.php'; ?>