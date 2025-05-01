<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Simpan nama pengguna yang login
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}
$current_user = $_SESSION['username'];

// Query untuk menampilkan data pengguna
$sql = "SELECT * FROM users WHERE username = '$current_user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil data pengguna dari query
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $password = $row['password'];
} else {
    echo "No user data found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $username; ?>!</h2> <!-- Rentan terhadap XSS -->
        <p>Your current password: <?php echo $password; ?></p> <!-- Rentan terhadap XSS -->

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
