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
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Event deleted successfully!',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error deleting event',
                    text: '" . $delete_stmt->error . "',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>";
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
    <title>Admin</title>
    <link rel="../stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
.navbar-toggler {
    background-color: #37371a; /* Bootstrap's dark color */
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.55)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}


@media (min-width: 800px) {
    .navbar-toggler {
        display: none;
    }
}

@media (max-width: 800px) {
    #header {
        display: none !important    ;
    }
}

</style>
<body>

    <div class="admin-post d-flex">
        
    <div id="header" class="d-flex">
    <div class="sidebar shadow-sm p-5" style="min-height: 100vh; background-color: #2a2a16;">
                            <div class="sidebar-brand d-flex justify-content-start align-items-center">
                                <img src="../asset/img/kcst1.png" alt="" style="height: 50px;">
                                <h1 class="text-light">KCST</h1>
                            </div>
                            <div class="profile mt-3 text-light flex-column d-flex justify-content-start align-items-center" style="gap: 5px">
                                <img src="../asset/img/profile.png" class="img-fluid" style="width: 150px" alt=""> Welcome, Admin
                            </div>
                            <div class="sidebar-nav mt-5">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="../admin/index.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/home.png" style="width: 30px" class="img-fluid" alt="">
                                            Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/admin-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/announce.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/admin-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/event.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/delete-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/delete.png" style="width: 30px" class="img-fluid" alt="">    
                                        Delete Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/delete-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/delete.png" style="width: 30px" class="img-fluid" alt="">    
                                        Delete Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""  class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/logout.png" style="width: 30px" class="img-fluid" alt="">    
                                        Logout</a>
                                    </li>
                                </ul>
                             </div>
                        </div>
        </div>

        <!--offcanvas for navbar-->
        <div class="offcanvas offcanvas-end bg-dark" id="responsiveSidebar">
            <div class="offcanvas-header">
                <h2 class="text-light">Admin Panel</h2>
                <button class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="sidebar">
                    <ul class="nav flex-column">
                    <li class="nav-item">
                                        <a href="../admin/index.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/home.png" style="width: 30px" class="img-fluid" alt="">
                                            Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/admin-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/announce.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/admin-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/event.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/delete-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/delete.png" style="width: 30px" class="img-fluid" alt="">    
                                        Delete Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../admin/delete-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/delete.png" style="width: 30px" class="img-fluid" alt="">    
                                        Delete Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""  class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/logout.png" style="width: 30px" class="img-fluid" alt="">    
                                        Logout</a>
                                    </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main border flex-grow-1 p-5" style="background: url(../asset/admin-bg.jpg) no-repeat center / cover; min-height: 100vh;">
            <div class="main-header d-flex justify-content-between align-items-center">
                <h2 style="color: #808131">Current Event</h2>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#responsiveSidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="main-body mt-4">
                <div class="container bg-white p-4 shadow d-flex justify-content-start align-items-center mt-4" style="gap: 1rem; flex-wrap: wrap;">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card shadow-sm'>";
                            if (!empty($row['image'])) {
                                echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' class='card-img-top' style='width: 100%; height: auto; max-width: 300px;' alt='Event Image'>";
                            }
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                            echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                            echo "<p class='card-text'><small class='text-muted'>Scheduled on: " . $row['event_date'] . "</small></p>";
                            echo "<form method='POST' action=''>
                                    <input type='hidden' name='delete_event_id' value='" . $row['id'] . "'>
                                    <div class='d-flex justify-content-end'>
                                        <button type='submit' class='btn btn-danger'>Delete Event</button>
                                    </div>
                                </form>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No events available.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>