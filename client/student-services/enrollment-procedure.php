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
    <link rel="stylesheet" href="../styles.css?v=<?php echo time(); ?>">
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
    <div id="sectionNav"></div>

        

        <!--other process-->
        <div class="container-fluid d-flex justify-content-center align-items-center" id="other-process" style="min-height: 100vh;flex-wrap: wrap; gap: 1rem; padding-top: 5rem;">

            <div class="box bg-light rounded-3 shadow p-3 m-3" style="width: 400px; min-height: 35rem">

                    <header class="d-flex justify-content-center align-items-center">
                        <img src="./asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                        <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                            <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                            <label>Moldero St., Purok 5, Bulanao</lab> <br>
                            <label>Tabuk City, Kalinga 3800</label> <br>
                        </div>
                    </header>

                    <div class="box-body p-3">
                        <p class="text-primary">ENROLLMENT PROCEDURE</p>
                        <p style="font-size: 11px;">

                            <strong>For Freshmen:</strong><br>

                            1. Present all Requirements to the Registrar's Office and get an enrollment form.<br>
                            2. Fill up the form correctly.<br>
                            3. Proceed to Registrar's Office for signing.<br>
                            4. And lastly, proceed to the cashier for down payment.<br>

                            <strong>For Old Students:</strong><br>

                            1. Get a request slip for the True Copy of Grades (TCG) and proceed to the cashier.<br>
                            2. Go back to the Registrar's office for the release of TCG.<br>
                            3. Present the TCG to the Dean's Office for evaluation.<br>
                            4. Go back to Registrar's Office for Signing.<br>
                            5. Lastly, proceed to the cashier for Down Payment.<br>

                            <strong>For Transferees:</strong><br>

                            1. Submit your Transfer Credential at the Registrar's Office for evaluation, get the RETURN SLIP COPY and return/send to the school where you came from for the release of your OTR. Deadline of submission is on or before the end of the semester.<br>
                            2. Proceed at the enrollment area.<br>
                            3. Go back to the Registrar's Office for signing.<br>
                            4. Proceed to the cashier for payment and claim your class cards.<br>
                        </p>
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
    <script src="../../faqs.js"></script>
    <script src="../layout/sectionNav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>