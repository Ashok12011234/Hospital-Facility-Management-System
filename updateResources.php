<?php
include("member.php");
include('common.php');

$hospitalID = 1;
$sql = "SELECT * FROM `hospital` WHERE `HospitalId`=$hospitalID;";
//$sql = "SELECT * FROM `hospital` WHERE 1";
$result = QueryExecutor::query($sql);
$row = $result->fetch_assoc();
$Hospital = Hospital::getInstance($hospitalID);




if ((isset($_POST['updateResources']))) {
    //print_r($Hospital);
    if ($_POST['password-confirm'] == $Hospital->get_password()) {
        $Hospital->set_bed();
        $Hospital->set_vaccine();
        $Hospital->set_blood();
        $Hospital->set_ceylinder();
    } else {
        header('location:google.lk');
    }
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
    <link rel="stylesheet" href="./assets/css/Hospital-page.css">
    <link rel="stylesheet" href="./assets/css/profilePage.css">
    <title>Update Resources</title>
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
                    <a class="nav-link" href="#">Requests</a>
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
    <!-- body -->
    <div class="justify-content-center d-flex body-contentx">
        <div class="rounded bg-white m-5" style="width: 75%;">
            <div class="row justify-content-center ps-5">
                <form action="" method="post" id="resources-form">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-right">Resources</h4>
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels fw-bold fs-5 mt-2">Bed</label>
                            <div class="row  ms-1 me-2">
                                <?php
                                $hospitalID = 1;
                                $sql = "SELECT * FROM `hospitalbeddetail`  WHERE HospitalId=$hospitalID;";
                                $result = QueryExecutor::query($sql);
                                $row = $result->fetch_assoc();
                                ?>
                                <div class="col-6 fw-light"><label for="normalBed">Normal Bed</label> <input class="form-check-input float-end text-end me-2" type="checkbox" name="bed[]" id="normalBed" value="normalBed" <?php
                                                                                                                                                                                                                            if ($row['NormalAvailability'] == "YES") {
                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            ?>></div>
                                <div class="col-6 fw-light"> <label for="icuBed">ICU Bed</label> <input class="form-check-input float-end text-end me-2" type="checkbox" name="bed[]" id="icuBed" value="icuBed" <?php
                                                                                                                                                                                                                    if ($row['ICUAvailability'] == "YES") {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="labels fw-bold fs-5 mt-2">Blood</label>
                            <div class="row ms-1 me-2">
                                <?php
                                $sql = "SELECT * FROM `blooddetail`  WHERE HospitalId=$hospitalID;";
                                $result = QueryExecutor::query($sql);
                                $row = $result->fetch_assoc();
                                //print_r($row);
                                ?>
                                <div class="col-3 fw-light"><label for="bloodAp">A+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodAp" value="bloodAp" <?php
                                                                                                                                                                                                                if ($row['AplusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodBp">B+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodBp" value="bloodBp" <?php
                                                                                                                                                                                                                if ($row['BplusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodOp">O+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodOp" value="bloodOp" <?php
                                                                                                                                                                                                                if ($row['OplusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodABp">AB+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodABp" value="bloodABp" <?php
                                                                                                                                                                                                                    if ($row['ABplusAvailability'] == "YES") {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>></div>
                            </div>
                            <div class="row mt-2 ms-1 me-2">
                                <div class="col-3 fw-light"><label for="bloodAn">A-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodAn" value="bloodAn" <?php
                                                                                                                                                                                                                if ($row['AminusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodBn">B-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodBn" value="bloodBn" <?php
                                                                                                                                                                                                                if ($row['BminusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodOn">O-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodOn" value="bloodOn" <?php
                                                                                                                                                                                                                if ($row['OminusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="col-3 fw-light"><label for="bloodABn">AB-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodABn" value="bloodABn" <?php
                                                                                                                                                                                                                    if ($row['ABminusAvailability'] == "YES") {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="labels fw-bold fs-5 mt-2">Oxygen Cylinder</label>
                            <div class="row ms-1 me-2">
                                <?php
                                $sql = "SELECT * FROM `hospitalcylinderdetail`  WHERE HospitalId=$hospitalID;";
                                $result = QueryExecutor::query($sql);
                                $row = $result->fetch_assoc();
                                //print_r($row);
                                ?>
                                <div class="col-4 fw-light"><label for="oxCylinderSmall">Small Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderSmall" value="oxCylinderSmall" <?php
                                                                                                                                                                                                                                                        if ($row['SmallAvailability'] == "YES") {
                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?>></div>
                                <div class="col-4 fw-light"><label for="oxCylinderMedium">Medium Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderMedium" value="oxCylinderMedium" <?php
                                                                                                                                                                                                                                                            if ($row['MediumAvailability'] == "YES") {
                                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                            ?>></div>
                                <div class="col-4 fw-light"><label for="oxCylinderLarge">Large Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderLarge" value="oxCylinderLarge" <?php
                                                                                                                                                                                                                                                        if ($row['LargeAvailability'] == "YES") {
                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?>></div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="labels fw-bold fs-5 mt-2">Vaccine</label>
                            <div class="row ms-1 me-2">
                                <?php
                                $sql = "SELECT * FROM `VaccineDetail`  WHERE HospitalId=$hospitalID;";
                                $result = QueryExecutor::query($sql);
                                $row = $result->fetch_assoc();
                                //print_r($row);
                                ?>
                                <div class="fw-light"><label for="oxfordAsterzeneca">Oxford-Astrazeneca</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="oxfordAsterzeneca" value="oxfordAsterzeneca" <?php
                                                                                                                                                                                                                                                            if ($row['OxfordAvailability'] == "YES") {
                                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                            ?>></div>
                                <div class="fw-light"><label for="pfizer">Pfizer-BioNTech</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="pfizer" value="pfizer" <?php
                                                                                                                                                                                                                        if ($row['PfizerAvailability'] == "YES") {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?>></div>
                                <div class="fw-light"><label for="moderna">Moderna</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="moderna" value="moderna" <?php
                                                                                                                                                                                                                if ($row['ModernalAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                                <div class="fw-light"><label for="sinopharm">Sinopharm</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="sinopharm" value="sinopharm" <?php
                                                                                                                                                                                                                        if ($row['SinopharmAvailability'] == "YES") {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?>></div>
                                <div class="fw-light"><label for="sputnik">Sputnik V</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="sputnik" value="sputnik" <?php
                                                                                                                                                                                                                    if ($row['SputnikAvailability'] == "YES") {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="confirmPasswordModal" aria-hidden="true" aria-labelledby="confirmPasswordModal" tabindex=" -1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Enter your password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="Username" class="col-form-label">Username:</label>
                                        <input type="text" class="form-control" id="Username" value="<?php echo $Hospital->get_username(); ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-confirm" class="col-form-label">Password:</label>
                                        <input type="password" class="form-control" id="password-confirm" name="password-confirm">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary float-clear mb-3" type="submit" name="updateResources" id="updateResources">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" style="margin-left: 45%; margin-top: -30px; margin-bottom: 30px;" name="confirmPasswordbutton" id="confirmPasswordbutton" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal">Confirm</button>

            </div>

            </form>
        </div>
    </div>
    </div>
    </div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" />
< script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function myhref(web) {
            window.location.href = web;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#confirmPasswordbutton').on('click', function(e) {
                e.preventDefault();
                $('#confirmPasswordModal').modal('show');
            })
            $("#resources-form").on('submit', function(e) {
                //e.preventDefault();
                location.reload();
                //$('#confirmPasswordModal').modal('show');
            });
        });
    </script>

</html>