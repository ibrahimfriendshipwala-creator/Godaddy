<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>window.location.href='login.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .checkout {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px #aaa;
      max-width: 400px;
      width: 100%;
    }
    h2 {
      color: #28a745;
    }
    .btn {
      margin-top: 20px;
      padding: 12px 20px;
      font-size: 16px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="checkout">
    <h2>🎉 Checkout Successful!</h2>
    <p>Your domain(s) have been registered successfully (simulated).</p>
    <button class="btn" onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
  </div>
</body>
</html>
