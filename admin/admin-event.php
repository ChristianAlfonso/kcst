<?php

$servername="localhost";
$username="root";
$password="";
$dbname="aim";

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
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Event posted successfully!',
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
                                    title: 'Error',
                                    text: '" . htmlspecialchars($stmt->error) . "',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                });
                            });
                          </script>";
                }
                $stmt->close();
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to upload the image. Check folder permissions.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            });
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Invalid file type. Allowed types are JPG, JPEG, PNG, and GIF.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
        }
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No file uploaded or an error occurred during upload.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
    }
}

$conn->close();
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
                                        <a href="admin-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/announce.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                            <img src="../asset/img/event.png" style="width: 30px" class="img-fluid" alt="">
                                            Post Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="delete-announcement.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
                                        <img src="../asset/img/delete.png" style="width: 30px" class="img-fluid" alt="">    
                                        Delete Announcement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="delete-event.php" class="nav-link text-light d-flex align-items-center" style="gap: 5px">
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
        <div class="offcanvas offcanvas-end" id="responsiveSidebar">
            <div class="offcanvas-header">
                <h2>Menu</h2>
                <button class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="admin-announcement.php" class="nav-link">Post Announcement</a>
                        </li>
                        <li class="nav-item">
                            <a href="admin-event.php" class="nav-link">Post Event</a>
                        </li>
                        <li class="nav-item">
                            <a href="delete-announcement.php" class="nav-link">Delete Announcement</a>
                        </li>
                        <li class="nav-item">
                            <a href="delete-event.php" class="nav-link">Delete Event</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main border flex-grow-1 p-5" style="background: url(../asset/admin-bg.jpg) no-repeat center / cover;">
            <div class="main-header d-flex justify-content-between align-items-center">
                <h2 style="color: #808131">Post Event</h2>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#responsiveSidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="main-body shadow p-4 mt-4 bg-white">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group mt-3">
                        <label for="title">Event Title</label>
                        <input class="form-control" type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">Event Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="event_date">Event Date</label>
                        <input class="form-control" type="date" id="event_date" name="event_date" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Event Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="form-group mt-3 d-flex justify-content-end">
                        <button style="background-color: #37371a;" class="btn text-light" type="submit">Post Event</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>