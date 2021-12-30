<?php
include '../classes/Admin.php';
if(isset($_POST['username'])){
    session_start();
    include '../config.php';
    if($_POST['username']=='admin' && $_POST['password']=='ad@nike76'){
        $admin_temp = Admin::getInstance();
        $_SESSION['admin'] = $admin_temp;
        header('Location: index.php');
        
    }
    else{
        header('Location:login.php?msg=failed');
    }
}
?>