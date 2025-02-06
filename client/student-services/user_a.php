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

