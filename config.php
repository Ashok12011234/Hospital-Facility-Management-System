<?php
include('connection.php');

// Create database
$conn = new mysqli("localhost","root","");
$createDB = "CREATE DATABASE IF NOT EXISTS `".Database::NAME."`";
$conn->query($createDB);
$conn->close();

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
  Password varchar(255) NOT NULL, 
  PRIMARY KEY (ExecutiveId));

CREATE TABLE Hospital (
  HospitalId int(10) NOT NULL AUTO_INCREMENT, 
  UserName varchar(50) NOT NULL UNIQUE, 
  Email varchar(100), 
  Password varchar(100) NOT NULL, 
  Name varchar(255), 
  TelephoneNo varchar(25), 
  Address varchar(255), 
  Profile varchar(256) NOT NULL DEFAULT 'assets\\pictures\\profile\\defaultDp.png' ,
  Website varchar(100),
  BankName varchar(20) NOT NULL, 
  AccountNumber varchar(20) NOT NULL,
  staredHospital varchar(512) NOT NULL DEFAULT 'a:0:{}',
  staredProvider varchar(512) NOT NULL DEFAULT 'a:0:{}',
  State enum('NEW', 'INITIATED') NOT NULL DEFAULT 'NEW',
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
  Password varchar(100) NOT NULL, 

  Email varchar(100) NOT NULL, 
  AccountType enum('HOSPITAL','PROVIDER') NOT NULL, 
  BankName enum('BOC','PEOPLE','HNB','COMMERCIAL','NSB'), 
  AccountNumber varchar(20), 
  BankEvidence varchar(255),
  InstituteEvidence varchar(255) NOT NULL, 
  Status enum('NEW', 'PENDING', 'APPROVED', 'REJECTED') NOT NULL DEFAULT 'NEW', 
  Doc_Status enum('Correct','False','Not Vertified') NOT NULL DEFAULT 'Not Vertified',
  Bank_Status enum('Correct','False','Not Vertified') NOT NULL DEFAULT 'Not Vertified',
  PRIMARY KEY (NewAccountID));

CREATE TABLE Provider (
  ProviderId int(10) NOT NULL AUTO_INCREMENT, 
  UserName varchar(50) NOT NULL UNIQUE, 
  Email varchar(100), 
  Password varchar(100) NOT NULL, 
  Name varchar(255), 
  TelephoneNo varchar(25), 
  Address varchar(255), 
  Profile varchar(256) NOT NULL DEFAULT 'assets\\pictures\\profile\\defaultDp.png',
  Website varchar(100),
  BankName varchar(20) NOT NULL, 
  AccountNumber varchar(20) NOT NULL,
  staredHospital varchar(512) NOT NULL DEFAULT 'a:0:{}',
  staredProvider varchar(512) NOT NULL DEFAULT 'a:0:{}',
  State enum('NEW', 'INITIATED') NOT NULL DEFAULT 'NEW',
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
  State enum('REQUESTED', 'ACCEPTED', 'DECLINED', 'TRANSPORTING', 'EXCHANGE_COMPLETED', 'CANCELLED') NOT NULL DEFAULT 'REQUESTED',
  Equipment varchar(20) NOT NULL,
  Quantity varchar(20) NOT NULL,
  PRIMARY KEY (RequestId)
) ;

CREATE TABLE HPrequest (
  RequestId int NOT NULL AUTO_INCREMENT,
  ProviderId int NOT NULL,
  HospitalId int NOT NULL,
  State enum('REQUESTED', 'ACCEPTED', 'DECLINED', 'TRANSPORTING', 'EXCHANGE_COMPLETED', 'CANCELLED') NOT NULL DEFAULT 'REQUESTED',
  Equipment varchar(20) NOT NULL,
  Quantity varchar(20) NOT NULL,
  PRIMARY KEY (RequestId)
) ;

CREATE TABLE Message (
  MessageId int NOT NULL AUTO_INCREMENT,
  RequestType enum('HH', 'HP') NOT NULL,
  RequestId int NOT NULL,
  SenderId int NOT NULL,
  ReceiverId int NOT NULL,
  Message varchar(255) NOT NULL,
  Time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (MessageId)
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

  CREATE TABLE Donation (
  DonationId int(10) NOT NULL AUTO_INCREMENT, 
  HospitalId int(10) NOT NULL, 
  Email varchar(100) NOT NULL, 
  Name varchar(255) NOT NULL,
  Amount varchar(10) NOT NULL,
  PRIMARY KEY (DonationId));

";


