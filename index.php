<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['username']))
 {
    header("Location: login.php");
    exit();
}
?>

<a href="logout.php">Logout</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Welfare Board (NWB)</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Include Header -->
    <?php include 'header.php'; ?>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <main>
        <!-- About Section -->
<section class="about">
    <div class="about-box">
        <h2>About NWB</h2>
        <p>
            The <strong>National Welfare Board (NWB)</strong> is dedicated to empowering individuals by providing 
            <span class="highlight">education, agriculture, and healthcare assistance</span>.  
            Our mission is to ensure financial support reaches those in need, fostering growth and well-being.
        </p>
        <a href="about.php" class="btn">Learn More</a>
    </div>
</section>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Empowering Communities, Changing Lives</h1>
                <p>Providing financial aid and welfare programs for a better future.</p>
                <a href="schemes.php" class="btn">Explore Schemes</a>
            </div>
        </section>

      

        <!-- Available Schemes -->
        <section class="schemes">
            <h2>Our Schemes</h2>
            <div class="scheme-list">
                <div class="scheme">
                    <h3>🎓 Education Assistance</h3>
                    <p>Scholarships and grants for students.</p>
                    <a href="education.php" class="btn-small">Learn More</a>
                </div>
                <div class="scheme">
                    <h3>🌾 Agricultural Subsidies</h3>
                    <p>Financial support for farmers.</p>
                    <a href="agriculture.php" class="btn-small">Learn More</a>
                </div>
            </div>
        </section>

        <!-- How to Apply -->
        <section class="how-to-apply">
            <h2>📋 How to Apply</h2>
            <div class="steps">
                <div class="step">
                    <h3>1️⃣ Register & Login</h3>
                    <p>Create your account to get started.</p>
                </div>
                <div class="step">
                    <h3>2️⃣ Select a Scheme</h3>
                    <p>Explore welfare programs.</p>
                </div>
                <div class="step">
                    <h3>3️⃣ Submit Application</h3>
                    <p>Upload documents and apply.</p>
                </div>
                <div class="step">
                    <h3>4️⃣ Track Status</h3>
                    <p>Monitor your application progress.</p>
                </div>
            </div>
        </section>

        <!-- Eligibility Check -->
        <section class="eligibility">
            <h2>🔍 Check Your Eligibility</h2>
            <p>Find out if you qualify for our welfare programs.</p>
            <a href="eligibility.php" class="btn">Check Now</a>
        </section>
<!-- ⭐ Testimonials Section -->
<!-- ⭐ Testimonials Section -->



        <!-- Contact -->
        <section class="contact">
            <h2>📞 Need Assistance?</h2>
            <p>Contact us for queries and support.</p>
            <a href="contact.php" class="btn">Get Support</a>
        </section>
    </main>

    <!-- Welcome Alert -->
    <script>
        window.onload = function() {
            let message = `
            🎉 Welcome to the National Welfare Board (NWB)!
            Please review our general guidelines:

            ✅ Apply for eligible schemes.
            ✅ Keep documents ready.
            ✅ Contact support if needed.

            Click "OK" to continue.
            `;
            alert(message);
        };
        

    </script>
<footer>
    <!-- Include Footer -->
    <?php include 'footer.php'; ?>
    </footer>

</body>
</html>
