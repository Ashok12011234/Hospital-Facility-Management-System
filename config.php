<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$database="hfms";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$createDB = "CREATE DATABASE IF NOT EXISTS $database";
$conn->query($createDB);


$conn->close();

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

// sql to create table
$createTb = "CREATE TABLE BloodDetail (
  BloodRecordId int(10) NOT NULL, 
  HospitalId int(10) NOT NULL, 
  AplusAvailability char(3), 
  AminusAvailability char(3), 
  BplusAvailability char(3), 
  BminusAvailability char(3), 
  OplusAvailability char(3), 
  OminusAvailability char(3), 
  ABplusAvailability char(3), 
  ABminusAvailability char(3), 
  PRIMARY KEY (BloodRecordId, HospitalId));

CREATE TABLE Executive (
  ExecutiveId int(11) NOT NULL AUTO_INCREMENT, 
  UserName varchar(50) NOT NULL UNIQUE, 
  Password varchar(10) NOT NULL, 
  PRIMARY KEY (ExecutiveId));

CREATE TABLE Hospital (
  HospitalId int(10) NOT NULL AUTO_INCREMENT, 
  UserName varchar(50) NOT NULL UNIQUE, 
  Email varchar(20), 
  Password varchar(10) NOT NULL, 
  Name varchar(255), 
  TelephoneNo varchar(25), 
  Address varchar(255), 
  Profile varchar(256) NOT NULL DEFAULT 'assets\\pictures\\profile\\defaultDp.png' ,
  Website varchar(100),
  BankName varchar(20) NOT NULL, 
  AccountNumber varchar(20) NOT NULL, 
  PRIMARY KEY (HospitalId));

CREATE TABLE HospitalBedDetail (
  HospitalBedRecordId int(10) NOT NULL, 
  HospitalId int(10) NOT NULL, 

  NormalAvailability char(3), 

  ICUAvailability char(3), 
  PRIMARY KEY (HospitalBedRecordId, HospitalId));

CREATE TABLE HospitalCylinderDetail (
  HospitalCylinderRecordId int(10) NOT NULL, 
  HospitalId int(10) NOT NULL, 
  SmallAvailability char(3), 
  MediumAvailability char(3), 
  LargeAvailability char(3), 

 PRIMARY KEY (HospitalCylinderRecordId, HospitalId));



CREATE TABLE NewAccount (
  NewAccountID int(10) NOT NULL AUTO_INCREMENT, 
  UserName varchar(16) NOT NULL UNIQUE,
  Password varchar(12) NOT NULL, 
  Email varchar(50) NOT NULL, 
  AccountType enum('HOSPITAL','PROVIDER') NOT NULL, 
  BankName enum('BOC','PEOPLE','HNB','COMMERCIAL','NSB'), 
  AccountNumber varchar(20), 
  BankEvidence varchar(255),
  InstituteEvidence varchar(255) NOT NULL, 
  Status enum('NEW','PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'NEW', 
  PRIMARY KEY (NewAccountID));

CREATE TABLE Provider (
  ProviderId int(10) NOT NULL AUTO_INCREMENT, 
  UserName varchar(50) NOT NULL UNIQUE, 
  Email varchar(20), 
  Password varchar(10) NOT NULL, 
  Name varchar(255), 
  TelephoneNo varchar(25), 
  Address varchar(255), 
  Profile varchar(256) NOT NULL DEFAULT 'assets\\pictures\\profile\\defaultDp.png',
  Website varchar(100),
  BankName varchar(20) NOT NULL, 
  AccountNumber varchar(20) NOT NULL, 
  PRIMARY KEY (ProviderId));

CREATE TABLE ProviderBedDetail (
  ProviderBedRecordId int(10) NOT NULL, 
  ProviderId int(10) NOT NULL, 

  NormalAvailability char(3), 
  ICUAvailability char(3) , 

  PRIMARY KEY (ProviderBedRecordId, ProviderId));

CREATE TABLE ProviderCylinderDetail (
  ProviderCylinderRecordId int(10) NOT NULL, 
  ProviderId int(10) NOT NULL, 
  SmallAvailability char(3), 
  MediumAvailability char(3), 
  LargeAvailability char(3), 
  PRIMARY KEY (ProviderCylinderRecordId, ProviderId));

  CREATE TABLE HHrequest (
  RequestId int NOT NULL AUTO_INCREMENT,
  ProviderId int NOT NULL,
  HospitalId int NOT NULL,
  Status varchar(10) NOT NULL,
  Equipment varchar(20) NOT NULL,
  Quantity varchar(20) NOT NULL,
  PRIMARY KEY (RequestId)
) ;

CREATE TABLE HPrequest (
  RequestId int NOT NULL AUTO_INCREMENT,
  ProviderId int NOT NULL,
  HospitalId int NOT NULL,
  Status varchar(10) NOT NULL,
  Equipment varchar(20) NOT NULL,
  Quantity varchar(20) NOT NULL,
  PRIMARY KEY (RequestId)
) ;

CREATE TABLE VaccineDetail (
  VaccineRecordId int(10) NOT NULL, 
  HospitalId int(10) NOT NULL, 
  OxfordAvailability char(3), 
  PfizerAvailability char(3), 
  ModernalAvailability char(3), 
  SinopharmAvailability char(3), 
  SputnikAvailability char(3), 
  PRIMARY KEY (VaccineRecordId, HospitalId));

";

    
if($connection->multi_query($createTb)) {
  echo "DONE";
}
   
?>

