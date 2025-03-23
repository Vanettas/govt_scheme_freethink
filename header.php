<header>
    <div>
        <h1>National Welfare Board</h1>
    </div>
    <nav>
        <ul class="nav-left">
            <li><a href="index.php">Home</a></li>
            <li>
                <a href="app.php">Apply a Scheme</a>
            </li>
            <li><a href="track.php">Track your application</a></li>
            <li><a href="eligibility.php">Eligibility</a></li> <!-- Added Eligibility Option -->
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            
        </ul>

        <ul class="nav-right">
    <?php if (isset($_SESSION['username'])): ?>
        <li class="dropdown">
            <a href="#">Hello, <?php echo $_SESSION['username']; ?> ▼</a>
            <ul class="dropdown-content">
                <li><a href="application.php">Applications</a></li>
            </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
</ul>

    </nav>
</header>
<script>
    function toggleMenu() {
        document.querySelector('nav').classList.toggle('active');
    }
    </script>