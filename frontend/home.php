<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Skill Swap — CodeBlooded</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #0f0f0f;
      color: #f0f0f0;
      line-height: 1.6;
    }

    header {
      background: #1a1a1a;
      padding: 25px 15px;
      text-align: center;
      border-bottom: 2px solid #00fff7;
    }

    header h1 {
      font-size: 2.5em;
      color: #00fff7;
      margin-bottom: 5px;
    }

    header p {
      color: #bbbbbb;
      font-size: 1.1em;
      font-style: italic;
    }

    nav {
      margin-top: 15px;
    }

    nav a {
      color: #f5f5f5;
      text-decoration: none;
      margin: 0 20px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    nav a:hover {
      color: #00adb5;
    }

    .hero {
      padding: 60px 20px;
      background: linear-gradient(to right, #202020, #333333);
      text-align: center;
    }

    .hero h2 {
      font-size: 2.5em;
      margin-bottom: 15px;
    }

    .hero p {
      font-size: 1.1em;
      color: #cccccc;
    }

    .about {
      padding: 50px 25px;
      max-width: 900px;
      margin: auto;
      text-align: center;
    }

    .about h3 {
      font-size: 2em;
      color: #00adb5;
      margin-bottom: 15px;
    }

    .about p {
      font-size: 1em;
      color: #aaaaaa;
    }

    .btn {
      margin-top: 30px;
      padding: 12px 25px;
      background-color: #00adb5;
      color: #0f0f0f;
      border: none;
      font-size: 1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #00fff7;
    }

    footer {
      background: #1a1a1a;
      padding: 20px;
      text-align: center;
      color: #666;
      font-size: 0.9em;
      margin-top: 40px;
    }

    @media (max-width: 600px) {
      header h1 {
        font-size: 1.8em;
      }
      .hero h2 {
        font-size: 2em;
      }
      nav a {
        display: block;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Skill Swap</h1>
    <p>CodeBlooded — Exchange Skills. Empower Each Other. Code with Passion.</p>
    <nav>
      <a href="add_skill.php">Login</a>
      <a href="show_request.php">Show request</a>
      <a href="edit.php">Profile</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Welcome to the Skill Swap Platform</h2>
    <p>Find your coding match. Share your talent. Grow together in the CodeBlooded community.</p>
    <section class="hero">
  <a href="index.php"><button class="btn">Get Started</button></a>
</section>

  </section>

  <section class="about">
    <h3>About CodeBlooded</h3>
    <p>
      Skill Swap by CodeBlooded is a community-driven app where tech lovers trade skills—
      whether it's web design for data analysis, Python for UI/UX, or cybersecurity for digital marketing.
      Build your profile, find your perfect skill match, and grow together!
    </p>
  </section>

  <footer>
    &copy; 2025 Skill Swap by CodeBlooded. All rights reserved.
  </footer>

</body>
</html>