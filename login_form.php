<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Add your styling here */
        body {
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    
    <!-- Display Error Messages -->
    <div id="error" class="error">
        <?php
        session_start(); // Start the session to access session variables
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error']; // Display the error message
            unset($_SESSION['error']); // Unset the error after displaying it
        }
        ?>
    </div>

    <form id="loginForm" method="POST" action="login.php">
        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>
    <p><a href="#">Forgot Your Password?</a></p>
</div>

<script>
    // Adding JavaScript validation on form submission
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let errorMessage = "";

        // Email validation
        if (!email) {
            errorMessage += "Email is required.\n";
        } else if (!validateEmail(email)) {
            errorMessage += "Please enter a valid email address.\n";
        }

        // Password validation
        if (!password) {
            errorMessage += "Password is required.\n";
        }

        // If errors exist, display them and prevent form submission
        if (errorMessage) {
            e.preventDefault(); // Prevent form from submitting
            document.getElementById("error").innerText = errorMessage; // Show errors
        }
    });

    // Helper function to validate email format
    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }
</script>

</body>
</html>
