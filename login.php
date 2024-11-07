<?php
session_start();
include 'database.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted form data
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        if(password_verify($password, $row['password_hash'])){
            echo '<script>alert("berhasil")</script>';

        }
    } else {
        echo '<script>alert("username tidak terdaftar")</script>';
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
            <?php
                if (empty($username) || empty($password)) {
                    echo '<script>alert("Username atau password tidak boleh kosong.")</script>';
                }
            ?>
        </form>   
    </div>
</body>
</html>
