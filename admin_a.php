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
        echo "<script type='text/javascript'>alert('Announcement posted successfully!');</script>";
    } else {
        echo "<p class='error'>Error posting announcement: " . $stmt->error . "</p>";
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
    <title>Post Announcement</title>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

       
        .sidenav {
            width: 200px;
            background-color: #81c784;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            color: white;
            text-align: center;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidenav a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .sidenav a:hover, .sidenav a.active {
            background-color: #66bb6a;
        }

      
        .main-content {
            margin-left: 220px;
            padding: 20px;
            flex-grow: 1;
        }

        h1 {
            font-size: 24px;
            color: #388e3c;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #66bb6a;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #388e3c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #66bb6a;
        }

        .success {
            color: #4caf50;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .error {
            color: #f44336;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

   
    <div class="sidenav">
        
        <a href="admin_dashboard.php">Go Back</a>
        <a href="manage_ma.php">Manage Announcement</a>
    </div>


    <div class="main-content">
        <h1>Post a New Announcement</h1>
        <div class="form-container">
            <form action="admin_a.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="4" required></textarea>

                <input type="submit" value="Post Announcement">
            </form>
        </div>
    </div>

</body>
</html>
