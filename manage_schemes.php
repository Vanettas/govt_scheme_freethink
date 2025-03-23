<?php
session_start();
include 'connection.php'; // Database connection
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}


include 'admin_header.php'; // Common header for admin panel

// Handle form submission for adding a new scheme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['scheme_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $eligibility = mysqli_real_escape_string($con, $_POST['eligibility']);
    $benefits = mysqli_real_escape_string($con, $_POST['benefits']);

    $query = "INSERT INTO schemes (name, description, eligibility, benefits) VALUES ('$name', '$description', '$eligibility', '$benefits')";
    
    if (mysqli_query($con, $query)) {
        $message = "Scheme added successfully!";
    } else {
        $message = "Error adding scheme: " . mysqli_error($con);
    }
}

// Handle scheme deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_query = "DELETE FROM schemes WHERE id=$id";

    if (mysqli_query($con, $delete_query)) {
        $message = "Scheme deleted successfully!";
    } else {
        $message = "Error deleting scheme: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Schemes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Manage Government Schemes</h2>

    <?php if (isset($message)) echo "<p class='success-message'>$message</p>"; ?>

    <!-- Form to Add a New Scheme -->
    <div class="login-box" style="width: 80%; padding: 20px;">
        <h3>Add New Scheme</h3>
        <form action="manage_schemes.php" method="POST">
            <label for="scheme_name">Scheme Name:</label>
            <input type="text" id="scheme_name" name="scheme_name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="eligibility">Eligibility Criteria:</label>
            <textarea id="eligibility" name="eligibility" required></textarea>

            <label for="benefits">Benefits:</label>
            <textarea id="benefits" name="benefits" required></textarea>

            <button type="submit">Add Scheme</button>
        </form>
    </div>

    <!-- List of Existing Schemes -->
    <div class="officials-list">
        <h3>Existing Schemes</h3>
        <table>
            <tr>
                <th>Scheme Name</th>
                <th>Description</th>
                <th>Eligibility</th>
                <th>Benefits</th>
                <th>Actions</th>
            </tr>

            <?php
            $query = "SELECT * FROM schemes";
            $result = mysqli_query($con, $query);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['eligibility'] . "</td>";
                    echo "<td>" . $row['benefits'] . "</td>";
                    echo "<td>
                            <a href='edit_scheme.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a href='manage_schemes.php?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No schemes found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include 'footer.php'; // Common footer ?>
</body>
</html>
