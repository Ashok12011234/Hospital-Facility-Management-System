<?php

include("member.php");

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
    <link rel="stylesheet" href="assets/css/Hospital-page.css">
    <title>Dashboard</title>
</head>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>

function submit(elem,equip_type,hos_or_prov){

    var e = document.getElementById("types"+hos_or_prov+equip_type+elem.value);
    var equipment = e.options[e.selectedIndex].text;

    var f = document.getElementById("input"+hos_or_prov+equip_type+elem.value);
    var quantity = f.value;
   console.log(f);
    $.ajax({
        url:'MakeRequest.php',
        type:'POST',
        data:{id:elem.value,equipment:equipment,userType:hos_or_prov,quantity:quantity},
        success:function(result){
               
            }
    });
  }

function next(elem,user_type) {
   
  
    var e = document.getElementById("category"+user_type+elem.value);
    
    switch(e.value){
        case "1":
            var typeModal = new bootstrap.Modal(document.getElementById("bedModal"+user_type+elem.value), {
                keyboard: false
            });
            typeModal.show();
            break;
        case "2":
            var typeModal = new bootstrap.Modal(document.getElementById("ceylinderModal"+user_type+elem.value), {
                keyboard: false
            });
            typeModal.show();
            break;
        case "3":
            var typeModal = new bootstrap.Modal(document.getElementById("vaccineModal"+user_type+elem.value), {
                keyboard: false
            });
            typeModal.show();
            break;
        case "4":
            var typeModal = new bootstrap.Modal(document.getElementById("bloodModal"+user_type+elem.value), {
                keyboard: false
            });
            typeModal.show();
            break;
    }
    
}

function request(elem,user_type) {
   
    var categoryModal = new bootstrap.Modal(document.getElementById('itemCategoryModal'+user_type+elem.value), {
            keyboard: false
    });
    categoryModal.show(); 
       
}

function prev(elem,user_type) {
   
   var categoryModal = new bootstrap.Modal(document.getElementById('itemCategoryModal'+user_type+elem.value), {
           keyboard: false
    });
    categoryModal.show(); 
      
}
</script>


