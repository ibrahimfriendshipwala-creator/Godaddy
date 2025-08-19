<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>window.location.href='login.php';</script>";
  exit();
}

$domains = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - GoDaddy Clone</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f9f9f9;
      color: #333;
    }
    header {
      background-color: #111;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 900px;
      margin: auto;
      padding: 2rem;
      background: white;
      border-radius: 10px;
      margin-top: 2rem;
      box-shadow: 0 0 10px #ccc;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #333;
      color: white;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      background-color: #dc3545;
      color: white;
    }
    .btn:hover {
      background-color: #bd2130;
    }
    .actions {
      margin-top: 20px;
      text-align: center;
    }
    .actions button {
      margin: 5px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .actions button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <header>
    <h1>Dashboard</h1>
    <p>Manage Your Registered Domains</p>
  </header>

  <div class="container">
    <h2>My Domains</h2>
    <table>
      <thead>
        <tr>
          <th>Domain</th>
          <th>Expiration Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($domains)): ?>
          <tr><td colspan="3">No domains registered yet.</td></tr>
        <?php else: ?>
          <?php foreach ($domains as $index => $domain): ?>
            <tr>
              <td><?= htmlspecialchars($domain) ?></td>
              <td><?= date('Y-m-d', strtotime('+1 year')) ?></td>
              <td><form method="post" style="display:inline;"><button class="btn" name="remove" value="<?= $index ?>">Remove</button></form></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
      $removeIndex = (int)$_POST['remove'];
      unset($_SESSION['cart'][$removeIndex]);
      $_SESSION['cart'] = array_values($_SESSION['cart']);
      echo "<script>location.reload();</script>";
    }
    ?>

    <div class="actions">
      <button onclick="window.location.href='index.php'">Search More Domains</button>
      <button onclick="if(confirm('Are you sure?')) window.location.href='clear_cart.php';">Clear All Domains</button>
    </div>
  </div>
</body>
</html>
