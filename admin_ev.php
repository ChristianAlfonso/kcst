<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

  
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); 
    }

   
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

     
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
         
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
               
                $sql = "INSERT INTO event (title, description, event_date, image, created_at) 
                        VALUES (?, ?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $title, $description, $event_date, $image_name);

                if ($stmt->execute()) {
                    echo "<p>Event posted successfully!</p>";
                } else {
                    echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
                }
                $stmt->close();
            } else {
                echo "<p>Error: Unable to upload the image. Check folder permissions.</p>";
            }
        } else {
            echo "<p>Error: Invalid file type. Allowed types are JPG, JPEG, PNG, and GIF.</p>";
        }
    } else {
        echo "<p>Error: No file uploaded or an error occurred during upload.</p>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fbe7;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #388e3c;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #388e3c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #2e7d32;
        }
    </style>
</head>
<body>
    <h1>Post Event</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Event Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Event Description</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="event_date">Event Date</label>
        <input type="date" id="event_date" name="event_date" required>

        <label for="image">Event Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Post Event</button>
    </form> 
</body>
</html>
