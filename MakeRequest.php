<?php



include("member.php");
//session_start();


$id = $_POST['id'];
$equipment = $_POST['equipment'];
$userType= $_POST['userType'];
$quantity=$_POST['quantity'];

if($userType=='1'){
    $sql = "INSERT INTO HHrequest
(RequestId,
ProviderId,
HospitalId,
Status,
Equipment,
Quantity)
VALUES
('0',
'$id',
'2',
'Pending',
'$equipment',
'$quantity');
";
}
else{
    $sql = "INSERT INTO HPrequest
    (RequestId,
    ProviderId,
    HospitalId,
    Status,
    Equipment,
    Quantity)
    VALUES
    ('0',
    '$id',
    '2',
    'Pending',
    '$equipment',
    '$quantity');
    "; 
}



if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }









?>

