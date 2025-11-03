<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Artist</title>
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
            width: 90%;
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            background: #f88eba;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
        }
        .btn:hover {
            background: #d64c91;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #3cc1d3;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>🎨 Add New Artist</header>

    <div class="container">
        <form method="post">
            <label>Artist Name</label>
            <input type="text" name="NAME" required>

            <label>Type of Art</label>
            <input type="text" name="TYPE_OF_ARTS" required>

            <label>Number of Clients</label>
            <input type="number" name="CLIENT_AMOUNT" required>

            <label>Total Earnings ($)</label>
            <input type="number" step="0.01" name="TOTAL_EARNINGS" required>

            <input class="btn" type="submit" name="save" value="Save Artist">
        </form>

        <a class="back-link" href="index.php">← Back to Artist List</a>

        <?php
        if (isset($_POST['save'])) {
            $name = $_POST['NAME'];
            $type = $_POST['TYPE_OF_ARTS'];
            $clients = $_POST['CLIENT_AMOUNT'];
            $earnings = $_POST['TOTAL_EARNINGS'];

            $sql = "INSERT INTO commissioned_artists (NAME,TYPE_OF_ARTS,CLIENT_AMOUNT,TOTAL_EARNINGS) 
                    VALUES ('$name', '$type', '$clients', '$earnings')";

            if ($conn->query($sql)) {
                header("Location: index.php");
                exit;
            } else {
                echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
