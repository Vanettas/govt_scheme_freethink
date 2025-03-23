<?php
session_start();
include 'connection.php';

// Ensure user is logged in and has an engineer role
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['JE', 'AE', 'EE'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
$message = "";

// Handle status updates by AE and EE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status']) && in_array($role, ['AE', 'EE'])) {
    $app_id = intval($_POST['app_id']);
    $new_status = mysqli_real_escape_string($con, $_POST['status']);

    $query = "UPDATE applications SET status='$new_status' WHERE id=$app_id";
    if (mysqli_query($con, $query)) {
        $message = "Status updated successfully!";
    } else {
        $message = "Database error: " . mysqli_error($con);
    }
}

// Fetch applications and documents
$query = "SELECT * FROM applications";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2><?php echo $role; ?> Dashboard</h2>
    <?php if ($message) echo "<p class='success-message'>$message</p>"; ?>

    <table>
        <tr>
            <th>Application ID</th>
            <th>Applicant Name</th>
            <th>Document</th>
            <th>Status</th>
            <?php if ($role !== 'JE') echo "<th>Action</th>"; ?>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['applicant_name']; ?></td>
            <td>
                <?php if ($row['document_path']): ?>
                    <a href="<?php echo $row['document_path']; ?>" target="_blank">View Document</a>
                <?php else: ?>
                    No Document Uploaded
                <?php endif; ?>
            </td>
            <td><?php echo $row['status']; ?></td>

            <?php if ($role === 'AE' || $role === 'EE'): ?>
            <td>
                <form method="POST">
                    <input type="hidden" name="app_id" value="<?php echo $row['id']; ?>">
                    <select name="status" required>
                        <option value="Under Scrutiny">Under Scrutiny (AE)</option>
                        <option value="Approved">Approved (EE)</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
            <?php endif; ?>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
