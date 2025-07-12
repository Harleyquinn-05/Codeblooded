<?php
// add_skill.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $skill = $_POST['skill'];

    $conn = new mysqli("localhost", "root", "", "skill_swap_platform"); // update db name

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, skill) VALUES ('$name', '$email', '$skill')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>New user added successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Skill</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background: linear-gradient(to right, #f8f9fa, #e3f2fd);
        }

        h2 {
            color: #2c3e50;
        }

        form {
            background-color: white;
            padding: 30px;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type=text],
        input[type=email],
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Add New User with Skill</h2>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="skill">Skill:</label>
    <input type="text" name="skill" required>

    <button type="submit">Add User</button>
</form>

<a href="index.php">← Back to Home</a>

</body>
</html>