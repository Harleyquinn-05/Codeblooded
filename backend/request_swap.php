<?php
session_start();
include 'db.php';

$loggedIn = isset($_SESSION['id']);
$from_user_id = $loggedIn ? $_SESSION['id'] : null;

// Get the target user ID from URL
if (!isset($_GET['to_id'])) {
    echo "Invalid user.";
    exit();
}

$to_user_id = intval($_GET['to_id']);

// Prevent sending request to self
if ($loggedIn && $to_user_id == $from_user_id) {
    echo "You cannot request a swap with yourself.";
    exit();
}

// Fetch user details
$sql = "SELECT * FROM ind WHERE id = $to_user_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "User not found.";
    exit();
}
$user = $result->fetch_assoc();

$message = "";

// Handle request only if logged in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($loggedIn) {
        $requested_skill = $_POST['requested_skill'];
        $offered_skill = $_POST['offered_skill'];

        $insert = "INSERT INTO swap_requests (from_user_id, to_user_id, requested_skill, offered_skill, status, created_at)
                   VALUES ('$from_user_id', '$to_user_id', '$requested_skill', '$offered_skill', 'pending', NOW())";

        if ($conn->query($insert) === TRUE) {
            $message = "✅ Swap request sent successfully!";
        } else {
            $message = "❌ Error: " . $conn->error;
        }
    } else {
        $message = "🔒 Please login to send a swap request.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Swap</title>
    <style>
        body {
            background-color: #111;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #1c1c1c;
            border-radius: 10px;
            padding: 30px;
        }

        h2 {
            font-size: 24px;
        }

        .label {
            font-weight: bold;
            margin-top: 20px;
        }

        .skill-tags {
            background-color: #444;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 5px 5px 0 0;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            color: #ccc;
            margin-right: 20px;
            text-decoration: none;
        }

        .request-btn {
            background-color: #008080;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .feedback {
            margin-top: 30px;
            font-style: italic;
        }

        .msg {
            margin-top: 20px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: limegreen;
        }
    </style>
</head>
<body>

<div class="nav">
    <a href="index.php">Home</a>
    
</div>

<div class="container">
    <h2><?= htmlspecialchars($user['name']) ?></h2>

    <div class="label">Skills Offered:</div>
    <?php foreach (explode(',', $user['skills_offered']) as $skill): ?>
        <span class="skill-tags"><?= htmlspecialchars(trim($skill)) ?></span>
    <?php endforeach; ?>

    <div class="label">Skills Wanted:</div>
    <?php foreach (explode(',', $user['skills_wanted']) as $skill): ?>
        <span class="skill-tags"><?= htmlspecialchars(trim($skill)) ?></span>
    <?php endforeach; ?>

    <div class="label">Availability:</div>
    <p><?= htmlspecialchars($user['availability']) ?></p>

    <div class="label">Rating and Feedback:</div>
    <p class="feedback">⭐ <?= $user['rating'] ?? 'Not rated yet' ?>/5</p>

 <div style="margin-top: 30px;">
    <form action="send_request.php" method="get">
        <button type="submit" class="request-btn">Request</button>
    </form>
</div>


   <?php if ($loggedIn): ?>
    <form method="POST">
        <input type="hidden" name="offered_skill" value="N/A">
        <input type="hidden" name="requested_skill" value="N/A">
        
    </form>


<?php endif; ?>

</div>

</body>
</html>
