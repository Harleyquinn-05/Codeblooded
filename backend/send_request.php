<?php
// This PHP block is only needed if you want to later process submitted data.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // You can store or process form data here if needed.
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skill Swap Request</title>
    <style>
        body {
            background-color: #0D0D0D;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            border: 2px solid white;
            padding: 30px 40px;
            border-radius: 20px;
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        select, textarea, button {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid white;
            background-color: #0D0D0D;
            color: white;
            font-size: 14px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        select:focus, textarea:focus {
            outline: none;
            border-color: #00ffff;
        }

        button {
            margin-top: 20px;
            background-color: #003344;
            border: 2px solid #ffffff;
            cursor: pointer;
        }

        button:hover {
            background-color: #005566;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Send Request</h2>

    <form id="skillForm" method="post">
        <label for="your_skill">Choose one of your offered skills</label>
        <select name="your_skill" id="your_skill" required>
            <option value="">--Select--</option>
            <option value="Video Editing">Video Editing</option>
            <option value="Coding">Coding</option>
            <option value="Designing">Designing</option>
            <option value="javascript">Jvascript</option>
            <option value="C++">C++</option>
            <option value="mongo DB">mongo DB</option>


        </select>

        <label for="their_skill">Choose one of their wanted skills</label>
        <select name="their_skill" id="their_skill" required>
            <option value="">--Select--</option>
            <option value="Public Speaking">Public Speaking</option>
            <option value="Marketing">Marketing</option>
            <option value="UI/UX">UI/UX</option>
            <option value="Bootstrap">Bootstrap</option>
            <option value="AI">AI</option>
            <option value="Cloud computing">Cloud computing</option>
        </select>

        <label for="message">Message</label>
        <textarea name="message" id="message" rows="4" placeholder="Write your message here..." required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<script>
    const form = document.getElementById('skillForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // stop default submission

        const yourSkill = document.getElementById('your_skill').value;
        const theirSkill = document.getElementById('their_skill').value;
        const message = document.getElementById('message').value.trim();

        if (yourSkill && theirSkill && message) {
            // Show confirmation then redirect
            alert("✅ Request has been sent!");
            window.location.href = 'home.php'; // Redirect to home page
        } else {
            alert("⚠️ Please fill all fields before submitting.");
        }
    });
</script>


</body>
</html>