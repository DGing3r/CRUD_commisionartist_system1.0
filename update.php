<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch artist data safely
$result = $conn->query("SELECT * FROM commissioned_artists WHERE ID = $id");
$artist = $result ? $result->fetch_assoc() : null;

if (!$artist) {
    die("Artist not found.");
}

// Handle update
if (isset($_POST['update'])) {
    $name = $conn->real_escape_string($_POST['NAME']);
    $type = $conn->real_escape_string($_POST['TYPE_OF_ARTS']);
    $clients = (int)$_POST['CLIENT_AMOUNT'];
    $earnings = (float)$_POST['TOTAL_EARNINGS'];

    $conn->query("UPDATE commissioned_artists 
                  SET NAME='$name', TYPE_OF_ARTS='$type', CLIENT_AMOUNT=$clients, TOTAL_EARNINGS=$earnings 
                  WHERE ID=$id");

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Artist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #9cf1fc, #ee9bff);
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background: linear-gradient(to right, #3cc1d3, #ff59cd);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"] {
            width: 95%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"], .btn {
            background: #f88eba;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        input[type="submit"]:hover, .btn:hover {
            background: #d64c91;
        }
        .actions {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<header>🎨 Edit Artist Details</header>

<div class="container">
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="NAME" value="<?= htmlspecialchars($artist['NAME']) ?>" required><br>

        <label>Type of Art:</label><br>
        <input type="text" name="TYPE_OF_ARTS" value="<?= htmlspecialchars($artist['TYPE_OF_ARTS']) ?>" required><br>

        <label>Clients:</label><br>
        <input type="number" name="CLIENT_AMOUNT" value="<?= htmlspecialchars($artist['CLIENT_AMOUNT']) ?>" required><br>

        <label>Earnings:</label><br>
        <input type="number" step="0.01" name="TOTAL_EARNINGS" value="<?= htmlspecialchars($artist['TOTAL_EARNINGS']) ?>" required><br>

        <div class="actions">
            <input type="submit" name="update" value="Update">
            <a href="index.php" class="btn">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
