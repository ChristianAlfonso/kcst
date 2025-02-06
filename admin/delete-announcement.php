<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertScript = '';

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM announcement WHERE delete_id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $alertScript = "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Announcement deleted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete-announcement.php';
                }
            });
        </script>";
    } else {
        $alertScript = "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error deleting announcement.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    $stmt->close();
}


$sql = "SELECT * FROM announcement ORDER BY created_at DESC";
$result = $conn->query($sql);
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
                <h2 style="color: #808131">Current Announcement</h2>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#responsiveSidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="main-body mt-4">
            <div class="container  bg-white p-4 shadow d-flex justify-content-start align-items-center mt-4" style="gap: 1rem; flex-wrap: wrap;">
    
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="announcement shadow-sm p-5">
                            <h3><?= htmlspecialchars($row['title']) ?></h3>
                            <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                            <small>Posted on: <?= $row['created_at'] ?></small>
                            <br>
                            <div class="d-flex justify-content-end">
                                <a href="?delete_id=<?= $row['delete_id'] ?>" class="btn btn-danger mt-3">Delete</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No announcements yet.</p>
                <?php endif; ?>
            </div>

            </div>
        </div>
    </div>
    
    <?php if ($alertScript) echo $alertScript; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</body>
</html>