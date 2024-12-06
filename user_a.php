<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim"; 
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM announcement ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="a.css">
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Board</title>
    <style>
        body {
           
            font-family: Arial, sans-serif;
            background-color: #f9fbe7;
            margin: 0;
            padding: 0;
        }


         

        h1 {
            color: #388e3c;
        }

        .announcement {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .announcement h2 {
            color: #388e3c;
        }

        .announcement p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
      <div class="logo">
        <img src="asset/img/kcst1.png" alt="School Logo">
        <h1 style="color: #fff">Kalinga Colleges of Science and Technology</h1>
      </div>
      <nav class="navbar">
        <center>
        <a href="index.php">Home</a>
        <a href="#about">About</a>
        <a href="user_ev.php">Events</a>
        <a href="#contact">Contact</a>
        </center>
      </nav>
    </div>
  </header>

    <div class="container">
    <br>
        <center>
        <h1 style="color: #fff">Latest Announcements</h1>
    </center>
    <br>
        <?php
        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo "<div class='announcement'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                echo "<p><small>Posted on " . $row['created_at'] . "</small></p>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>No announcements available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
