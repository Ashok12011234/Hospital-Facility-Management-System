<?php
#include("config.php");
include("common.php");
#include("member.php");
include("navbar.php");

$hospitalID = 1;
$sql = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$current = new Hospital($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['Profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $connection);

if (isset($_POST['updateProfile'])) {
    //$hospitalName = mysqli_real_escape_string($GLOBALS['connection'], $_POST['hospitalName']);
    $hospitalName = trim($_POST['hospitalName'],"\n\r\t\v\0");

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
    
<!--?php
include("navbar.php");
?-->
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