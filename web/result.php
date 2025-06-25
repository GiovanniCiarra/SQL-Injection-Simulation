<?php
session_start();
include 'db.php';

// Recupero i dati dalla sessione precedente (login.php)
$query = $_SESSION['query'] ?? '';
$loginSuccess = $_SESSION['login_success'] ?? false;
$loginData = $_SESSION['login_data'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Risultato Login</title>
    <link rel='stylesheet' href='style.css'>
    <style>
        body {
        font-family: 'Segoe UI', 'Roboto', 'Inter', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        }

        .result-box {
            width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .fail {
            color: red;
            font-weight: bold;
        }

        pre {
            white-space: pre-wrap;   
            word-break: break-word;  
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .section-title {
            margin-top: 40px;
            font-size: 18px;
            font-weight: bold;
        }
        .back-link {
            display: block;
            margin-top: 30px;
            text-align: center;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class='result-box'>
    <!-- Viene mostrata la query che è stata eseguita -->
    <pre><strong>Query eseguita:</strong> <?= htmlspecialchars($query) ?></pre>

    <?php
    if ($loginSuccess) {
        echo "<p class='success'>✅ Login riuscito!</p>";
    } else {
        echo "<p class='fail'>❌ Login fallito: username o password errati.</p>";
    }
    if (!empty($loginData)) {
        echo "<table>";

        if (!empty($loginData)) {
            echo "<h3>Benvenuto:</h3><ul>";
            foreach ($loginData as $row) {
                echo "<li>" . htmlspecialchars($row['username']) . "</li>";
            }
            echo "</ul>";
        }

    }

    ?>

    <div class='section-title'>Stato attuale del database (tabella <code>users</code>):</div>
    <?php
    $allUsers = $conn->query("SELECT * FROM users");
    if ($allUsers && $allUsers->num_rows > 0):
    ?>
        <table>
            <tr><th>ID</th><th>Username</th><th>Password</th></tr>
            <?php while ($user = $allUsers->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p><em>La tabella <code>users</code> è vuota.</em></p>
    <?php endif; ?>

    <a class='back-link' href='index.php'> Torna al login</a>
</div>
</body>
</html>
