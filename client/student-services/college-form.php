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
    <link rel="stylesheet" href="../styles.css?v=<?php echo time(); ?>">
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
        }

        .box {
            width: 30cm !important;
            min-width: 30cm !important;
            max-width: 30cm !important;
            background: white;
            min-height: 29.7cm;
        }

        #table-back {
            border: 1px solid black;
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
    <div id="sectionNav"></div>


        <!--elem process-->
        <div class="container-fluid d-flex justify-content-center align-items-center flex-column" id="other-process" style="min-height: 100vh;">

        <div class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Reminder!</strong>  Click the lines to edit the content..
        </div>
        
            <div class="box mt-3" style="min-height: 29.7cm; width: 30cm; background: white;" id="college-form-front">
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

                            <div class="p-3">
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


            <div class="box mt-3 p-3"  style="min-height: 29.7cm; width: 30cm; background: white;" id="college-form-back">
                <table class="table table-borderless table-equal" style="font-size: 12px; ">
                    <tr>
                        <td>Family Name: <span contenteditable="true">_______  </span></td>
                        <td>First Name: <span contenteditable="true">_______  </span></td>
                        <td>Middle Name: <span contenteditable="true">_______  </span></td>
                        <td>Extension Name: <span contenteditable="true">_______  </span></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <table class="table table-borderless table-equal" id="table-back" style="font-size: 12px;">
                                <tr>
                                    <td>Home Address: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Present Address: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth: <span contenteditable="true">_______  </span></td>
                                    <td>ZIP code: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Place Of Birth: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Age: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Sex: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Religion: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Civil Status: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Nationality: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Cellphone Number: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Email/Gmail Address: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Indigenous People Group (Optional): <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td><strong>Name of School Attended:</strong> </td>
                                </tr>
                                <tr>
                                    <td>Primary Kinder: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Year Graduated: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Elementary/Kinder: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Year Graduated: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Senior High School(7-10): <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Year Graduated: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Senior High School(11-12): <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Year Graduated: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>College: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Course: <span contenteditable="true">_______  </span></td>
                                    <td>Year: <span contenteditable="true">_______  </span></td>
                                </tr>

                            </table>
                        </td>
                        <td>
                            <table class="table table-borderless table-equal" id="table-back" style="font-size: 12px; ">
                                <tr>
                                    <td>Father's Name:</td>
                                    <td>Last Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Given Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Middle Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Mother's Maiden Name</td>
                                    <td>Last Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Given Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Middle Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Parent/s Contact No.</td>
                                    <td>Smart: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Tnt: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Tm: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Globe: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr style="border-top: 1px solid black">
                                    <td>
                                        <strong>For student both parents deceased</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>(Guardian's information)</td>
                                </tr>
                                <tr>
                                    <td>Last Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Given Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Middle Name: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Contact No.: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr style="border-top: 1px solid black">
                                    <td><strong>For working student's</strong></td>
                                </tr>
                                <tr>
                                    <td>(Employer's information)</td>
                                </tr>
                                <tr>
                                    <td>Name of Employer: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Position: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td>Address: <span contenteditable="true">_______  </span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                    <p  class="text-center"style="font-size: 15px">I understand that enrollment in this school (Kalinga Colleges of Science and Technology,Inc.) is granted upon the agreement with its philosophy, objectives and policies. I hereby promise to abide with all the rules and regulations of the school as well as of the TESDA.</p>
                <table class="table table-borderless table-equal mt-5">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <p class="p-3" style="border-top: 1px solid black">Student's Signature</p></td>
                    </tr>
                </table>
                <table class="table table-borderless table-equal" style="font-size: 12px;">
                    <tr>
                        <td>CREDENTIALS PRESENTED UPON ENROLLMENT
                        </td>
                    </tr>
                    <tr>
                        <td>FORM 138 ()</td>
                    </tr>
                    <tr>
                        <td>Original Transcript of Record ()</td>
                    </tr>
                    <tr>
                        <td>Diploma ()</td>
                    </tr>
                    <tr>
                        <td>Honorable Dismissals ()</td>
                    </tr>
                    <tr>
                        <td>National Scholastics Achievements Test ()</td>
                    </tr>
                </table>
                    <p  class="text-center"style="font-size: 15px">I certify that all of the above information made by me are true and correct and I promise to obey the rules and regulations of the school (Kalinga Colleges of Science and Technology,Inc.) as stated in the Handbook.</p>
                <table class="table table-borderless table-equal mt-5">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <p class="p-3" style="border-top: 1px solid black">Student's Signature</p></td>
                    </tr>
                </table>
                <table class="table-equal" style="font-size: 12px; border-top: 3px solid black">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Date:</td>
                    </tr>
                    <tr>
                        <td>
                            <p class="p-3" style="border-top: 1px solid black">Family Name</p>
                        </td>
                        <td>
                            <p class="p-3" style="border-top: 1px solid black">Given Name</p>
                        </td>
                        <td>
                            <p class="p-3" style="border-top: 1px solid black">Middle Name</p>
                        </td>
                        <td>
                            <p class="p-3" style="border-top: 1px solid black">Extension Name</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Assesment of Fees</td>
                    </tr>
                    <tr>
                        <td>Tuition Fee:</td>
                        <td></td>
                        <td></td>
                        <td>Requirement Payment:</td>
                    </tr>
                    <tr>
                        <td>Laboratory Fee:</td>
                        <td></td>
                        <td></td>
                        <td>Prelim Exam:</td>
                    </tr>
                    <tr>
                        <td>Miscellaneous Fee</td>
                        <td></td>
                        <td></td>
                        <td>35% of Net Fee</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Registration Fee:</td>
                        <td>PTCA</td>
                        <td>MIDTERM Exam</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Audio Visual:</td>
                        <td>Internet Fee:</td>
                        <td>30% of the Net pay</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Test Ppaer:</td>
                        <td>Guidance, Counseling Fee:</td>
                        <td>Semi-Final Exam</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Library:</td>
                        <td>Student Supreme Council:</td>
                        <td>25% of the  Net pay</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Athletic:</td>
                        <td>School Organ:</td>
                        <td>Final Exam:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Cultural Fee:</td>
                        <td>Guard Fee:</td>
                        <td>10% of the Net pay</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Medical Fee:</td>
                        <td>Cultural Fee:</td>
                        <td></td>
                    </tr>
                </table>
                 <p  class="text-center mt-3"style="font-size: 15px">I understand that absences are allowed only for serious illness and family emergencies. Failure to attend 50% of the class will automatically result to dropping the subject(s).</p>
                 <table class="table table-borderless table-equal mt-5">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <p class="p-3" style="border-top: 1px solid black">Student's Signature</p></td>
                    </tr>
                </table>
            </div>

            <div class="print m-5">
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

        saveBtn.addEventListener('click', async function() {
            // Create PDF
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            
            // First page (front)
            await html2canvas(document.querySelector('#college-form-front'), {
                scale: 2,
                useCORS: true,
                logging: true
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/jpeg', 1.0);
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imageWidth = canvas.width;
                const imageHeight = canvas.height;
                
                const ratio = Math.min(pageWidth / imageWidth, pageHeight / imageHeight);
                const width = imageWidth * ratio;
                const height = imageHeight * ratio;
                
                const x = (pageWidth - width) / 2;
                const y = (pageHeight - height) / 2;
                
                pdf.addImage(imgData, 'JPEG', x, y, width, height);
            });

            // Add new page for back
            pdf.addPage();

            // Second page (back)
            await html2canvas(document.querySelector('#college-form-back'), {
                scale: 2,
                useCORS: true,
                logging: true
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/jpeg', 1.0);
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imageWidth = canvas.width;
                const imageHeight = canvas.height;
                
                const ratio = Math.min(pageWidth / imageWidth, pageHeight / imageHeight);
                const width = imageWidth * ratio;
                const height = imageHeight * ratio;
                
                const x = (pageWidth - width) / 2;
                const y = (pageHeight - height) / 2;
                
                pdf.addImage(imgData, 'JPEG', x, y, width, height);
            });

            // Save the PDF with both pages
            pdf.save('enrollment-form.pdf');
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

    <script src="../../html2canvas.js"></script>
    <script src="../../faqs.js"></script>
    <script src="../layout/sectionNav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>