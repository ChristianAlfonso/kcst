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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Kalinga Colleges of Science and Technology</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>  
        body {
            min-width: 30cm;
            overflow-x: auto !important;
            font-family: Arial, sans-serif;
            background-image: url('./asset/img/blur-bg.png');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
        }
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

        .table-equal {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-weight: bold;
        }

        .table-equal td {
            width: 50%;
            padding: 8px;
            vertical-align: top;
        }

        .table-second, .table-second th, .table-second td {
            border: 1px solid black;
            font-weight: bold;
        }

        .container-fluid {
            width: 30cm !important;
            min-width: 30cm !important;
            max-width: 30cm !important;
            overflow-x: auto !important;
        }

        .box {
            width: 30cm !important;
            min-width: 30cm !important;
            max-width: 30cm !important;
            background: white;
            min-height: 29.7cm;
        }

        @media print {
            @page {
                size: 30cm 29.7cm;
                margin: 0;
            }
            body {
                width: 30cm !important;
                min-width: 30cm !important;
            }
            #college-form-front {
                width: 30cm !important;
                min-width: 30cm !important;
            }
            .box {
                page-break-inside: avoid;
                width: 30cm !important;
            }
            .container-fluid {
                padding: 0 !important;
                margin: 0 !important;
                width: 30cm !important;
            }
        }

    </style>
