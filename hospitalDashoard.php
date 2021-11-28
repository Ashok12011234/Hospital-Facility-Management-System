<?php
include('connection/config.php');
include('connection/common.php');

function hospitalDashboard_Fetchhospitals()
{
    $sql = "SELECT * FROM `hospital`;";
    $result = mysqli_query($GLOBALS['connection'], $sql);
    $out = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $out .= "<div class='col-md-6 col-xl-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='mb-3' style='min-height: 150px; background-color: teal;'></div>
                        <div class='row justify-content-between mb-1'>
                            <h3 class='col-9 card-title'>" . limitingContent($row['Name'], 18) . "</h3>
                            <!-- <i class='fas fa-star col-1 fa-lg'></i> -->
                            <i class='far fa-star col fa-lg ms-4'></i>
                        </div>
                        <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i class='fas fa-map-marker-alt'></i>&nbsp;
                            " . $row['Address'] . "</p>
                        <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;" . $row['TelephoneNo'] . "</p>
                        <div class='row'>
                            <div class='col-6 Hospital-Facilities'>
                                <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
                                <div class='row justify-content-start ms-1'>
                                    <div class='col-6'>
                                        <p class='available'>Normal Bed</p>
                                    </div>
                                    <div class='col-6'>
                                        <p class='shortage'>ICU Bed</p>
                                    </div>
                                </div>
                                <p style='margin-bottom: -25px; margin-top: 2px;'>Blood</p> <br />
                                <div class='row justify-content-start ms-1'>
                                    <div class='col-4'>
                                        <p class='available'>A+</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='available'>O+</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='shortage'>B+</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='available' style='font-size: 11.5px;'>AB+</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='available'>A-</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='shortage'>O-</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='available'>B-</p>
                                    </div>
                                    <div class='col-4'>
                                        <p class='shortage'>AB-</p>
                                    </div>
                                </div>

                                <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
                                <div class='row justify-content-start ms-1'>
                                    <div class='col-6'>
                                        <p class='available'>Small</p>
                                    </div>
                                    <div class='col-6'>
                                        <p class='shortage'>Large</p>
                                    </div>
                                </div>
                            </div>
                            <div class='col-6 '>
                                <p style='margin-bottom: 0px;'>Vaccine</p> <br />
                                <div class='row justify-content-start ms-1'>
                                    <p class='available'>Oxford-Astrazeneca</p>
                                    <p class='shortage'>Pfizer-BioNTech</p>
                                    <p class='available'>Moderna</p>
                                    <p class='available'>Sinopharm</p>
                                    <p class='shortage'>Sputnik V</p>
                                </div>
                            </div>
                        </div>
                        <button class='btn btn-success w-100 mt-4 me-2'>Request</button>
                        <!-- <p class='text-end' style='margin-bottom: -5px; margin-top: -5px;'><a href='#'
                            style='text-decoration: none; color: #aaa;'>See
                            more..</a>
                    </p> -->
                    </div>
                </div>
            </div>";
        }
    } else {
        $out .= "No posts found";
    }
    return $out;
}

function hospitalDashboard_Fetchproviders()
{
    $sql = "SELECT * FROM `provider`;";
    $result = mysqli_query($GLOBALS['connection'], $sql);
    $out = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $out .= "<div class='col-md-6 col-xl-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='mb-3' style='min-height: 150px; background-color: teal;'></div>
                        <div class='row justify-content-between mb-1'>
                            <h3 class='col-10 card-title'>" . limitingContent($row['Name'], 18) . "</h3>
                            <i class='fas fa-star col-1'></i>
                            <i class='far fa-star col-1'></i>
                        </div>
                        <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i class='fas fa-map-marker-alt'></i>&nbsp;
                           " . limitingContent($row['Address'], 18) . "</p>
                        <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;" . limitingContent($row['TelephoneNo'], 18) . "</p>

                        <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
                        <div class='row justify-content-start ms-1'>
                            <div class='col-6'>
                                <p>Normal Bed</p>
                            </div>
                        </div>
                        <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
                        <div class='row justify-content-start ms-1'>
                            <div class='col-3'>
                                <p>Small</p>
                            </div>
                            <div class='shortage col-3'>
                                <p>Medium</p>
                            </div>
                            <div class='col-3'>
                                <p>Large</p>
                            </div>
                        </div>
                        <button class='btn btn-success float-end me-2'>Request</button>
                    </div>
                </div>
            </div>";
        }
    } else {
        $out .= "No result found";
    }
    return $out;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/Hospital-page.css">
    <title>Dashboard</title>
