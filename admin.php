<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'admin_header.php'; // Include the admin-specific header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <main class="dashboard">
        <h2>Admin Dashboard</h2>
        <div class="dashboard-grid">
            <div class="card">
                <h3>Total Users</h3>
                <p>150</p>
            </div>
            <div class="card">
                <h3>Active Applications</h3>
                <p>32</p>
            </div>
            <div class="card">
                <h3>Approved Schemes</h3>
                <p>8</p>
            </div>
            <div class="card">
                <h3>Pending Requests</h3>
                <p>12</p>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
