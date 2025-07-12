<?php
session_start();
include 'db.php';

// Fetch logged-in user data
$email = $_SESSION['email'] ?? null;
if (!$email) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $skills_offered = $_POST['skills_offered'];
    $skills_wanted = $_POST['skills_wanted'];
    $availability = $_POST['availability'];
    $profile = $_POST['profile'];

    $update = "UPDATE ind SET name='$name', skills_offered='$skills_offered', 
               skills_wanted='$skills_wanted', availability='$availability', profile='$profile' 
               WHERE email='$email'";
    $conn->query($update);
    header("Location: test.php?saved=1");
    exit();
}

$id = $_SESSION['id'];
$result = $conn->query("SELECT * FROM ind WHERE id = $id");

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #111;
            color: white;
            padding: 30px;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .nav .buttons {
            display: flex;
            gap: 15px;
        }

        form {
            background-color: #1c1c1c;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 20px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type=text], select {
            width: 100%;
            padding: 8px;
            background-color: #222;
            color: white;
            border: 1px solid #444;
            border-radius: 5px;
        }

        .tag-area {
            margin-top: 10px;
        }

        .tag {
            display: inline-block;
            background: #444;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 5px 5px 5px 0;
        }

        .save-btn, .discard-btn {
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .save-btn {
            background-color: #00cc66;
            color: white;
        }

        .discard-btn {
            background-color: #cc0000;
            color: white;
            margin-left: 10px;
        }

        .row {
            display: flex;
            gap: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .success {
            color: limegreen;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="nav">
    <div>
        <a href="home.php">Home</a>
    </div>
    <div class="buttons">
        <form method="POST" action="">
            <button type="submit" class="save-btn">Save</button>
        </form>
        <form method="GET" action="profile.php">
            <button type="submit" class="discard-btn">Discard</button>
        </form>
    </div>
</div>

<form method="POST" action="">
    <h2>Edit Profile</h2>

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <div class="row">
        <div style="flex: 1;">
            <label>Skills Offered (comma-separated):</label>
            <input type="text" name="skills_offered" value="<?= htmlspecialchars($user['skills_offered']) ?>" required>
        </div>
        <div style="flex: 1;">
            <label>Skills Wanted (comma-separated):</label>
            <input type="text" name="skills_wanted" value="<?= htmlspecialchars($user['skills_wanted']) ?>" required>
        </div>
    </div>

    <label>Availability:</label>
    <input type="text" name="availability" value="<?= htmlspecialchars($user['availability']) ?>" required>

    <label>Profile:</label>
    <select name="profile" required>
        <option value="Public" <?= $user['profile'] === 'Public' ? 'selected' : '' ?>>Public</option>
        <option value="Private" <?= $user['profile'] === 'Private' ? 'selected' : '' ?>>Private</option>
    </select>

    <?php if (isset($_GET['saved'])): ?>
        <p class="success">Profile saved successfully!</p>
    <?php endif; ?>
</form>

</body>
</html>
