<?php
session_start();
include 'db.php'; // Include your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare a safe SQL query using prepared statements
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters to the query
    mysqli_stmt_bind_param($stmt, "s", $email);
    
    // Execute the query
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];

            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            // Set error message for invalid credentials
            $_SESSION['error'] = "Invalid email or password.";
        }
    } else {
        // Set error message for invalid credentials
        $_SESSION['error'] = "Invalid email or password.";
    }

    // Redirect back to the login page if there's an error
    header("Location: login_form.php");
    exit();
}
