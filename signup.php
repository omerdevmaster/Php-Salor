<?php

session_start();


require 'db.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    
    $card_number = !empty($_POST['card']) ? mysqli_real_escape_string($conn, $_POST['card']) : NULL;
    $cvv = !empty($_POST['cvv']) ? mysqli_real_escape_string($conn, $_POST['cvv']) : NULL;
    $expiry_month = !empty($_POST['expiry_month']) ? mysqli_real_escape_string($conn, $_POST['expiry_month']) : NULL;
    $expiry_year = !empty($_POST['expiry_year']) ? mysqli_real_escape_string($conn, $_POST['expiry_year']) : NULL;
    $zip_code = !empty($_POST['zip_code']) ? mysqli_real_escape_string($conn, $_POST['zip_code']) : NULL;

    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    
    $checkEmail = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists. Please choose another one.";
    } else {
        
        $query = "INSERT INTO users (email, password, name, card_number, cvv, expiry_month, expiry_year, zip_code) 
                  VALUES ('$email', '$hashed_password', '$name', '$card_number', '$cvv', '$expiry_month', '$expiry_year', '$zip_code')";

        if (mysqli_query($conn, $query)) {
            
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            
            
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    
    mysqli_close($conn);
}
?>
