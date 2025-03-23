<?php
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Default role must be 'user' (restricting other roles)
    $role = 'user';

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