<body>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="background-color: #e3f2fd;">
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->

        <a class="navbar-brand ms-3" href="#"
            style="font-size: x-large;  font-size: 1.5em; font-family: Monospace; font-weight: bold;">Life Share</a>

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

                <img src="./assets/documents/PageDocuments/Comman/Images/defaultDp.png" alt="usericon" style="inline-size: 40px; border-radius: 30px;"
                    class="ms-2">

                <span class="user-name me-4 ms-1" id="hospitalDropdownButton">Name</span>
            </div>
            <div class="dropdown-menu mt-3" aria-labelledby="hospitalDropdownButton" id="hospitalDropdownPanel">
                <a href="#" style="text-decoration: none; color: black;">

                    <h2>Hospital 1<img src="./assets/documents/PageDocuments/Comman/Images/defaultDp.png" alt="usericon"
                            style="inline-size:55px; border-radius: 30px; float: right;" class="ms-2"></h2>
                </a>
                <p class="ms-2" style="font-size: 15px; margin-bottom:-5px; "><i
                        class="fas fa-map-marker-alt"></i>&nbsp;

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

        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">

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

                <input type=" text" class="form-control" placeholder="Search for Hospital or Provider"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">

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


            <!-- Hospital-->
            <?php
            $_SESSION['is_selected']=false;
            $sql = "SELECT HospitalId,Name, TelephoneNo, Address FROM Hospital";
            $rows = $connection->query($sql);
            foreach($rows as $row){
                $current=new Hospital($row["HospitalId"],$row["Name"],$row['Address'],$row["TelephoneNo"],$connection);
                ?>
                  

              <div class='col-md-6 col-xl-4 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <div class='mb-3' style='min-height: 150px; background-color: teal;'></div>
                            <div class='row justify-content-between mb-1'>
                                <h3 class='col-9 card-title'>
                                <?php
                            echo $current->get_name();
                                ?>
                                </h3>
                                
                                <i class='far fa-star col fa-lg ms-4'></i>
                            </div>
                            <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i
                                        class='fas fa-map-marker-alt'></i>&nbsp;
                                <?php 
                                echo$current->get_address();
                                ?>
                                </p>
                            <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;<?php echo $current->get_phoneno();?></p>
                            <div class='row'>
                                <div class='col-6 Hospital-Facilities'>
                                    <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
                                    <div class='row justify-content-start ms-1'>
                                        <div class='col-6'>
                                            <p class="<?php 
                                           
                                            if ($current->get_bed()->check_normal()) {
                                                echo 'available';
                                            }
                                            else{
                                                echo 'shortage';
                                            } 
                                            ?>">Normal Bed </p>
                                        </div>
                                        <div class='col-6'>
                                        <p class="<?php 
                                           
                                           if ($current->get_bed()->check_icu()) {
                                               echo 'available';
                                            }
                                           else{
                                               echo 'shortage';
                                            } 
                                           ?>">ICU Bed </p>
                                        </div>
                                    </div>
                                    <p style='margin-bottom: -25px; margin-top: 2px;'>Blood</p> <br />
                                    <div class='row justify-content-start ms-1'>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_aplus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >A+</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_oplus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >O+</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_bplus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >B+</p>
                                        </div>
                                        <div class='col-4'>
                                        <p style='font-size: 11.5px;' class="<?php 
                                           
                                           if ($current->get_blood()->check_abplus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >
                                            AB+</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_aminus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >A-</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_ominus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >O-</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_bminus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >B-</p>
                                        </div>
                                        <div class='col-4'>
                                        <p class="<?php 
                                           
                                           if ($current->get_blood()->check_abminus()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >AB-</p>
                                        </div>
                                    </div>
    
                                    <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
                                    <div class='row justify-content-start ms-1'>
                                        <div class='col-6'>
                                        <p class="<?php 
                                           
                                           if ($current->get_ceylinder()->check_small()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Small</p>
                                        </div>
                                        <div class='col-6'>
                                        <p class="<?php 
                                           
                                           if ($current->get_ceylinder()->check_medium()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Medium</p>
                                           
                                        </div>
                                        <div class='col-6'>
                                        <p class="<?php 
                                           
                                           if ($current->get_ceylinder()->check_large()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Large </p>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class='col-6 '>
                                    <p style='margin-bottom: 0px;'>Vaccine</p> <br />
                                    <div class='row justify-content-start ms-1'>
                                    <p class="<?php 
                                           
                                           if ($current->get_vaccine()->check_oxford()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Oxford-Astrazeneca</p>
                                           <p class="<?php 
                                           
                                           if ($current->get_vaccine()->check_pfizer()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Pfizer-BioNTech</p>
                                           <p class="<?php 
                                           
                                           if ($current->get_vaccine()->check_moderna()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Moderna</p>
                                           <p class="<?php 
                                           
                                           if ($current->get_vaccine()->check_sinopharm()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Sinopharm</p>
                                           <p class="<?php 
                                           
                                           if ($current->get_vaccine()->check_sputnik()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>"
                                           >Sputnik V</p>
                                    </div>
                                </div>
                            </div>
                            <Button class='btn btn-success w-100 mt-4 me-2' onclick="request(this,1)" value="<?php echo $current->get_id()?>"  >Request</Button>
                           
                        </div>
                    </div>
                </div>

    <!--itemCategoryModal of hospital-->
    <div class="modal fade" id="itemCategoryModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel">Select item category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
           
                <select id="category1<?php echo $current->get_id()?>" class="form-select" name="category"  aria-label="Default select example">
               
                    <option
                    <?php
                        if($current->get_bed()->check_normal() || $current->get_bed()->check_icu() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="1"
                    >BED</option>
                    <option <?php
                        if($current->get_ceylinder()->check_small() || $current->get_ceylinder()->check_medium() || $current->get_ceylinder()->check_large() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="2"
                    >  Oxygen cylinder</option>
                    <option <?php
                        if($current->get_vaccine()->check_oxford() || $current->get_vaccine()->check_pfizer() || $current->get_vaccine()->check_moderna() || $current->get_vaccine()->check_sinopharm() || $current->get_vaccine()->check_sputnik() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="3"
                    >Vaccine</option>

                    <option <?php
                        if($current->get_blood()->check_aplus() || $current->get_blood()->check_aminus() || $current->get_blood()->check_bplus() || $current->get_blood()->check_bminus() || $current->get_blood()->check_oplus()|| $current->get_blood()->check_ominus() || $current->get_blood()->check_abplus() || $current->get_blood()->check_abminus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="4"
                    >Blood</option>
                  </select>
                  
            </div>
            <div class="modal-footer">
                
              <button class="btn btn-primary" onclick="next(this,'1')" value="<?php echo $current->get_id()?>"  data-bs-toggle="modal" data-bs-dismiss="modal" >Next</button>
            </div>
            
          </div>
        </div>
      </div>
           <!--bedModal of hospital-->   
      <div class="modal fade" id="bedModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types11<?php echo $current->get_id()?>" class="form-select" name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_bed()->check_normal() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="11"
                    >Normal Bed</option>
                    <option <?php
                        if($current->get_bed()->check_icu() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="12">ICU Bed</option>
                    
                  </select>
                </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input11<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="submit btn btn-primary" onclick="submit(this,'1','1')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

       <!--ceylinderModal of hospital-->   
       <div class="modal fade" id="ceylinderModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types12<?php echo $current->get_id()?>" class="form-select" name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_ceylinder()->check_small() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="21"
                    >Small Ceylinder</option>
                    <option <?php
                        if($current->get_ceylinder()->check_medium() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="22">Medium Ceylinder</option>
                    <option <?php
                        if($current->get_ceylinder()->check_large() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="23" >Large Ceylinder</option>
                    
                  </select>
                  </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input12<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="btn btn-primary" type="button" onclick="submit(this,'2','1')" value="<?php echo $current->get_id()?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

      <!--vaccineModal of hospital-->   
      <div class="modal fade" id="vaccineModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types13<?php echo $current->get_id()?>" class="form-select"  name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_vaccine()->check_oxford() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="31"
                    >Oxford Astrasenica</option>
                    <option <?php
                        if($current->get_vaccine()->check_pfizer() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="32"
                    >Phizer</option>
                    
                    <option <?php
                        if($current->get_vaccine()->check_moderna() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="33"
                    >Moderna</option>
                    <option <?php
                        if($current->get_vaccine()->check_sinopharm() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="34"
                    >Sinopharm</option>
                    <option <?php
                        if($current->get_vaccine()->check_sputnik() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="35"
                    >Sputnik</option> 
                  </select>

                  </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input13<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>

            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="btn btn-primary" type="button" onclick="submit(this,'3','1')" value="<?php echo $current->get_id()?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

      <!--bloodModal of hospital -->   
      <div class="modal fade" id="bloodModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types14<?php echo $current->get_id()?>" class="form-select" name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_blood()->check_aplus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="41"
                    >A+</option>
                    <option <?php
                        if($current->get_blood()->check_aminus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="42"
                    >A-</option>

                    <option <?php
                        if($current->get_blood()->check_bplus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="43"
                    >B+</option>
                    <option <?php
                        if($current->get_blood()->check_bminus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="44"
                    >B-</option>
                    <option <?php
                        if($current->get_blood()->check_oplus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="45"
                    >O+</option>
                    <option <?php
                        if($current->get_blood()->check_ominus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="46"
                    >O-</option>
                    <option <?php
                        if($current->get_blood()->check_abplus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="47"
                    >AB+</option>
                    <option <?php
                        if($current->get_blood()->check_abminus() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="48"
                    >AB-</option>
                    
                    
                  </select>

                  </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input14<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>

            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="btn btn-primary" type="button" onclick="submit(this,'4','1')" value="<?php echo $current->get_id()?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

              <?php }
            ?>

            <!-- Provider-->
            <?php
            $sql = "SELECT ProviderId,Name, TelephoneNo, Address FROM Provider";
            $rows = $connection->query($sql);
            foreach($rows as $row){
                $current=new Provider($row["ProviderId"],$row["Name"],$row['Address'],$row["TelephoneNo"],$connection);
                ?>
                  

                <div class='col-md-6 col-xl-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='mb-3' style='min-height: 150px; background-color: teal;'></div>
                        <div class='row justify-content-between mb-1'>
                            <h3 class='col-10 card-title'><?php
                               
                               echo $current->get_name();
                                   ?></h3>
                            <i class='fas fa-star col-1'></i>
                            <i class='far fa-star col-1'></i>
                        </div>
                        <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i
                                class='fas fa-map-marker-alt'></i>&nbsp;
                                <?php echo$current->get_address();?></p>
                        <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;<?php echo $current->get_phoneno();?></p>

                        <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
                        <div class='row justify-content-start ms-1'>
                            <div class='col-6'>
                                <p class="<?php 
                                           
                                            if ($current->get_bed()->check_normal()) 
                                            {echo 'available';}
                                            else{echo 'shortage';} 
                                            ?>">Normal Bed</p>
                            </div>
                            <div class='col-6'>
                                        <p class="<?php 
                                           
                                           if ($current->get_bed()->check_icu()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>">ICU Bed </p>
                            </div>
                        </div>
                        <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
                        <div class='row justify-content-start ms-1'>
                            <div class="col-3 <?php 
                                           
                                           if ($current->get_ceylinder()->check_small()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>">
                                <p>Small</p>
                            </div>
                            <div class="col-3 <?php 
                                           
                                           if ($current->get_ceylinder()->check_medium()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>">
                                <p>Medium</p>
                            </div>
                            <div class="col-3 <?php 
                                           
                                           if ($current->get_ceylinder()->check_large()) 
                                           {echo 'available';}
                                           else{echo 'shortage';} 
                                           ?>">
                                <p>Large</p>
                            </div>
                        </div>

                        <Button class='btn btn-success w-100 mt-4 me-2' onclick="request(this,2)" value="<?php echo $current->get_id()?>"  >Request</Button>


                    </div>
                </div>
            </div>

             <!--itemCategoryModal of provider-->
    <div class="modal fade" id="itemCategoryModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel">Select item category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
           
                <select id="category2<?php echo $current->get_id()?>" class="form-select" name="category"  aria-label="Default select example">
               
                    <option
                    <?php
                        if($current->get_bed()->check_normal() || $current->get_bed()->check_icu() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="1"
                    >BED</option>
                    <option <?php
                        if($current->get_ceylinder()->check_small() || $current->get_ceylinder()->check_medium() || $current->get_ceylinder()->check_large() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="2"
                    >  Oxygen cylinder</option>
                    
                  </select>
                  
            </div>
            <div class="modal-footer">
                
              <button class="btn btn-primary" onclick="next(this,2)" value="<?php echo $current->get_id()?>"  data-bs-toggle="modal" data-bs-dismiss="modal" >Next</button>
            </div>
            
          </div>
        </div>
      </div>
      
       <!--bedModal of provider-->   
       <div class="modal fade" id="bedModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types21<?php echo $current->get_id()?>" class="form-select" name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_bed()->check_normal() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="11"
                    >Normal Bed</option>
                    <option <?php
                        if($current->get_bed()->check_icu() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="12">ICU Bed</option>
                    
                  </select>
                  </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input21<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'2')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="submit btn btn-primary" onclick="submit(this,'1','2')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

       <!--ceylinderModal of provider-->   
       <div class="modal fade" id="ceylinderModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="types22<?php echo $current->get_id()?>" class="form-select" name="types" aria-label="Default select example">
    
                <option <?php
                        if($current->get_ceylinder()->check_small() ){
                            
                        }
                        else{echo "disabled";}
                    ?>
                    value="21"
                    >Small Ceylinder</option>
                    <option <?php
                        if($current->get_ceylinder()->check_medium() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="22">Medium Ceylinder</option>
                    <option <?php
                        if($current->get_ceylinder()->check_large() ){
                            
                        }
                        else{echo "disabled";}
                    ?> value="23" >Large Ceylinder</option>
                    
                  </select>
                  </br>
                  <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                        <input id= "input22<?php echo $current->get_id()?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
                  </div>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 d-md-block">
                <button class="submit btn btn-primary" onclick="prev(this,'2')" value="<?php echo $current->get_id()?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

                    <button class="btn btn-primary" type="button" onclick="submit(this,'2','2')" value="<?php echo $current->get_id()?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
                  </div>
            </div>
          </div>
        </div>
      </div>

            <?php  }
            ?>

            


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

                <a href="https://www.youtube.com/channel/UC6XsnLgVVzNkjTCpRVJ6u3w" target="_blank"
                    class="me-4 text-reset">

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


                            <a class="link-success" href="mailto: healthpromo@sltnet.lk"><i
                                    class="fas fa-envelope me-3"></i> healthpromo@sltnet.lk</a>

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

                            <a class="link-success" href="https://hpb.health.gov.lk/en" target="_blank"
                                class="text-reset">Ministry Home</a>
                        </p>
                        <p>
                            <a class="link-success" href="https://hpb.health.gov.lk/en/covid-19" target="_blank"
                                class="text-reset">Covid Info</a>
                        </p>

                        <p>
                            <a class="link-success" href="https://hpb.health.gov.lk/en/technical-units" target="_blank"
                                class="text-reset">Technical Units</a>

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

                            <li style="text-align: left;"><b>Suwasariya Hotline:</b>&nbsp;&nbsp;&nbsp;<a
                                    class="link-success" href="tel:1999">1999</a></li>
                            <li style="text-align: left;"><b>Epidemiology Unit:</b>&nbsp;&nbsp;&nbsp;<a
                                    class="link-success" href="tel:+940112695112">+94 011 269 5112</a></li>
                            <li style="text-align: left;"><b>Quarantine Unit:</b>&nbsp;&nbsp;&nbsp;<a
                                    class="link-success" href="tel:+940112112705">+94 011 211 2705</a></li>
                            <li style="text-align: left;"><b>Disaster Management Unit:</b>&nbsp;&nbsp;&nbsp;<a
                                    class="link-success" href="tel:+940113071073">+94 011 307 1073</a></li>



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


    <!--request toggle model-->
  
   
      
    
      
      




</body>





<script type="text/javascript">
    function myhref(web) {
        window.location.href = web;
    }
</script>

</html>