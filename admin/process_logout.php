<?php
include '../classes/Admin.php';
session_start();
if(isset($_SESSION['admin'])){
    $admin = $_SESSION['admin'];
    $admin->log_out();
    
}
    else{
        
        header('Location:login.php');
    }

?>