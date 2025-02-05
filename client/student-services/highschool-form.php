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
            background-image: url('../../asset/img/blur-bg.png');
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
            border-bottom: 1px solid black;
            font-size: 13px;
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
        
            <div class="box mt-3 p-3" style="min-height: 29.7cm; width: 30cm; background: white;" id="college-form-front">
                  
                    <table class="table-equal table table-borderless" style="font-size: 13px;">
                        <tr>
                            <td colspan="5">
                                <header class="d-flex justify-content-center align-items-center">
                                    <img src="../../asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                                    <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                                        <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                                        <label>Moldero St., Purok 5, Bulanao</lab> <br>
                                        <label>Tabuk City, Kalinga 3800</label> <br>
                                    </div>
                                </header>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">JUNIOR HIGH DEPARTMENT ENROLLMENT FORM</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">Registart Copy</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">OLD ( ) NEW ( ) OUT ( )  TRANSFERRED IN ( )</td>
                        </tr>
                        <tr>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FAMILY NAME:</td>
                            <td>GIVEN NAME</td>
                            <td>MIDDLE NAME:</td>
                            <td>Sex:<span contenteditable="true">_______  </span></td>
                            <td>Birthdate:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">(mm/dd/yyyy):</td>
                        </tr>
                        <tr>
                            <td colspan="2">Birthplace:<span contenteditable="true">_______  </span></td>
                            <td colspan="2">Home Address:<span contenteditable="true">_______  </span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Father’s Name:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Occupation:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Contact#:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td>Mother’s Name:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Occupation:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Contact#:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr?>
                            <td colspan="5">Parents/Guardians Mailing Address: <span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td colspan="5">Last School Attended:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Name of School:</td>
                            <td></td>
                            <td>Business Address:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Admitted to GRADE N/K:</td>
                            <td></td>
                            <td class="text-center"> 7     8     9     10</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Date of Admission:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2" class="text-center">
                                <p style="border-top: 1px solid black;" class="p-3">Student’s/Parent’s/Guardian’s Signature over Printed Name:</p>
                            </td>
                        </tr>
                    </table>

                   
                    <table class="table-equal table table-borderless" style="font-size: 13px;">
                        <tr>
                            <td colspan="5">
                                <header class="d-flex justify-content-center align-items-center">
                                    <img src="../../asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                                    <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                                        <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                                        <label>Moldero St., Purok 5, Bulanao</lab> <br>
                                        <label>Tabuk City, Kalinga 3800</label> <br>
                                    </div>
                                </header>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">JUNIOR HIGH DEPARTMENT ENROLLMENT FORM</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">Principal, Guidance Copy</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">OLD ( ) NEW ( ) OUT ( )  TRANSFERRED IN ( )</td>
                        </tr>
                        <tr>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FAMILY NAME:</td>
                            <td>GIVEN NAME</td>
                            <td>MIDDLE NAME:</td>
                            <td>Sex:<span contenteditable="true">_______  </span></td>
                            <td>Birthdate:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">(mm/dd/yyyy):</td>
                        </tr>
                        <tr>
                            <td colspan="2">Birthplace:<span contenteditable="true">_______  </span></td>
                            <td colspan="2">Home Address:<span contenteditable="true">_______  </span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Father’s Name:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Occupation:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Contact#:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td>Mother’s Name:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Occupation:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Contact#:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr?>
                            <td colspan="5">Parents/Guardians Mailing Address: <span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td colspan="5">Last School Attended:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Name of School:</td>
                            <td></td>
                            <td>Business Address:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Admitted to GRADE N/K:</td>
                            <td></td>
                            <td class="text-center"> 7     8     9     10</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Date of Admission:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2" class="text-center">
                                <p style="border-top: 1px solid black;" class="p-3">Student’s/Parent’s/Guardian’s Signature over Printed Name:</p>
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table-equal table table-borderless" style="font-size: 11px;">
                        <tr>
                            <td colspan="5">
                                <header class="d-flex justify-content-center align-items-center">
                                    <img src="../../asset/img/kcst1.png" class="img-fluid p-3" style="width: 60px;" alt="">
                                    <div class="header-title text-center" style="font-size: 9px; font-weight: bold;">
                                        <label>KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY INC.</label> <br>
                                        <label>Moldero St., Purok 5, Bulanao</lab> <br>
                                        <label>Tabuk City, Kalinga 3800</label> <br>
                                    </div>
                                </header>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">JUNIOR HIGH DEPARTMENT ENROLLMENT FORM</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">Accounting Copy</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">OLD ( ) NEW ( ) OUT ( )  TRANSFERRED IN ( )</td>
                        </tr>
                        <tr>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td><span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FAMILY NAME:</td>
                            <td>GIVEN NAME</td>
                            <td>MIDDLE NAME:</td>
                            <td>Sex:<span contenteditable="true">_______  </span> </td>
                            <td>Birthdate:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">(mm/dd/yyyy):</td>
                        </tr>
                        <tr>
                            <td>Down Payment:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Applied Monthly Fee:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td>Full Payment:<span contenteditable="true">_______  </span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Applied Availed Discounts:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tuition Fee:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Registration Fee:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous Fee:<span contenteditable="true">_______  </span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Others (Specify):<span contenteditable="true">_______  </span></td>
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
                            <td class="text-center">
                                <p style="border-top: 1px solid black;" class="p-2">School Cashier</p>
                            </td>
                        </tr>
                    </table>


                    

                    


            </div>


            <div class="box mt-3 py-4 px-3"  style="min-height: 29.7cm; width: 30cm; background: white;" id="college-form-back">
                <table class="table table-borderless table-equal">
                    <tr>
                        <td><span contenteditable="true">_______  </span></td>
                        <td></td>
                        <td><span contenteditable="true">_______  </span></td>
                        <td></td>
                        <td><span contenteditable="true">_______  </span></td>
                    </tr>
                    <tr>
                        <td>FAMILY NAME</td>
                        <td></td>
                        <td>GIVEN NAME</td>
                        <td></td>
                        <td>MIDDLE NAME</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>is admitted to GRADE</td>
                        <td>7 - 8 - 9 - 10</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>REQUIREMENTS SUBMITTED:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">( ) Form 138 (Report Card/Form 137/Permanent Record)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">( ) Birth Certificate (Photocopy/NSO Released)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">( ) Others (Specify) <span contenteditable="true">_______  </span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                <table class="table table-borderless table-equal">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>SKETCH OF HOUSE LOCATION</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                <table class="table table-borderless table-equal">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>PARENTS-SCHOOL AGREEMENT</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            1. Payments are required to attend quarterly parent-teacher meeting as scheduled. <br>
                            2. Pay our financial obligation as per schedule of payment, the First Week of each month. If unable to pay on time,
                            special arrangement will be made together with the school cashier. <br>
                            3. No refund of payment if payment done is only for down payment assessed. <br>
                            4. For full cash payment, refund of 40% on tuition fee only, if filed within three (3) days for regular academic year, and
                            one (1) day for summer the opening of the class. <br>
                            5. For payment in excess of down payment, 40% refund excess of tuition fee only if filed within three (3) days and one
                            (1) day grace period after opening of the regular classes. <br>
                            6. Attend one scheduled service at least once a month. 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">
                        I have fully read and understand the terms and condition of the agreement and I fully and willingly accept the said condition and
                        agreement, thereby; I set my hand this<span contenteditable="true">_______  </span>day of<span contenteditable="true">_______  </span> at KALINGA COLLEGES OF SCIENCE AND TECHNOLOGY
                        as strongly agreed upon.
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-center">
                            <p class="px-3" style="border-top: 1px solid black">Signature over printed name of Parent's/Guardian's</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Admitted By:<span contenteditable="true">_______  </span></td>
                        <td colspan="2">Attested By:<span contenteditable="true">_______  </span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Admission Officer</td>
                        <td></td>
                        <td>School Cashier</td>
                        <td></td>
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