<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event_id'])) {
    $event_id = intval($_POST['delete_event_id']);

    $query = "SELECT image FROM event WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    $delete_query = "DELETE FROM event WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $event_id);

    if ($delete_stmt->execute()) {
     
        if ($image && file_exists("uploads/" . $image)) {
            unlink("uploads/" . $image);
        }
        echo "<p>Event deleted successfully!</p>";
    } else {
        echo "<p>Error deleting event: " . $delete_stmt->error . "</p>";
    }

    $delete_stmt->close();
}


$query = "SELECT * FROM event ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fbe7;
            margin: 0;
            padding: 0;
        }

        .event {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .event img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .event h2 {
            color: #388e3c;
        }

        form {
            margin-top: 10px;
        }

        button {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;color:#388e3c;">Delete Event</h1>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event'>";
                if (!empty($row['image'])) {
                    echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Event Image'>";
                }
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                echo "<p><small>Scheduled on: " . $row['event_date'] . "</small></p>";
                echo "<form method='POST' action=''>
                          <input type='hidden' name='delete_event_id' value='" . $row['id'] . "'>
                          <button type='submit'>Delete Event</button>
                      </form>";
                echo "</div>";
            }
        } else {
            echo "<p>No events available.</p>";
        }
        ?>
    </div>
</body>
</html>
