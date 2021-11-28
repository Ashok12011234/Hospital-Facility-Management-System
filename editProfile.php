<?php
include("connection/config.php");
include("connection/common.php");
include("member.php");

$hospitalID = 1;
$sql = "SELECT * FROM `hospital` WHERE `HospitalId`=$hospitalID;";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$current = new Hospital($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $connection);

if (isset($_POST['updateProfile'])) {
    $hospitalName = mysqli_real_escape_string($GLOBALS['connection'], $_POST['hospitalName']);
    $email = mysqli_real_escape_string($GLOBALS['connection'], $_POST['email']);
    $phoneNo = mysqli_real_escape_string($GLOBALS['connection'], $_POST['phoneNo']);
    $accountNumber = mysqli_real_escape_string($GLOBALS['connection'], $_POST['accountNumber']);
    $bankName = mysqli_real_escape_string($GLOBALS['connection'], $_POST['bankName']);
    $website = mysqli_real_escape_string($GLOBALS['connection'], $_POST['website']);
    $address = mysqli_real_escape_string($GLOBALS['connection'], $_POST['address']);
    $current->set_name($hospitalName);
    $current->set_email($email);
    $current->set_phoneno($phoneNo);
    $current->set_accountNo($accountNumber);
    $current->set_bankName($bankName);
    $current->set_website($website);
    $current->set_address($address);

    $image = basename($_FILES["profile_picture"]["name"]);
    if ($image != "") {
        $target = "assets/pictures/profile/" . $image;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target);
        unlink($current->get_profile());
        $current->set_profile($target);
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
    <link rel="stylesheet" href="./assets/css/profilePage.css">
    <link rel="stylesheet" href="./assets/css/Hospital-page.css">
    <title>Edit Profile</title>
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
    <!-- Body -->
    <div class="rounded bg-white m-4 p-3 body-contentx">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="200px" <?php echo "src='" .     $current->get_profile() . "'" ?>>
                        <div class="input-group  input-group-sm mb-3" style="width: 300px;">
                            <input type="file" class="form-control" id="inputGroupFile02" name="profile_picture">
                            <label class="input-group-text" for="inputGroupFile02">Update</label>
                        </div>
                        <span class="font-weight-bold">Username</span>
                        <span class="text-black-50">Hospital Name</span>
                        <span> </span>
                    </div>
                </div>
                <div class="col-md-7 border-right me-3">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile</h4>
                        </div>
                        <div class="row mt-3">
                            <?php
                            echo "<div class='col-md-12'><label class='labels fw-bold'>Username</label><input type='text' name='username' class='form-control' placeholder='' value=" . $current->get_username() . " disabled ></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Hospital Name</label><input type='text' name='hospitalName' class='form-control' placeholder='' value=" . $current->get_name() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Email ID</label><input type='text' name='email' class='form-control' placeholder='' value=" . $current->get_email() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Phone</label><input type='text' name='phoneNo' class='form-control' placeholder='' value=" . $current->get_phoneno() . "></div>
                                <div class='row'><div class='col-6'><label class='labels fw-bold'>Account Number</label><input type='text' name='accountNumber' class='form-control' placeholder='' value=" . $current->get_accountNo() . "></div><div class='col-6'><label class='labels fw-bold'>Bank Name</label><input type='text' class='form-control' name='bankName' placeholder='' value=" . $current->get_bankName() . "></div></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Website</label><input type='text' name='website' class='form-control' placeholder='' value=" . $current->get_website() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Address</label><input type='text' name='address' class='form-control' placeholder='' value='" . $current->get_address() . "'></div>";
                            ?>
                        </div>
                        <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button" name="updateProfile">Edit Profile</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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