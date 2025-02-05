let mainNav = document.getElementById('mainNav');

if (mainNav) {
    mainNav.innerHTML = `
    <div class="navbar navbar-expand-xl navbar-dark fixed-top d-flex justify-content-between align-items-center">

            <div class="navbar-brand d-flex justify-content-center align-items-center">
                <img src="../asset/img/kcst1.png" alt="logo" class="img-fluid">
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
                                <a href="./about/objective.php" class="dropdown-item">Objective</a>
                            </li>
                            <li>
                                <a href="./about/core.php" class="dropdown-item">Core Values</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">Organizational Structure</a>
                            </li>
                            <li>
                                <a href="./about/history.php" class="dropdown-item">History Logo</a>
                            </li>
                            <li>
                                <a href="./about/history.php" class="dropdown-item">School History</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">STUDENT SERVICES</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">School Announcement</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">School Events</a>
                            </li>
                    
                            <li>
                                <a href="./student-services/weather-update.php" class="dropdown-item">Weather Updates</a>
                            </li>
                           
                            <li>
                                <a href="./student-services/enrollment-procedure.php" class="dropdown-item">ENROLLMENT PROCEDURE</a>
                            </li>
                            <li>
                                <a href="./student-services/releasing-billing.php" class="dropdown-item">RELEASING OF BILLING</a>
                            </li>
                            <li>
                                <a href="./student-services/good-moral.php" class="dropdown-item">RELEASING OF GOOD MORAL</a>
                            </li>
                             <li>
                                    <a href="./student-services/college-form.php" class="dropdown-item">COLLEGE FORM</a>
                                </li>
                                <li>
                                    <a href="./student-services/highschool-form.php" class="dropdown-item">HIGHSCHOOL FORM</a>
                                </li>
                                <li>
                                    <a href="./student-services/elem-form.php" class="dropdown-item">ELEMENTARY FORM</a>
                                </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#carouselExample" class="nav-link">GALLERY</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">PROGRAMS</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./programs/program-basic-educ.php" class="dropdown-item">Basic Education</a>
                            </li>
                            <li>
                                <a href="./programs/program-junior-highschool.php" class="dropdown-item">Junior & High School</a>
                            </li>
                            <li>
                                <a href="./programs/program-bsit.php" class="dropdown-item">Bs Information Technology</a>
                            </li>
                            <li>
                                <a href="./programs/program-ce.php" class="dropdown-item">Bs Computer Engineering</a>
                            </li>
                            <li>
                                <a href="./programs/program-crim.php" class="dropdown-item">Bs Criminology</a>
                            </li>
                            <li>
                                <a href="./programs/program-hospitality.php" class="dropdown-item">Bs Hospitality Management</a>
                            </li>
                            <li>
                                <a href="./programs/program-basic-educ.php" class="dropdown-item">Bs Education</a>
                            </li>
                        </ul>
                    </li>
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

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">ABOUT US</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./about/objective.php" class="dropdown-item">Objective</a>
                            </li>
                            <li>
                                <a href="./about/core.php" class="dropdown-item">Core Values</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">Organizational Structure</a>
                            </li>
                            <li>
                                <a href="./about/history.php" class="dropdown-item">History Logo</a>
                            </li>
                            <li>
                                <a href="./about/history.php" class="dropdown-item">School History</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">STUDENT SERVICES</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">School Announcement</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">School Events</a>
                            </li>
                    
                            <li>
                                <a href="./student-services/weather-update.php" class="dropdown-item">Weather Updates</a>
                            </li>
                           
                            <li>
                                <a href="./student-services/enrollment-procedure.php" class="dropdown-item">ENROLLMENT PROCEDURE</a>
                            </li>
                            <li>
                                <a href="./student-services/releasing-billing.php" class="dropdown-item">RELEASING OF BILLING</a>
                            </li>
                            <li>
                                <a href="./student-services/good-moral.php" class="dropdown-item">RELEASING OF GOOD MORAL</a>
                            </li>
                             <li>
                                    <a href="./student-services/college-form.php" class="dropdown-item">COLLEGE FORM</a>
                                </li>
                                <li>
                                    <a href="./student-services/highschool-form.php" class="dropdown-item">HIGHSCHOOL FORM</a>
                                </li>
                                <li>
                                    <a href="./student-services/elem-form.php" class="dropdown-item">ELEMENTARY FORM</a>
                                </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#carouselExample" class="nav-link">GALLERY</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">PROGRAMS</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./programs/program-basic-educ.php" class="dropdown-item">Basic Education</a>
                            </li>
                            <li>
                                <a href="./programs/program-junior-highschool.php" class="dropdown-item">Junior & High School</a>
                            </li>
                            <li>
                                <a href="./programs/program-bsit.php" class="dropdown-item">Bs Information Technology</a>
                            </li>
                            <li>
                                <a href="./programs/program-ce.php" class="dropdown-item">Bs Computer Engineering</a>
                            </li>
                            <li>
                                <a href="./programs/program-crim.php" class="dropdown-item">Bs Criminology</a>
                            </li>
                            <li>
                                <a href="./programs/program-hospitality.php" class="dropdown-item">Bs Hospitality Management</a>
                            </li>
                            <li>
                                <a href="./programs/program-basic-educ.php" class="dropdown-item">Bs Education</a>
                            </li>
                        </ul>
                    </li>
            </div>

            <div class="navbar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">ADMIN</a>
                    </li>
                </ul>
            </div>
                </div>
            </div>

    </div>
    
    
    `;

}


