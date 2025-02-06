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

