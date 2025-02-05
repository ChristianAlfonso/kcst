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
        <div class="navbar navbar-expand-xl navbar-dark fixed-top d-flex justify-content-between align-items-center">

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
                        <a href="landing.php#home" class="nav-link">HOME</a>
                    </li>
                
                    <li class="nav-item">
                        <a href="landing.php#demo" class="nav-link">INSTITUTIONAL IDENTITY</a>
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

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">STUDENT SERVICES</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="college-form.php" class="dropdown-item">COLLEGE E-FORM</a>
                            </li>
                            <li>
                                <a href="highschool-form.php" class="dropdown-item">HIGHSCHOOL E-FORM</a>
                            </li>
                            <li>
                                <a href="elem-form.php" class="dropdown-item">ELEMENTARY E-FORM</a>
                            </li>
                            <li>
                                <a href="enrollment-procedure.php" class="dropdown-item">ENROLLMENT PROCEDURE</a>
                            </li>
                            <li>
                                <a href="releasing-billing.php" class="dropdown-item">RELEASING OF BILLING</a>
                            </li>
                            <li>
                                <a href="good-moral.php" class="dropdown-item">RELEASING OF GOOD MORAL</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="landing.php#carouselExample" class="nav-link">GALLERY</a>
                    </li>

                    <li class="nav-item">
                        <a href="landing.php#programs" class="nav-link">PROGRAMS</a>
                    </li>

                    <li class="nav-item">
                        <a href="landing.php#updates" class="nav-link">CAMPUS UPDATES</a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="landing.php#contact" class="nav-link">CONTACT</a>
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
                            <a href="landing.php#home" class="nav-link">HOME</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="landing.php#demo" class="nav-link">INSTITUTIONAL IDENTITY</a>
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
                                <a href="college-form.php" class="nav-link">COLLEGE E-FORM</a>
                        </li>

                        <li class="nav-item">
                                <a href="highschool-form.php" class="nav-link">HIGHSCHOOL E-FORM</a>
                        </li>

                        <li class="nav-item">
                                <a href="elem-form.php" class="nav-link">ELEMENTARY E-FORM</a>
                        </li>

                        <li class="nav-item">
                                <a href="enrollment-procedure.php" class="nav-link">ENROLLMENT PROCEDURE</a>
                        </li>
                        <li class="nav-item">
                                <a href="releasing-billing.php" class="nav-link">RELEASING OF BILLING</a>
                        </li>
                        <li class="nav-item">
                                <a href="good-moral.php" class="nav-link">RELEASING OF GOOD MORAL</a>
                        </li>
                 
                 
                        
                        <li class="nav-item">
                            <a href="landing.php#carouselExample" class="nav-link">GALLERY</a>
                        </li>

                        <li class="nav-item">
                            <a href="landing.php#programs" class="nav-link">PROGRAMS</a>
                        </li>

                        <li class="nav-item">
                            <a href="landing.php#updates" class="nav-link">CAMPUS UPDATES</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="landing.php#contact" class="nav-link">CONTACT</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login as Admin</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        

        <div class="container-fluid d-flex justify-content-center align-items-center" id="objective" style="min-height: 100vh">
        <div class="container d-flex" style="height: auto; width: 50rem; margin-top: 5rem" id="objective-content">
            <div class="box bg-light rounded-3 d-flex justify-content-center align-items-center shadow" style="flex: 1;">
                <img src="./asset/img/kcst1.png" class="img-fluid" style="width: 200px" alt="">
            </div>
            <div class="box p-3 d-flex justify-content-center align-items-start flex-column text-light" style="flex: 1;">
                <h1>History Of KCST Logo</h1>
                <p class="text-justify">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, dolore? Earum reprehenderit culpa quae corrupti veniam excepturi odit quasi ipsa animi sit aperiam nam ratione recusandae, eos illum error ipsam?</p>
                    <p class="text-light p-3" style="background-color: #818134">Moss Green: #818134</p>
                    <p class="p-3 text-dark" style="background-color: #e9e6e4">Heavenly White: #e9e6e4</p>
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