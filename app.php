<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'header.php'; // Common header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Scheme</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-box" style="width: 70%; padding: 50px;">
    <h2>Apply for a Government Scheme</h2>
    <form action="submit_scheme.php" method="POST">
        <!-- Scheme Name -->
        <label for="scheme_name">Scheme Name:</label>
<select id="scheme_name" name="scheme_name" required>
    <option value="" disabled selected>--- Select Scheme ---</option>
    <option value="Education">Education</option>
    <option value="Agriculture">Agriculture</option>
</select>
<br>
            <legend>Applicant Details</legend>
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <label>Gender:</label>
<div class="gender-options">
    <input type="radio" name="gender" value="Male" required> <label>Male</label>
    <input type="radio" name="gender" value="Female"> <label>Female</label>
    <input type="radio" name="gender" value="Other"> <label>Other</label>
</div>
     <br><label>Address</label>
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="pincode">PIN Code:</label>
            <input type="text" id="pincode" name="pincode" required pattern="\d{6}">
        

        <!-- Contact Information -->
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}">

        <label for="email">Email (if applicable):</label>
        <input type="email" id="email" name="email">

     
            <legend>Income & Eligibility Details</legend>
            <label for="income">Annual Income (₹):</label>
            <input type="number" id="income" name="income" required>

            <label>Category:</label>
            <div class="gender-options">
            <input type="radio" name="category" value="General" required> General
            <input type="radio" name="category" value="SC"> SC
            <input type="radio" name="category" value="ST"> ST
            <input type="radio" name="category" value="OBC"> OBC
            <input type="radio" name="category" value="Others"> Others
</div>
<br><br>
<div class="gender-options">
            <label>Currently availing benefits from another government scheme?</label>
            <input type="radio" name="other_scheme" value="Yes" required> Yes
            <input type="radio" name="other_scheme" value="No"> No
</div>
       

        <!-- Bank Account Details -->
     
            <legend>Bank Account Details</legend>
            <label for="bank_name">Bank Name:</label>
            <input type="text" id="bank_name" name="bank_name" required>

            <label for="account_number">Account Number:</label>
            <input type="text" id="account_number" name="account_number" required>

            <label for="ifsc">IFSC Code:</label>
            <input type="text" id="ifsc" name="ifsc" required>
       

        <button type="submit">Submit Application</button>
    </form>
</div>

<?php include 'footer.php'; // Common footer ?>

</body>
</html>
