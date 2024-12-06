<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'], $_POST['message'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];

 
    $stmt = $conn->prepare("INSERT INTO announcement (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Announcement posted successfully!'
                    });
                });
              </script>";
    } else {
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error posting announcement: " . $stmt->error . "'
                    });
                });
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="admin-post d-flex">
        <div id="header" class="d-flex">
        
        </div>

        <div class="main border flex-grow-1 p-5">
            <div class="main-header">
                <h2 style="color: #808131">Post Announcement</h2>
            </div>
            <div class="main-body mt-4">
                <form action="admin-announcement.php" method="post">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control"  name="title" id="title" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="message">Message:</label>
                        <textarea name="message" class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-end">
                        <input type="submit" value="Post Announcement" class="btn text-light" style="background-color: #37371a;">
                    </div>
                </form>
            </div>
            <div class="main-posted">
                <h2 style="color: #808131;" class="mb-3">Latest Announcement</h2>
                <div class="container">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT title, message, created_at FROM announcement ORDER BY created_at DESC");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>" . htmlspecialchars($row['title']) . "</h2>";
                        echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Posted on " . $row['created_at'] . "</small></p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No announcements available.</p>";
                }

                $conn->close();
                ?>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="main.js" type="module"></script>
</body>
</html>