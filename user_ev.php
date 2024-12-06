<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM event WHERE image IS NOT NULL AND image != '' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="a.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Board</title>
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

    .event {
        background-color: #ffffff;
        
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        text-align: center;
    }

    .event img {
        max-width: 100%;
        max-height: 300px; 
        width: auto; 
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .event h2 {
        color: #388e3c;
    }

    .event p {
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
                <a href="user_a.php">Announcement</a>
              
            </center>
        </nav>
    </div>
</header>

<div class="container">
    <br>
    <center>
        <h1 style="color: #fff"> Events</h1>
    </center>
    <br>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='event'>";
            if (!empty($row['image'])) {
                echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Event Image'>";
            }
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
            echo "<p><small>Scheduled on " . $row['event_date'] . "</small></p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No events available.</p>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
