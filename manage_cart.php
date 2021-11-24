<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addToCart'])) {
        if(isset($_SESSION['id'])){
            if (isset($_SESSION['cart'])) {
                $cartItems = array_column($_SESSION['cart'], 'id');
                if (in_array($_POST['id'], $cartItems)) {
                    echo '<script>
                            alert("food already in cart");
                            window.location.href="about.php";
                        </script>';
                } else {
    
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = array(
                        'foodName' => $_POST['name'], 
                        'id' => $_POST['id'],
                        'storeid' => $_POST['storeid'],
                        'image' => $_POST['image'],
                        'quantity' => $_POST['quantity'], 
                        'price' => $_POST['price']);
    
                    echo '<script>
                            alert("food added to cart");
                            window.location.href="cart.php";
                        </script>';
                }
            } else {
                $_SESSION['cart'][0] = array(
                    'foodName' => $_POST['name'],
                    'id' => $_POST['id'],
                    'storeid' => $_POST['storeid'],
                    'image' => $_POST['image'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price']
                );
    
                echo '<script>
                            alert("food added to cart");
                            window.location.href="cart.php";
                    </script>';
            }
        }else{
            echo '<script>
                            alert("Please Log In");
                            window.location.href="login.php";
                </script>';
        }
        
    }
}
