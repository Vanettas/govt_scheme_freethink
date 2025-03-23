<?php
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<header>
    <div>
        <h1>Admin Panel - National Welfare Board</h1>
    </div>
    <nav>
        <ul class="nav-left">
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_schemes.php">Manage Schemes</a></li>
            <li><a href="manage_officials.php">Manage Official</a></li>
            <li><a href="applications.php">View Applications</a></li>
        </ul>

        <ul class="nav-right">
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
                <li class="dropdown">
                    <a href="#">Hello, Admin ▼</a>
                    <ul class="dropdown-content">
                        <li><a href="admin_settings.php">Settings</a></li>
                    </ul>
                </li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
