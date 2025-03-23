<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($con)); // Debugging for SQL errors
    }

    $user = mysqli_fetch_assoc($result);
    if ($user) {
        // Debugging: Check password
        // echo "Stored Password: " . $user['password'] . "<br>";

        if ($user['password']==$password) { // Ensure password is hashed in DB
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "<script>
            alert('Logging in as User: $username!');
            window.location.href = 'index.php';
      </script>";

            exit();
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    }

    // Check in officials table
    $sql = "SELECT * FROM officials WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    $official = mysqli_fetch_assoc($result);

    if ($official && password_verify($password, $official['password'])) {
        $_SESSION['user_id'] = $official['id'];
        $_SESSION['username'] = $official['username'];
        $_SESSION['role'] = $official['role']; // je, ae, or ee
        header("Location: official.php");
        exit();
    }

    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['username'] = 'admin';
    
        echo "<script>
                alert('Logging in as Admin!');
                window.location.href = 'admin.php';
              </script>";
        exit();
    }
    
    
    // Show error message if no user found
    echo "<script>alert('Invalid credentials!'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Welfare Board (NWB)</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div>
        <h1>National Welfare Board (NWB)</h1>
    </div>
</header>

<div class="login-box">
    <h2>Login</h2>
    <form method="POST" action="" onsubmit="return validateLogin();">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

<script>
    function validateLogin() {
        let username = document.getElementById("username").value.trim();
        let password = document.getElementById("password").value.trim();

        if (username === "" || password === "") {
            alert("Please enter a username and password.");
            return false;
        }
        if (password.length < 8) {
            alert("Password must be at least 8 characters long.");
            return false;
        }
        return true;
    }
</script>

<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
