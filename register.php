<?php
session_start();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm = trim($_POST['confirm']);

  if ($username === "" || $password === "" || $confirm === "") {
    $error = "All fields are required.";
  } elseif ($password !== $confirm) {
    $error = "Passwords do not match.";
  } else {
    $file = "users.txt";
    $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

    foreach ($users as $user) {
      list($savedUser, $savedPass) = explode("|", $user);
      if ($savedUser === $username) {
        $error = "Username already exists.";
        break;
      }
    }

    if ($error === "") {
      $newUser = "$username|$password\n";
      file_put_contents($file, $newUser, FILE_APPEND);
      $success = "Registered successfully! Redirecting to login...";
      echo "<script>setTimeout(() => { window.location.href='login.php'; }, 2000);</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - GoDaddy Clone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-box {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
      width: 100%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
    .message {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }
    .error { color: red; }
    .success { color: green; }
    .footer {
      text-align: center;
      margin-top: 15px;
    }
    .footer a {
      color: #007bff;
      text-decoration: none;
    }
    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="register-box">
  <h2>Create Account</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required/>
    <input type="password" name="password" placeholder="Password" required/>
    <input type="password" name="confirm" placeholder="Confirm Password" required/>
    <button type="submit">Register</button>
    <div class="message error"><?= $error ?></div>
    <div class="message success"><?= $success ?></div>
  </form>
  <div class="footer">
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>

</body>
</html>
