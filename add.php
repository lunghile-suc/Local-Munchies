<?php
    include './templates/dashboardnav.php';
    include './database/dbconn.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $foodName = $price = $uploadfile = $description = $cuisine = $image = $msg ='';
    $errors = array('foodName' => '', 'price' => '', 'uploadfile' => '', 'description' => '', 'cuisine' => '', 'image' => '');

    // get cuisine types from database
    $cuisineSql = "SELECT * FROM cuisine";
    $results = mysqli_query($conn, $cuisineSql);
    $cuisines = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_free_result($results);

    // form validation
    if(isset($_POST['submit'])){

        // name validation
        if(empty($_POST['foodName'])){
            $errors['foodName'] = 'Please enter name of food';
        }else{
            $foodName = $_POST['foodName'];
            if(!preg_match("/^[a-z ,.'-]+$/i", $foodName)){
                $errors['foodName'] = 'Only alphabets and whitespace are allowed.';
            }
        }

        // description validation
        if(empty($_POST['description'])){
            $errors['description'] = 'Please enter description';
        }

        //Validate image
        if (empty($_POST["uploadfile"])) {
            $errors['uploadfile'] = "Please upload image";
        } else {
            $image = $_POST["uploadfile"];
            $allowed =  array('jpeg','jpg', "png", "bmp", "JPEG","JPG", "PNG", "BMP");
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                $imageError = "jpeg, jpg and png only";
            }
        }

        // cuisine type validation
        if($_POST['cuisine'] == 'null') {
            $errors['cuisine'] = 'Please select cusine';
        }

        // price validation
        if(empty($_POST['price'])){
            $errors['price'] = 'Please enter price';
        }else{
            $price = $_POST['price'];
            if(!preg_match("/^\d+(,\d{3})*(\.\d{1,2})?$/", $price)){
                $errors['price'] = 'The required format for price entering eg. 25.00';
            }
        }

        // upload image
        $filename = $_FILES["uploadfile"]["name"] ?? "";
        $tempname = $_FILES["uploadfile"]["tmp_name"] ?? "";    
        $folder = "C:/xampp/htdocs/Local Munchies/images".$filename;

        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

        // check for errors
        if(array_filter($errors)){

        }else{
            $foodName = mysqli_real_escape_string($conn, $_POST['foodName']);
            $uploadfile = mysqli_real_escape_string($conn, $_POST['uploadfile']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $cuisine = mysqli_real_escape_string($conn, $_POST['cuisine']);
            $storeID = $_SESSION['storeID'];

            $sql = "INSERT INTO menu(
                storeID,
                cuisine_id,
                food_name,
                food_desc, 
                food_price, 
                food_img 
                    ) VALUES (
                '$storeID',
                '$cuisine',
                '$foodName',
                '$description',
                '$price',
                '$uploadfile'              
            )";

            if(mysqli_query($conn, $sql)){
                
            }else{
                echo mysqli_error($conn);
            }
        }
    }
?>
<section class="contact-page">
    <div class="container">
        <div class="contents">
            <div class="contact-contents">
                <div class="contact-header header">
                    <h1 class="cursive-hd b-partner">Add food to the menu</h1>
                </div>
                <div class="contact-inputs">
                    <form method="POST">
                        <div class="input-items">
                            <div class="input-items-1">
                                <label>Food Name</label>
                                <span class="errors" style="color: #d80b0b;"><?php echo $errors['foodName']; ?></span>
                                <input type="text" placeholder="Food Name" name="foodName" value="<?php echo htmlspecialchars($_POST['foodName'] ?? ""); ?>">
                                <label>Price</label>
                                <span class="errors" style="color: #d80b0b;"><?php echo $errors['price']; ?></span>                              
                                <input type="text" placeholder="Price" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ""); ?>">
                                <label >Image</label>                 
                                <span class="errors" style="color: #d80b0b;"><?php echo $errors['uploadfile']; ?></span>               
                                <input type="file" name="uploadfile" value="<?php echo htmlspecialchars($_POST['uploadfile'] ?? ""); ?>">
                            </div>
                            <div class="input-items-2">
                                <label>Description</label>      
                                <span class="errors" style="color: #d80b0b;"><?php echo $errors['description']; ?></span>            
                                <input type="text" placeholder="Description" name="description" value="<?php echo htmlspecialchars($_POST['description'] ?? ""); ?>">
                                <label>Cuisine Type</label>
                                <span class="errors" style="color: #d80b0b;"><?php echo $errors['cuisine']; ?></span>
                                <select aria-placeholder="Cuisine" name="cuisine" value="<?php echo htmlspecialchars($_POST['cuisine'] ?? ""); ?>">
                                    <option value="null">Please select cuisine</option>
                                    <?php foreach($cuisines as $cuisine): ?>
                                        <option value="<?php echo $cuisine['cuisine_id']?>"><?php echo htmlspecialchars($cuisine['cuisine_name']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Add Food" class="input-btn1" name="submit">
                    </form>
                </div>
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