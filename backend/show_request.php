<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$currentUserId = $_SESSION['id'];

// Accept/Reject Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['request_id'])) {
    $status = $_POST['action'] === 'accept' ? 'accepted' : 'rejected';
    $requestId = intval($_POST['request_id']);
    $conn->query("UPDATE swap_requests SET status = '$status' WHERE id = $requestId AND to_user_id = $currentUserId");
}

// Fetch requests directed to current user
$requests = $conn->query("
    SELECT sr.*, u.name, u.skills_offered, u.skills_wanted
    FROM swap_requests sr
    JOIN ind u ON sr.from_user_id = u.id
    WHERE sr.to_user_id = $currentUserId
    ORDER BY sr.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Swap Requests</title>
    <style>
        body {
            background-color: #111;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .request-card {
            background-color: #1c1c1c;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px #000;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
        }

        .tag {
            display: inline-block;
            background: #444;
            padding: 5px 10px;
            border-radius: 20px;
            margin-right: 8px;
        }

        .status {
            font-weight: bold;
            margin-top: 10px;
        }

        .pending { color: #ffc107; }
        .accepted { color: #00cc66; }
        .rejected { color: #ff4444; }

        .actions {
            margin-top: 15px;
        }

        .actions form {
            display: inline;
        }

        .accept-btn, .reject-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .accept-btn {
            background-color: #28a745;
            color: white;
            margin-right: 10px;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
        }

        .rating {
            margin-top: 5px;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="header">
    <div><h2>Skill Swap Requests</h2></div>
    <div><a href="index.php">Home</a></div>
</div>

<?php while ($row = $requests->fetch_assoc()): ?>
    <div class="request-card">
        <div class="name"><?= htmlspecialchars($row['name']) ?></div>
        <div>
            <strong>Skills Offered:</strong>
            <?php foreach (explode(',', $row['offered_skill']) as $s): ?>
                <span class="tag"><?= htmlspecialchars(trim($s)) ?></span>
            <?php endforeach; ?>
        </div>
        <div>
            <strong>Skills Wanted:</strong>
            <?php foreach (explode(',', $row['requested_skill']) as $s): ?>
                <span class="tag"><?= htmlspecialchars(trim($s)) ?></span>
            <?php endforeach; ?>
        </div>
        <div class="rating">⭐ <?= $row['rating'] ?? 'Not rated yet' ?>/5</div>

        <div class="status <?= $row['status'] ?>">
            Status: <?= ucfirst($row['status']) ?>
        </div>

        <?php if ($row['status'] === 'pending'): ?>
            <div class="actions">
                <form method="post">
                    <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="accept">
                    <button type="submit" class="accept-btn">Accept</button>
                </form>
                <form method="post">
                    <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="reject">
                    <button type="submit" class="reject-btn">Reject</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
<?php endwhile; ?>

</body>
</html>
