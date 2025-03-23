<?php
session_start();
include 'connection.php'; // Database connection
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'admin_header.php'; // Common header for admin panel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Officials</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Manage Officials</h2>
    
    <!-- Form to Add a New Official -->
    <div class="login-box" style="width: 100%; padding: 20px;">
        <h3>Add New Official</h3>
        <form action="add_official.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}">
            <p><label for="username">Username:</label> <input type="text" id="username" name="username" required></p>
            <p><label for="password">Password:</label> <input type="password" id="password" name="password" required></p>
            <p><label for="password1">Re-type Password:</label> <input type="password" id="password1" name="password1" required></p>
            <label>Gender:</label>
<div class="gender-options">
    <input type="radio" name="gender" value="Male" required> <label>Male</label>
    <input type="radio" name="gender" value="Female"> <label>Female</label>
    <input type="radio" name="gender" value="Other"> <label>Other</label>
</div>
            <p>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" min="0" max="65" required placeholder="Enter your age">
</p>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>--- Select Role ---</option>
                <option value="je">JE</option>
                <option value="ae">AE</option>
                <option value="ee">EE</option>
            </select>

            <button type="submit">Add Official</button>
        </form>
    </div>

    <!-- List of Officials -->
    <div class="officials-list">
        <h3>Existing Officials</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Age(in years)</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php
            $query = "SELECT * FROM officials";
            $result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>
                        <a href='edit_official.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='delete_official.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else
            {
                echo "<tr><td colspan='8'>No officials found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<script type="text/javascript">

        function validate() {

            var nm = document.getElementById("name").value.trim();
            var nameRegex = /^[a-zA-Z\s]+$/;  // Allows only letters and spaces
            if (nm == "" || !nameRegex.test(nm) || nm.length > 25 || nm.length < 2) {
                alert("Please Enter a valid name with only letters and spaces, between 2-25 characters.");
                return false;
            }

            var uname = document.getElementById("username").value.trim();
            var usernameRegex = /^[a-zA-Z0-9]+$/;  // Allows only letters and numbers
            if (uname == "" || !usernameRegex.test(uname) || uname.length > 15 || uname.length < 2) {
                alert("Please enter a valid username with only letters and numbers, between 2-15 characters.");
                return false;
            }

            var age = document.getElementById("age");
            if (age.value == "") {
                alert("Please enter your age");
                return false;
            }
            if (isNaN(age.value) || age.value.length < 1 || age.value.length > 2) {
                alert("Age must be a number between 1 and 99");
                age.focus();
                return false;
            }

            var pass = document.getElementById("password");
            var pass1 = document.getElementById("password1")
            if (pass.value == "") {
                alert("Please enter your password");
                return false;
            }
            if (pass.value !== pass1.value) {
                alert("Passwords do not match");
                return false;
            }

            var gender = document.getElementsByName("Gender")[0];
            if (gender.value == "none") {
                alert("Please select your gender");
                return false;
            }

            var ph = document.getElementById("PhoneNumber");
            if (ph.value == "") {
                alert("Please enter your mobile no.");
                return false;
            }
            if (isNaN(ph.value) || ph.value.length != 10) {
                alert("mobile number must have 10 digits");
                ph.focus();
                return false;
            }


        }

    </script>
<?php include 'footer.php'; // Common footer ?>
</body>
</html>
