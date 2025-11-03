<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commissioned Artists</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #9cf1fcff, #ee9bffff);
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background: linear-gradient(to right, #3cc1d3ff, #ff59cdff);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        a {
            text-decoration: none;
            background: #f88ebaff;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            margin: 0 4px;
            transition: 0.3s;
        }
        a:hover { background: #d64c91ff; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background: #c47ce7ff;
            color: #fff;
        }
        tr:nth-child(even) { background: #f8dbdbff; }
        tr:hover { background: #e8f6f3; }
    </style>
</head>
<body>

<header>🎨 Commissioned Artists</header>

<div class="container">
    <div style="margin-bottom:15px;">
        <a href="add.php">➕ Add Artist</a>
        <a href="analytics.php">📊 Analytics</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Artist Name</th>
            <th>Type of Art</th>
            <th>Clients</th>
            <th>Earnings ($)</th>
            <th>Actions</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM commissioned_artists");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['NAME'] ?></td>
            <td><?= $row['TYPE_OF_ARTS'] ?></td>
            <td><?= $row['CLIENT_AMOUNT'] ?></td>
            <td><?= $row['TOTAL_EARNINGS'] ?></td>
            <td>
                <a href="read.php?id=<?= $row['ID'] ?>">View</a>
                <a href="update.php?id=<?= $row['ID'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['ID'] ?>">Delete</a>
            </td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
