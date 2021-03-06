<?php
include("classes/probDomCls/member.php");
session_start();
$error = "";
$success = "";

if (array_key_exists("acID", $_SESSION) && array_key_exists("type", $_SESSION)) {
    header("Location: hospitalDashoard.php");
}

if (array_key_exists("next", $_POST)) {
    if (array_key_exists("forgot", $_GET)) {
        $status = Member::forgotPassword(QueryExecutor::real_escape_string($_POST["username"]));
        if ($status == ForgotPassword::SUCCESS) {$success = $status;}
        else {$error = $status;}
    }
    else {
        $error = Member::login(QueryExecutor::real_escape_string($_POST["username"]), QueryExecutor::real_escape_string($_POST["password"]));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="box-shadow: 0px 0px;">
    <section class="login-clean" style="padding-top:
        <?php
        if ($error != "") {
            echo "10%";
        } else {
            echo "13%";
        }
        ?>
    ;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <input class="form-control-plaintext" type="text" value="Life Share" readonly="">
            </div>
            <div class="form-group input-group">
                <span class="input-group-text"><i class="fa fa-user" style="font-size:15px;"></i></span>
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <?php
                if(!array_key_exists("forgot", $_GET)) {
                    echo '  <div class="form-group input-group">
                                <span class="input-group-text"><i class="fa fa-lock" style="font-size:15px;"></i></span>
                                <input class="form-control"  type="password" name="password" placeholder="Password" required>
                            </div>';
                }
            ?>
            <?php
            if(!array_key_exists("forgot", $_GET)) {
                echo '<a class="forgot" href="login.php?forgot=">Forgot password?</a>';
            }
            else {
                echo '<a class="forgot" href="login.php">Login</a>';
            }
            ?>
            <div class="form-group">
                <?php
                if(!array_key_exists("forgot", $_GET)) {
                    echo '<button class="btn btn-primary btn-block" type="submit" name="next" style="background: var(--green);">
                        Log in
                        </button>';
                }
                else {
                    echo '<button class="btn btn-primary btn-block" type="submit" name="next" id="send-password" style="background: var(--green);">
                        Next
                        </button>';
                }
                ?>
            </div>
            <div class="float-clear"></div>
            <div style="text-align: center;">
                <a class="forgot" href="./signup.php" style="display: inline;">Sign up</a>
                <span style="color: #198754;"> | </span>
                <a class="forgot" href="hospitalDashoard.php" style="display: inline;">Visit as a guest</a>
            </div>
            <?php
            if ($error != "") {
                echo '<div class="alert alert-danger mx-0 mt-2 mb-1" role="alert" style="text-align:center; font-weight:600;">' . $error . '</div>';
            }
            ?>
            <?php
            if ($success != "") {
                echo '<div class="alert alert-primary mx-0 mt-2 mb-1" role="alert" style="text-align:center; font-weight:600;">' . $success . '</div>';
            }
            ?>
        </form>
    </section>
    <div id="mail-sending" class="container text-center my-5 p-4">
        <p>Mail is being sent</p>
        <!--p class="lead">You will be redirected to Check New Request Page very shortly</p-->
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#send-password").click(function() {
            if ($("#username").val() != "") {
                $("#mail-sending").css("display", "block");
                $("section").css("display", "none");
            }
        });
    </script>
</body>

</html>
