<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

require 'db_connect.php';

// Get user ID from session (you can store it on login)
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

// Fetch registered domains for user
$stmt = $conn->prepare("SELECT id, domain_name, extension, registered_at, expires_at FROM domains WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$domains = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Domains - GoDaddy Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 20px;
            background: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
        }
        th {
            background: #007bff;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background: #f1f1f1;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            margin: 0 4px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        button.renew:hover {
            background: #218838;
        }
        button.remove {
            background: #dc3545;
        }
        button.remove:hover {
            background: #b02a37;
        }
        .no-domains {
            text-align: center;
            font-size: 18px;
            margin-top: 50px;
            color: #555;
        }
        .topnav {
            width: 90%;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: flex-end;
        }
        .topnav button {
            background: #007bff;
            margin: 0 0 0 10px;
        }
        .topnav button:hover {
            background: #0056b3;
        }
    </style>
    <script>
      function renewDomain(domainId) {
        alert('Renew feature is not functional yet. Domain ID: ' + domainId);
      }
      function removeDomain(domainId) {
        alert('Remove feature is not functional yet. Domain ID: ' + domainId);
      }
    </script>
</head>
<body>

<h1>My Registered Domains</h1>

<div class="topnav">
    <button onclick="window.location.href='dashboard.php'">Dashboard</button>
    <button onclick="window.location.href='logout.php'">Logout</button>
</div>

<?php if (count($domains) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Domain Name</th>
            <th>Extension</th>
            <th>Registered On</th>
            <th>Expires On</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($domains as $domain): ?>
        <tr>
            <td><?= htmlspecialchars($domain['domain_name']) ?></td>
            <td>.<?= htmlspecialchars($domain['extension']) ?></td>
            <td><?= htmlspecialchars(date("Y-m-d", strtotime($domain['registered_at']))) ?></td>
            <td><?= htmlspecialchars($domain['expires_at']) ?></td>
            <td>
                <button class="renew" onclick="renewDomain(<?= $domain['id'] ?>)">Renew</button>
                <button class="remove" onclick="removeDomain(<?= $domain['id'] ?>)">Remove</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p class="no-domains">You have not registered any domains yet.</p>
<?php endif; ?>

</body>
</html>
