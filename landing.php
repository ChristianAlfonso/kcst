<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aim"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_events = "SELECT * FROM event WHERE image IS NOT NULL AND image != '' ORDER BY created_at DESC";
$result_events = $conn->query($sql_events);

$sql_announcements = "SELECT * FROM announcement ORDER BY created_at DESC";
$result_announcements = $conn->query($sql_announcements);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalinga Colleges of Science and Technology</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>  
        .mapa iframe {
            width: 70%;
        }

        .landing {
            position: relative;
        }

        .chat-head {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 1000;
        }

        .chat-head img {
            width: 35px;
            height: 35px;
        }

        .chat-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            max-width: 90%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: none;
            flex-direction: column;
        }

        .chat-header {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .chat-content {
            padding: 20px;
            flex-grow: 1;
            overflow-y: scroll !important;
            max-height: 300px; /* Add this line */
        }

        .chat-bubble {
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .bot-bubble {
            background: #e0e0e0;
            align-self: flex-start;
        }

        .user-bubble {
            background: #007bff;
            color: white;
            align-self: flex-end;
        }

        .choices {
            margin-top: 10px;
        }

        .choices button {
            margin: 5px 0;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: white;
            cursor: pointer;
        }

        .choices button:hover {
            background: #0056b3;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="landing">
        <!--Navbar-->
        <div class="navbar navbar-expand-lg navbar-dark fixed-top d-flex justify-content-between align-items-center">

            <div class="navbar-brand d-flex justify-content-center align-items-center">
                <img src="./asset/img/kcst1.png" alt="logo" class="img-fluid">
                <h1>KCST</h1>
            </div>

            <button class="navbar-toggler" data-bs-target="#navbar-offcanvas" data-bs-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">HOME</a>
                    </li>
                
                    <li class="nav-item">
                        <a href="#demo" class="nav-link">INSTITUTIONAL IDENTITY</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">ABOUT US</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="objective.php" class="dropdown-item">Objective</a>
                            </li>
                            <li>
                                <a href="core.php" class="dropdown-item">Core Values</a>
                            </li>
                            <li>
                                <a href="history.php" class="dropdown-item">History Logo</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#carouselExample" class="nav-link">GALLERY</a>
                    </li>

                    <li class="nav-item">
                        <a href="#programs" class="nav-link">PROGRAMS</a>
                    </li>

                    <li class="nav-item">
                        <a href="#updates" class="nav-link">CAMPUS UPDATES</a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">CONTACT</a>
                    </li>
                </ul>
            </div>

            <div class="navbar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">ADMIN</a>
                    </li>
                </ul>
            </div>

            <!--Navbar Offcanvas-->

            <div class="offcanvas offcanvas-end" id="navbar-offcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#home" class="nav-link">HOME</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="#demo" class="nav-link">INSTITUTIONAL IDENTITY</a>
                        </li>

                       
                        <li class="nav-item">
                                <a href="objective.php" class="nav-link">OBJECTIVES</a>
                        </li>
                        <li class="nav-item">
                                <a href="core.php" class="nav-link">CORE VALUES</a>
                        </li>
                        <li class="nav-item">
                                <a href="history.php" class="nav-link">HISTORY LOGO</a>
                        </li>
                 
                        
                        <li class="nav-item">
                            <a href="#carouselExample" class="nav-link">GALLERY</a>
                        </li>

                        <li class="nav-item">
                            <a href="#programs" class="nav-link">PROGRAMS</a>
                        </li>

                        <li class="nav-item">
                            <a href="#updates" class="nav-link">CAMPUS UPDATES</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">CONTACT</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login as Admin</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        
        <!--Main Content-->
        <div class="main-content p-3 d-flex justify-content-center align-items-center flex-column text-white text-center" id="home">
            <h2>Welcome to Kalinga Colleges of Science and Technology.</h2>
            <p>Home of the Topnotchers!</p>
        </div>

        <!--Values-->
        <div class="section value d-flex justify-content-center align-items-center p-5 bg-light" id="demo">
            <div class="box p-5"></div>
            <div class="box p-3 ">
                <div class="box-header text-center">
                    <h2>Institutional Identity</h2>
                </div>
                <div class="box-body">
                    <div class="group p-2 mt-3">
                        <h4>MISSION:</h4>
                        <p>Our mission is to provide exceptional services, foster innovation, and nurture a community that values growth and collaboration.
                        </p>
                    </div>
                    <div class="group p-2 mt-3">
                        <h4>VISION:</h4>
                        <p>Our vision is to inspire and empower individuals to achieve their full potential and create a better future for all.</p>
                    </div>
                    <div class="group p-2 mt-3">
                        <h4>HYMN:</h4>
                        <p>Here's to the land we hold so dear, With hearts united, strong and clear. We strive for greatness, hand in hand, To build a brighter, promised land.

                            Together we sing, together we rise, Guided by dreams under open skies. In unity, we’ll always stand, For our home, our cherished land.
                            
                            Forever loyal, forever true, We pledge our hearts, our spirits too. Through trials, triumphs, we will see, A legacy of harmony.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--Why-->
        <div class="section about d-flex justify-content-center align-items-center p-5 flex-column">
            <div class="about-header">
                <h2>Why Study at KCST?</h2>
            </div>
            <div class="about-body d-flex justify-content-center align-items-center w-100 m-5">
                <div class="box d-flex justify-content-center align-items-center border rounded-3 flex-column p-5 shadow-sm">
                        <div class="box-header">
                            <img src="./asset/img/troph-cap.png" alt="" class="img-fluid">
                        </div>
                        <div class="box-content mt-5 text-center">
                            Incomparable value-for-money for the high quality of education provided.
                        </div>
                </div>
                <div class="box d-flex justify-content-center align-items-center border rounded-3 flex-column p-5 shadow-sm">
                        <div class="box-header">
                            <img src="./asset/img/handling-coin.png" alt="" class="img-fluid">
                        </div>
                        <div class="box-content mt-5 text-center">
                            Affordable fees and flexible Tuition Payment Terms.
                        </div>
                </div>
                <div class="box d-flex justify-content-center align-items-center border rounded-3 flex-column p-5 shadow-sm">
                        <div class="box-header">
                            <img src="./asset/img/wallet-income.png" alt="" class="img-fluid">
                        </div>
                        <div class="box-content mt-5 text-center">
                            Multiple options on flexible payment terms and financial aid. 
                        </div>
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

                


            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./asset/img/display1.png" class="d-block img-fluid" style="width: 100vw; height: 70vh;">
                            <div class="carousel-caption">
                                <h3>Open Grounds</h3>
                            </div>
                        </div>
                        <div class="carousel-item">            
                            <img src="./asset/img/display2.png" class="d-block img-fluid" style="width: 100vw; height: 70vh;">
                            <div class="carousel-caption">
                                <h3>Computer Laboratory</h3>
                            </div> 
                        </div>
                        <div class="carousel-item">
                            <img src="./asset/img/display4.png" class="d-block img-fluid" style="width: 100vw; height: 70vh;">
                            <div class="carousel-caption">
                                <h3>Admin Office</h3>
                            </div>  
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
        </div>

        <!--Programs-->
        <div class="section program p-5 bg-light" id="programs">
            <div class="program-header text-center">
                <h2>Programs</h2>
            </div>

            <div class="program-body d-flex justify-content-center align-items-center w-100 mt-5">

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Basic Education</div>
                    <div class="box-content">Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools...</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#basic">Requirements</button>
                    </div>
                </div>

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Junior & Senior Highschool</div>
                    <div class="box-content">
                    Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools..
                    </div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#hs">Requirements</button>
                    </div>
                </div>

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Bs Information And Technology</div>
                    <div class="box-content">This program equips students with the skills needed for the fast-paced world of Information Technology. You will gain a strong foundation in programming, networking, and system administration, with plenty of opportunities for hands-on learning and real-world experience.</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#it">Requirements</button>
                    </div>
                </div>

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Bs Criminology</div>
                    <div class="box-content">Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools..</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#crim">Requirements</button>
                    </div>
                </div>

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Bs Computer Engineering</div>
                    <div class="box-content">Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools..</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#comp">Requirements</button>
                    </div>
                </div>
                
                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Bs Hospitality
                    </div>
                    <div class="box-content">Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools..</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#hospi">Requirements</button>
                    </div>
                </div>

                <div class="box shadow rounded-3 p-4 d-flex justify-content-center align-items-center flex-column">
                    <div class="box-header h3">Bs Education</div>
                    <div class="box-content">Bachelor of Science in Education is an undergraduate degree design for student who aspire to become educators. it provides theoretical knowledge, practical skill, and training necessary to teach in schools..</div>
                    <div class="box-modal mt-3">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#educ">Requirements</button>
                    </div>
                </div>
            
            
            
                
            </div>
        </div>

        <!--updates-->
        <div class="section updates p-5" id="updates">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header h2">
                                Events
                            </div>
                            <div class="card-body">
                                <?php
                                if ($result_events->num_rows > 0) {
                                    while ($row = $result_events->fetch_assoc()) {
                                        echo "<div class='card mb-3'>";
                                        if (!empty($row['image'])) {
                                            echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='Event Image'>";
                                        }
                                        echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                                        echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                                        echo "<p class='card-text'><small class='text-muted'>Scheduled on " . $row['event_date'] . "</small></p>";
                                        echo "</div></div>";
                                    }
                                } else {
                                    echo "<p>No events available.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header h2">
                                Announcements
                            </div>
                            <div class="card-body">
                                <?php
                                if ($result_announcements->num_rows > 0) {
                                    while ($row = $result_announcements->fetch_assoc()) {
                                        echo "<div class='card mb-3'>";
                                        echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                                        echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                                        echo "<p class='card-text'><small class='text-muted'>Posted on " . $row['created_at'] . "</small></p>";
                                        echo "</div></div>";
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
            </div>
        </div>

        <!--Contact-->
        <div class="section contact p-5 bg-light" id="contact">
                
            <div class="contact-header text-center">
                <h2>Contact Us</h2>
            </div>
            <div class="contact-body text-center mt-4">
                <p>Feel free to reach out for more information about our school.</p>
                <p>Email: kcst@gmail.com</p>
                <p>Phone: 09098099878766556565656</p>
            </div>
            <div class="map mt-4 text-center">
                <h3>Our Location</h3>
                <p><img src="https://img.icons8.com/ios-filled/50/000000/marker.png" alt="pin location" style="width: 20px; height: 20px;"> CC7R+284, Tabuk, Kalinga</p>
                <div class="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.1234567890123!2d121.4382521!3d17.4125239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x338f9ad411289195%3A0xe0c19f0809da6cb1!2sKalinga%20Colleges%20of%20Science%20and%20Technology!5e0!3m2!1sen!2sph!4v1631234567890!5m2!1sen!2sph" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!--Faqs-->
        <div class="faqs">
            <div class="chat-head" onclick="toggleChat()">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/chat.png" alt="Chat Icon">
            </div>
        
            <div class="chat-container" id="chatContainer">
                <div class="chat-header">FAQS</div>
                <div class="chat-content" id="chatContent"></div>
            </div>
        </div>

        <!--Footer-->
        <div class="footer bg-dark text-light p-4 text-center">
            © 2024 Kalinga Colleges of Science and Technology. All rights reserved.
        </div>
    </div>
    

    <!--basic modal-->
    <div class="modal" id="basic">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Basic Education</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/basic-educ.jpg" 
                         class="img-fluid mb-2 rounded-3 vw-100" 
                         alt=""
                         style="max-height:400px">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--hs modal-->
    <div class="modal" id="hs">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Junior & Senior High School</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/senior-high.jpg" 
                         class="img-fluid mb-2 rounded-3 vw-100" 
                         alt=""
                         style="max-height:400px">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--it modal-->
    <div class="modal" id="it">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BS Information Technology</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/bsit.jpg" 
                         class="img-fluid mb-2 rounded-3 vw-100" 
                         alt=""
                         style="max-height:400px">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138) </li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--criminology modal-->
    <div class="modal" id="crim">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BS Criminology</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/crim.jpg" 
                         class="img-fluid mb-2 vw-100 rounded-3" 
                         alt="" 
                         style="max-height:400px">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--computerEngineering modal-->
    <div class="modal" id="comp">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BS Computer Engineering</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/bsce.jpg" 
                         class="img-fluid mb-2 vw-100 rounded-3" 
                         alt="" 
                         style="max-height:400px;">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--hospitality modal-->
    <div class="modal" id="hospi">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BS Hospitality</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/bshm.jpg" 
                         class="img-fluid vw-100 mb-2 rounded-3" 
                         alt="" 
                         style="max-height: 400px;">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--education modal-->
    <div class="modal" id="educ">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BS Education</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="./asset/img/educ.jpg" 
                         class="img-fluid vw-100 mb-2 rounded-3" 
                         alt="" 
                         style="max-height: 400px;">
                    <ul>
                        <li>Original Grade 12 Senior High School Report Card (F-138)</li>
                        <li>Original F137 (with request letter from KCST)</li>
                        <li>Original Certificate of Good Moral Character issued in the current year</li>
                        <li>Two (2) identical copies of recent 2”x2” studio photo (white background)</li>
                        <li>Clear photocopy of PSA Birth Certificate;</li>
                        <li>For married female applicants, a clear photocopy of Marriage Certificate</li>
                        <li>Clear photocopy of Grade 12 Senior High School Diploma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>





    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-dark');
            } else {
                navbar.classList.remove('bg-dark');
            }

            document.querySelectorAll('.fade-up').forEach(function(element) {
                var rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom >= 0) {
                    element.classList.add('visible');
                }
            });
        });

        document.querySelectorAll('.offcanvas a.nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                var offcanvasElement = document.querySelector('#navbar-offcanvas');
                var bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                bsOffcanvas.hide();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.section').forEach(function(section) {
                section.classList.add('fade-up');
            });
        });
        
    </script>
    <script src="faqs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>