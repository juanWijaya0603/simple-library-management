<?php
session_start();
include 'database.php'; // Koneksi ke database
if(isset($_POST['login'])){
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo '<script>alert("Username atau password tidak boleh kosong.")</script>';
    } else {

    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the posted form data
        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();



        if ($result->num_rows > 0) {
            if(password_verify($password, $row['password_hash'])){
                echo  '<script>alert("password benar")</script>' ;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Redirect based on role
                if ($row['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($row['role'] == 'librarian') {
                    header("Location: librarian_dashboard.php");
                } elseif($row['role'] == 'member') {
                    header("Location: member_dashboard.php");
                }
                exit;
            } else {
                echo '<script>alert("password salah")</script>' ;
            }
        } else {
            echo '<script>alert("username tidak terdaftar")</script>';
            }
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
            <input name="username" type="text" class="username" name="username" value=""><br>
            <label>password:</label><br>
            <input name="password" type="password" class="password" name="password" value=""><br><br>
            <input name="login"class="button-submit" type="submit" value="login">
        </form>   
    </div>
</body>
</html>

