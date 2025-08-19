<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>window.location.href='login.php';</script>";
  exit();
}

$cartItems = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      padding: 20px;
    }
    .cart {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    h2 {
      text-align: center;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    .btn {
      display: block;
      margin: 20px auto;
      padding: 12px 20px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="cart">
    <h2>Your Cart</h2>

    <?php if (count($cartItems) > 0): ?>
      <ul>
        <?php foreach ($cartItems as $item): ?>
          <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
      </ul>
      <button class="btn" onclick="window.location.href='proceed_checkout.php'">✅ Proceed to Checkout</button>
    <?php else: ?>
      <p style="text-align:center;">Your cart is empty.</p>
    <?php endif; ?>
  </div>
</body>
</html>
