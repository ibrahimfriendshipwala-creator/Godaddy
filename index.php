<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $domain = trim($_POST['domain'] ?? '');
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  if ($domain && !in_array($domain, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $domain;
  }
  echo "<script>window.location.href='cart.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GoDaddy Clone - Home</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f2f2f2;
    }
    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .domain-form input[type="text"] {
      width: 70%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }
    .domain-form button {
      padding: 10px 20px;
      background: #28a745;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    .popular {
      margin-top: 20px;
      font-size: 14px;
    }
    .popular span {
      background: #eee;
      padding: 5px 10px;
      margin: 5px;
      display: inline-block;
      border-radius: 5px;
    }
    .links {
      text-align: center;
      margin-top: 30px;
    }
    .links a {
      color: #007bff;
      text-decoration: none;
      margin: 0 10px;
    }
    .cart-btn {
      margin-top: 20px;
      text-align: center;
    }
    .cart-btn button {
      background: #007bff;
      color: white;
      padding: 10px 15px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <header>
    <h1>GoDaddy Clone</h1>
  </header>

  <div class="container">
    <form class="domain-form" method="POST" action="">
      <input type="text" name="domain" placeholder="Enter domain name (e.g., example.com)" required>
      <button type="submit">Add to Cart</button>
    </form>

    <div class="popular">
      <strong>Popular Extensions:</strong>
      <span>.com</span><span>.net</span><span>.org</span><span>.co</span><span>.info</span>
    </div>

    <div class="cart-btn">
      <button onclick="window.location.href='cart.php'">🛒 View Cart</button>
    </div>

    <div class="links">
      <a href="register.php">Register</a> |
      <a href="login.php">Login</a> |
      <a href="dashboard.php">Dashboard</a>
    </div>
  </div>
</body>
</html>