</head>
<body>

    <div class="landing">
        <!--Navbar-->
        <div class="navbar navbar-expand-xl navbar-dark bg-dark d-flex justify-content-between align-items-center">

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
                        <a href="#landing.php" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">ABOUT US</a>
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
                                <a href="enrollment-form.php" class="dropdown-item">ENROLLMENT E-FORM</a>
                            </li>
                            <li>
                                <a href="other-process.php" class="dropdown-item">OTHER PROCESS</a>
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
                                <a href="enrollment-form.php" class="nav-link">ENROLLMENT E-FORM</a>
                        </li>

                        <li class="nav-item">
                                <a href="other-process.php" class="nav-link">OTHER SERVICES</a>
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
        

        <!--elem process-->
        <div class="container-fluid d-flex justify-content-center align-items-center flex-column" id="other-process" style="min-height: 100vh;">

            <div class="box" style="min-height: 29.7cm; width: 30cm; background: white; border: 2px solid red" id="college-form-front">
                    <header class="d-flex justify-content-center align-items-center">
                        <img src="./asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                        <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                            <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                            <label>Moldero St., Purok 5, Bulanao</lab> <br>
                            <label>Tabuk City, Kalinga 3800</label> <br>
                        </div>
                    </header>

                    <div class="box-body" style="font-size: 12px;">
                            <div class="p-3">
                                <table class="table table-borderless table-equal">
                                    <tr>
                                        <td>ID Number: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                        <td></td>
                                        <td >Date:</td>                            
                                    </tr>
                                    <tr>
                                        <td>Nsat Rating: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                        <td></td>
                                        <td><label for="">( )Old  ( )New  ( )Transferee</label></td>
                                    </tr>
                                    <tr>
                                    
                                        <td colspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td>Family Name: <span contenteditable="true">_______  </span></td>
                                        <td>First Name: <span contenteditable="true">_______  </span></td>
                                        <td>Middle Name: <span contenteditable="true">_______  </span></td>
                                        <td>Extension Name: <span contenteditable="true">_______  </span></td>
                                    </tr>
                                    <tr>
                                        <td>Course: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                        <td>Semester: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Year: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                        <td>School Year: <span contenteditable="true">_______  </span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <table class="table table-second">
                                            <tr>
                                                <th>Subject Code</th>
                                                <th>Descriptive Title</th>
                                                <th>Units</th>
                                                <th>Time</th>
                                                <th>Days</th>
                                                <th>Room</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total Units:</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </tr>
                                    <tr>
                                        <table class="table table-borderless table-equal"  style="border-bottom: 1px solid black">
                                            <tr>
                                                <td>Registrar Copy</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Registrar</span></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Academic Dean</span></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Accounting Officer</span></td>
                                            </tr>
                                        </table>
                                    </tr>

                                </table>
                            </div>

                            <div style="" class="p-3">
                                <table class="table table-borderless table-equal" >
                                    <tr>
                                        <th>Accounting's Copy</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </table>
                                <header class="d-flex justify-content-center align-items-center">
                                    <img src="./asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                                    <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                                        <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                                        <label>Moldero St., Purok 5, Bulanao</lab> <br>
                                        <label>Tabuk City, Kalinga 3800</label> <br>
                                    </div>
                                </header>
                                <div style="border-bottom: 1px solid black">
                                    <table class="table table-borderless table-equal">
                                        <tr>
                                            <td>( )Old  ( )New  ( )Transferee</td>
                                            <td></td>
                                            <td></td>
                                            <td>Date:</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>ID Number: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td>Family Name: <span contenteditable="true">_______  </span></td>
                                            <td>First Name: <span contenteditable="true">_______  </span></td>
                                            <td>Middle Name: <span contenteditable="true">_______  </span></td>
                                            <td>Extension Name: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td>Course: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                            <td>Semester: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Year: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                            <td>School Year: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Assessment of Fees</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Tuition Fee: <span contenteditable="true">_______  </span> </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4">Laboratory Fee: <span contenteditable="true">_______  </span></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4">Miscellaneous Fee: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Registration Fee: <span contenteditable="true">_______  </span></td>
                                            <td>PTCA <span contenteditable="true">_______  </span></td>
                                            <td>Cultural Fee: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Audio Viusal: <span contenteditable="true">_______  </span></td>
                                            <td>Internet Fee: <span contenteditable="true">_______  </span></td>
                                            <td>Medical: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td>Test Paper: <span contenteditable="true">_______  </span></td>
                                            <td colspan="2">Guidance,Counseling Fee: <span contenteditable="true">_______  </span></td>
                                            <td>Cultural Fee: <span contenteditable="true">_______  </span></td>
                                        </tr>
                                        <tr>
                                            <td>Library: <span contenteditable="true">_______  </span></td>
                                            <td colspan="2">Student Supreme Council: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Athletic: <span contenteditable="true">_______  </span></td>
                                            <td>School Organ: <span contenteditable="true">_______  </span></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span style="border-top: 1px solid black" class="px-4">Registrar</span></td>
                                            <td><span style="border-top: 1px solid black" class="px-4">Academic Dean</span></td>
                                            <td><span style="border-top: 1px solid black" class="px-4">Accounting Officer</span></td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                            

                            <div class="p-3">
                                <table class="table table-borderless table-equal" >
                                        <tr>
                                            <th>Student's Copy</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                </table>
                                <header class="d-flex justify-content-center align-items-center">
                                    <img src="./asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                                    <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                                        <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                                        <label>Moldero St., Purok 5, Bulanao</lab> <br>
                                        <label>Tabuk City, Kalinga 3800</label> <br>
                                    </div>
                                </header>
                                <table class="table table-second">
                                            <tr>
                                                <th>Subject Code</th>
                                                <th>Descriptive Title</th>
                                                <th>Units</th>
                                                <th>Time</th>
                                                <th>Days</th>
                                                <th>Room</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total Units:</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </tr>
                                    <tr>
                                        <table class="table table-borderless table-equal"  style="border-bottom: 1px solid black">
                                            <tr>
                                                <td>Student's Copy</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Registrar</span></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Academic Dean</span></td>
                                                <td><span style="border-top: 1px solid black" class="px-4">Accounting Officer</span></td>
                                            </tr>
                                        </table>
                                    </tr>
                            </div>
                                

                            

                    </div>

                    

                    


            </div>

            
            

            


            <div class="box p-5 border border-5 mt-5" style="width: 400px; background: white;">
                Reminder: <br>  Click the lines to edit the content.
                <button class="btn btn-secondary btn-sm" id="saveBtn">Save as pdf</button>
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
        let saveBtn = document.getElementById('saveBtn');

        saveBtn.addEventListener('click', function() {
            html2canvas(document.querySelector('#college-form-front'), {
                scale: 2, // Increase quality
                useCORS: true,
                logging: true
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/jpeg', 1.0);
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imageWidth = canvas.width;
                const imageHeight = canvas.height;
                
                // Calculate scaling to fit page while maintaining aspect ratio
                const ratio = Math.min(pageWidth / imageWidth, pageHeight / imageHeight);
                const width = imageWidth * ratio;
                const height = imageHeight * ratio;
                
                // Center the image
                const x = (pageWidth - width) / 2;
                const y = (pageHeight - height) / 2;
                
                pdf.addImage(imgData, 'JPEG', x, y, width, height);
                pdf.save('enrollment-form.pdf');
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

    <script src="html2canvas.js"></script>
    <script src="faqs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>