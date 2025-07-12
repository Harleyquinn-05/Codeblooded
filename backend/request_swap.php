<?php
// request_swap.php
$conn = new mysqli("localhost", "root", "", "skill_swap_platform");
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $from_user_id = $_POST['from_user_id'];  // User sending the request
    $to_user_id = $_POST['to_user_id'];      // User receiving the request
    $requested_skill = $_POST['requested_skill'];
    $offered_skill = $_POST['offered_skill'];

    // DB connection (update with your credentials)
    $conn = new mysqli("localhost", "root", "", "skill_swap_platform");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into swap_requests table
    $sql = "INSERT INTO swap_requests (from_user_id, to_user_id, requested_skill, offered_skill, status, created_at)
            VALUES ('$from_user_id', '$to_user_id', '$requested_skill', '$offered_skill', 'pending', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Swap request sent successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!-- Optional HTML form to test -->
<!DOCTYPE html>
<html>
<head>
    <title>Request Swap</title>
</head>
<body>
    <h2>Send Skill Swap Request</h2>
    <form method="post" action="">
        <label>From User ID:</label><br>
        <input type="number" name="from_user_id" required><br><br>

        <label>To User ID:</label><br>
        <input type="number" name="to_user_id" required><br><br>

        <label>Skill You Are Offering:</label><br>
        <input type="text" name="offered_skill" required><br><br>

        <label>Skill You Want:</label><br>
        <input type="text" name="requested_skill" required><br><br>

        <button type="submit">Send Request</button>
    </form>
</body>
</html>
