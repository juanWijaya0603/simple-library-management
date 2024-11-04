<?php
// Database configuration
$host = '127.0.0.1';         // Database host, e.g., '127.0.0.1' or 'localhost'
$db   = 'librarymanagement'; // Name of your database
$user = 'root';      // Your database username
$pass = '';      // Your database password
$charset = 'utf8mb4';         // Character set

// Data Source Name (DSN) specifies the host, database name, and charset
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for error handling, data fetching, and security
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch data as associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulated prepared statements
];

try {
    // Create a new PDO instance (database connection)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Catch any errors and display a friendly message
    echo 'Database connection failed: ' . $e->getMessage();
    exit; // Stop execution if connection fails
}
?>
