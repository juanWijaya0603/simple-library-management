<?php
session_start();
include 'database.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        echo '<script>alert("Username atau password tidak boleh kosong.")</script>';
    } else {
        // Search for the user by username
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Verify the password
        if ($user && password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: /admin_dashboard.php");
            } elseif ($user['role'] == 'librarian') {
                header("Location: /librarian_dashboard.php");
            } else {
                header("Location: /member_dashboard.php");
            }
            exit;
        } else {
            echo '<script>alert("Username atau password salah.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/index.css">
</head>
<body>
    <div class="login-card">            
        <h3>Login Page</h3>
        <form class="credentials" action="login.php" method="POST">
            <label>username:</label><br>
            <input type="text" class="username" name="username" value=""><br>
            <label>password:</label><br>
            <input type="password" class="password" name="password" value=""><br><br>
            <input class="button-submit" type="submit" value="Submit">
        </form>   
    </div>
</body>
</html>