</head>

<body>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="background-color: #e3f2fd;">
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <a class="navbar-brand ms-3" href="#" style="font-size: x-large;  font-size: 1.5em; font-family: Monospace; font-weight: bold;">Life Share</a>
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto me-2" style="font-size: large;">
                <li class="nav-item ms-2">
                    <a class="nav-link" href="./hospitalDashoard.php">Home</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="#">Hospitals</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="#">Providers</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="#">Stared</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="./requestDashboard.php">Requests</a>
                </li>
            </ul>
        </div>

        <!--Navbar notification panel-->
        <div class="dropdown me-4 ms-auto" style="user-select: none;">
            <i class="fas fa-bell" id="hospitalNotificationBell" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-pill">
                0
            </span>

            <div class="dropdown-menu mt-4" aria-labelledby="hospitalNotificationBell" id="hospitalNotificationsPanel">
                <p class="fs-6">No notifications to show</p>
                <div onclick="myhref('#');" style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>
                <hr style="margin-bottom: 0px;">
                <div style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>
                <hr style="margin-bottom: 0px;">
                <div style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>


            </div>
        </div>

        <!--Navbar Signout panel-->
        <div class="dropdown" style="user-select: none;">
            <div id="hospitalDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./assets/documents/PageDocuments/Comman/Images/defaultDp.png" alt="usericon" style="inline-size: 40px; border-radius: 30px;" class="ms-2">
                <span class="user-name me-4 ms-1" id="hospitalDropdownButton">Name</span>
            </div>
            <div class="dropdown-menu mt-3" aria-labelledby="hospitalDropdownButton" id="hospitalDropdownPanel">
                <a href="#" style="text-decoration: none; color: black;">
                    <h2>Hospital 1<img src="./assets/documents/PageDocuments/Comman/Images/defaultDp.png" alt="usericon" style="inline-size:55px; border-radius: 30px; float: right;" class="ms-2"></h2>
                </a>
                <p class="ms-2" style="font-size: 15px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                    No1,
                    Hospital
                    Road,
                    Jaffna</p>
                <p class="m-2" style="font-size: 15px;"><i class="fas fa-phone"></i> &nbsp;0212211001</p>
                <hr>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 10px;"><a href="./editProfile.php" id="hospitalSignoutPannel">
                            Edit Profile</a></li>
                    <li style="margin-bottom: 10px;"><a href="./updateResources.php" id="hospitalSignoutPannel">
                            Update Resources</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" id="hospitalSignoutPannel">
                            Help</a></li>
                    <li><a href="#" id="hospitalSignoutPannel">
                            Logout</a></li>
                </ul>
            </div>
        </div>
        </div>
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
    <!--Navbar end-->

    <!-- Headings and title-->

    <div class="row justify-content-between mt-5 ms-2 me-2">
        <div class="col-md-8 ">
            <h2>All Hospitals & Providers</h2>
            <br>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type=" text" class="form-control" placeholder="Search for Hospital or Provider" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Headings and title end-->

    <!--Content-->
    <div class="container mt-5 mb-4">
        <div class="row">
            <?php
            echo hospitalDashboard_Fetchhospitals();
            echo hospitalDashboard_Fetchproviders();
            ?>
            <!-- <div class="col-md-6 col-xl-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                        <div class="row justify-content-between mb-1">
                            <h3 class="col-9 card-title">Hospital2 Jaffna</h3>
                            <!-- <i class="fas fa-star col-1 fa-lg"></i> 
            <i class="far fa-star col fa-lg ms-4"></i>
        </div>
        <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
            No1,
            Hospital
            Road,
            Jaffna</p>
        <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;02122110010</p>
        <div class="row">
            <div class="col-6 Hospital-Facilities">
                <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                <div class="row justify-content-start ms-1">
                    <div class="col-6">
                        <p class="available">Normal Bed</p>
                    </div>
                    <div class="col-6">
                        <p class="shortage">ICU Bed</p>
                    </div>
                </div>
                <p style="margin-bottom: -25px; margin-top: 2px;">Blood</p> <br />
                <div class="row justify-content-start ms-1">
                    <div class="col-4">
                        <p class="available">A+</p>
                    </div>
                    <div class="col-4">
                        <p class="available">O+</p>
                    </div>
                    <div class="col-4">
                        <p class="shortage">B+</p>
                    </div>
                    <div class="col-4">
                        <p class="available" style="font-size: 11.5px;">AB+</p>
                    </div>
                    <div class="col-4">
                        <p class="available">A-</p>
                    </div>
                    <div class="col-4">
                        <p class="shortage">O-</p>
                    </div>
                    <div class="col-4">
                        <p class="available">B-</p>
                    </div>
                    <div class="col-4">
                        <p class="shortage">AB-</p>
                    </div>
                </div>

                <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                <div class="row justify-content-start ms-1">
                    <div class="col-6">
                        <p class="available">Small</p>
                    </div>
                    <div class="col-6">
                        <p class="shortage">Large</p>
                    </div>
                </div>
            </div>
            <div class="col-6 ">
                <p style="margin-bottom: 0px;">Vaccine</p> <br />
                <div class="row justify-content-start ms-1">
                    <p class="available">Oxford-Astrazeneca</p>
                    <p class="shortage">Pfizer-BioNTech</p>
                    <p class="available">Moderna</p>
                    <p class="available">Sinopharm</p>
                    <p class="shortage">Sputnik V</p>
                </div>
            </div>
        </div>
        <button class="btn btn-success w-100 mt-4 me-2">Request</button>
         <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;"><a href="#"
                            style="text-decoration: none; color: #aaa;">See
                            more..</a>
                    </p>
        </div>
    </div>


    Producer
    <div class="col-md-6 col-xl-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                <div class="row justify-content-between mb-1">
                    <h3 class="col-10 card-title">Producer 1</h3>
                    <i class="fas fa-star col-1"></i>
                    <i class="far fa-star col-1"></i>
                </div>
                <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                    No1,
                    Producer 1
                    Road,
                    Jaffna</p>
                <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;01101010101</p>

                <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                <div class="row justify-content-start ms-1">
                    <div class="col-6">
                        <p>Normal Bed</p>
                    </div>
                </div>
                <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                <div class="row justify-content-start ms-1">
                    <div class="col-3">
                        <p>Small</p>
                    </div>
                    <div class="shortage col-3">
                        <p>Medium</p>
                    </div>
                    <div class="col-3">
                        <p>Large</p>
                    </div>
                </div>


                <button class="btn btn-success float-end me-2">Request</button>

            </div>
        </div>
    </div> -->
        </div>
    </div>


    <!--Footer-->
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="https://www.facebook.com/hpbsrilanka/" target="_blank" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/hpbsrilanka" target="_blank" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/channel/UC6XsnLgVVzNkjTCpRVJ6u3w" target="_blank" class="me-4 text-reset">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.instagram.com/hpbsrilanka" target="_blank" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>

            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-sm-6 col-lg-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>

                        <p>

                            <a class="link-success" href="mailto: healthpromo@sltnet.lk"><i class="fas fa-envelope me-3"></i> healthpromo@sltnet.lk</a>
                        </p>
                        <p><a class="link-success" href="tel:+94 11 2696 606"><i class="fas fa-phone me-3"></i> +94 11
                                2696 606</a></p>
                        <p> <a class="link-success" href="fax:+94 11 2692 613"><i class="fas fa-print me-3"></i> +94 11
                                2692 613</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-sm-6 col-lg-3  mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;&nbsp; Our Address

                        </h6>
                        <p>
                            <b> Health Promotion Bureau </b> <br>
                            No.2, Kynsey Road, <br>
                            Colombo 08, <br>
                            Sri Lanka.
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-sm-3 col-md-6 col-lg-2  mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Links
                        </h6>
                        <p>
                            <a class="link-success" href="https://hpb.health.gov.lk/en" target="_blank" class="text-reset">Ministry Home</a>
                        </p>
                        <p>
                            <a class="link-success" href="https://hpb.health.gov.lk/en/covid-19" target="_blank" class="text-reset">Covid Info</a>
                        </p>

                        <p>
                            <a class="link-success" href="https://hpb.health.gov.lk/en/technical-units" target="_blank" class="text-reset">Technical Units</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-sm-9  col-md-6 col-lg-4  mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            &nbsp;&nbsp; Important Contacts
                        </h6>
                        <p>
                        <ul class="footer-menu">

                            <li style="text-align: left;"><b>Suwasariya Hotline:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:1999">1999</a></li>
                            <li style="text-align: left;"><b>Epidemiology Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940112695112">+94 011 269 5112</a></li>
                            <li style="text-align: left;"><b>Quarantine Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940112112705">+94 011 211 2705</a></li>
                            <li style="text-align: left;"><b>Disaster Management Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940113071073">+94 011 307 1073</a></li>


                        </ul>
                        </p>

                    </div>
                    <!-- Grid column -->


                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="#">Hospital Management System</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->




</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
    function myhref(web) {
        window.location.href = web;
    }
</script>

</html>