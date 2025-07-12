<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Skill Swap Platform</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            background: linear-gradient(to right, #f8f9fa, #e3f2fd);
            color: #333;
        }

        h1 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.button {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        form.swap-form input {
            padding: 5px;
            width: 90%;
        }

        form.swap-form button {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        form.swap-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Skill Swap Users</h1>
    <a class="button" href="add_skill.php">➕ Add New Skill</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Skill</th>
            <th>Send Swap Request</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['skill']}</td>
                    <td>
                        <form class='swap-form' method='POST' action='request_swap.php'>
                            <input type='hidden' name='from_user_id' value='1'> <!-- Change this to current user ID if using auth -->
                            <input type='hidden' name='to_user_id' value='{$row['id']}'>
                            <input type='text' name='offered_skill' placeholder='Your Skill' required><br>
                            <input type='text' name='requested_skill' placeholder='Skill You Want' required><br>
                            <button type='submit'>Send</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
