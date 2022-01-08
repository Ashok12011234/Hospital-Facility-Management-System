<?php
include("navbar.php");
include("request.php");

if (array_key_exists("id", $_GET) && array_key_exists("type", $_GET)) {
    if ($_GET["type"] == RequestType::HH_REQUEST) {
        $request = new HHRequest($_GET["id"]);
    }
    else {
        $request = new HPRequest($_GET["id"]);
    }
    $request->assignAll();
    if (array_key_exists("send", $_POST)) {
        $request->sendMsg($user, QueryExecutor::real_escape_string($_POST["msg"]));
        
    }
    $request->buildChat();
    $chat = $request->getChat();
}
else {

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/Hospital-page.css">
    <link rel="stylesheet" href="assets/css/Request-Page.css">
    <title>Request</title>
</head>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

    <script src="donate.js"></script>
<body>
    <!-- Headings and title-->
    <div class="row justify-content-between mt-5 ms-2 me-2">
        <div class="col-md-8 ">
            <h2>Request</h2>
            <br>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <select class="form-select" aria-label="Default select example" disabled>
                    <option selected>Sent requests</option>
                    <option value="1">Receive requests</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Headings and title end-->

    <!--Content-->
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-1">
                            <h2 class="col-9 card-title">ID - 21091101A</h2>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">From</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="#fromModal">
                                    user-name
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="fromModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">From</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--div class="mb-3" style="min-height: 150px; background-color: teal;"></div-->
                                        <div class="row justify-content-between mb-1">
                                            <h3 class="col-10 card-title">Hospital x</h3>
                                            <i class="fas fa-star col-1"></i>
                                            <i class="far fa-star col-1"></i>
                                        </div>
                                        <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i
                                                class="fas fa-map-marker-alt"></i>&nbsp;
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
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-success">Request</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary col-6" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">To</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    user-name
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">To</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--div class="mb-3" style="min-height: 150px; background-color: teal;"></div-->
                                        <div class="row justify-content-between mb-1">
                                            <h3 class="col-10 card-title">Hospital x</h3>
                                            <i class="fas fa-star col-1"></i>
                                            <i class="far fa-star col-1"></i>
                                        </div>
                                        <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i
                                                class="fas fa-map-marker-alt"></i>&nbsp;
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
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-success">Request</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary col-6" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Equipment</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                    Normal Bed
                                </p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Quantity</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                    3
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-primary" disabled>Requested</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-6 px-1">
                                <button class="btn btn-success">Accept</button>
                            </div>
                            <div class="col-6 px-1">
                                <button class="btn btn-danger">Decline</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-success" disabled>Accepted</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-danger" disabled>Declined</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-warning">Transport</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-warning" disabled>Transporting</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-secondary">Confirm exchange</button>
                            </div>
                        </div>
                        <div class="row mb-2" id="status">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-success" disabled>Exchange completed</button>
                            </div>
                        </div>
                        <div class="row" id="status" style="margin-bottom: -5px;">
                            <div class="col-12 px-1">
                                <button type="button" class="btn btn-dark">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h3><?php if($request->getTo()->get_username() == $user->get_username()){echo $request->getFrom()->get_username();}else{echo $request->getTo()->get_username();}?><h3>
                            </div>
                            <div id="chat-box-body" class="card-body">
                                <?php
                                    $messages = $chat->getMessages();
                                    foreach($messages as $msg)
                                    {
                                        $txt = $msg->getMsg();
                                        if (($msg->getSenderType() == strtoupper(get_class($user))) 
                                            && ($msg->getSenderId() == $user->get_id())) {
                                            echo '<div class="message" style="float: right;background-color: #f2e4fd;">'.$txt.'</div><br>
                                                  <div style="clear: both;"></div>';
                                        }
                                        else {
                                            echo '<div class="message" style="float: left;background-color: #f0fde4;">'.$txt.'</div><br>
                                                  <div style="clear: both;"></div>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="input-group">
                                <textarea id="chat-textarea" class="form-control" aria-label="With textarea" name="msg"></textarea>
                                <button type="submit" name="send" class="input-group-text btn btn-link chat-btn"><i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    function myhref(web) {
        window.location.href = web;
    }

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</html>
