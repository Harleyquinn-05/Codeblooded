<?php
session_start();
include 'db.php';

// Pagination setup
$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch users
$sql = "SELECT * FROM ind LIMIT $offset, $limit";

$result = $conn->query($sql);

// Count total
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM ind")->fetch_assoc()['total'];

$totalPages = ceil($totalUsers / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skill Swap Platform</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #111;
            color: white;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-section {
            display: flex;
            gap: 10px;
        }

        .card {
            background-color: #1c1c1c;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            position: relative;
        }

        .name {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .skills {
            margin-bottom: 10px;
        }

        .skills span {
            background: #333;
            padding: 5px 10px;
            border-radius: 15px;
            margin: 3px;
            display: inline-block;
        }

        .request-btn {
            background-color: teal;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .request-btn:hover {
            background-color: #00b3b3;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #fff;
            padding: 8px 12px;
            margin: 2px;
            text-decoration: none;
            background-color: #333;
            border-radius: 4px;
        }

        .pagination a.active {
            background-color: teal;
        }

        .rating {
            font-size: 0.9em;
            color: #ccc;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Skill Swap Platform</h2>
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
            <?php else: ?>
                <a href="login.php" style="color: teal; font-weight: bold;">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
            <div class="name"><?= htmlspecialchars($row['name']) ?></div>
            <div class="skills">
                <strong style="color: #00cc66;">Skills Offered => </strong>
                <?php foreach (explode(',', $row['skills_offered']) as $skill): ?>
                    <span><?= htmlspecialchars(trim($skill)) ?></span>
                <?php endforeach; ?>
            </div>
            <div class="skills">
                <strong style="color: #3399ff;">Skills Wanted => </strong>
                <?php foreach (explode(',', $row['skills_wanted']) as $skill): ?>
                    <span><?= htmlspecialchars(trim($skill)) ?></span>
                <?php endforeach; ?>
            </div>
            
            <button class="request-btn" onclick="handleRequest(<?= $row['id'] ?>)">Request</button>
        </div>
    <?php endwhile; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($page == $i) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>

<script>
    function handleRequest(userId) {
        <?php if (!isset($_SESSION['username'])): ?>
        alert("Please login to send a request.");
        window.location.href = "add_skill.php";
        <?php else: ?>
        window.location.href = "request_swap.php?to_id=" + userId;
        <?php endif; ?>
    }
</script>
</body>
</html>
