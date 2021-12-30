<?php

class NewAccount {

    private  $id;
    private  $emailAddress;
    private  $username;
    private  $password;
    private  $acType;
    private  $bankName;
    private  $bankAcNumber;
    private  $bankEvidence;
    private  $instituteEvidence;
    public   $connection;



    public function __construct()
    {
        $servername = "localhost";
            $username = "root";
            $password = "";
            $database="hfms";
            $connection = new mysqli($servername, $username, $password, $database);
            // Check connection
            if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
                }

            $this->connection = $connection;
    }

    public function setID(String $id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }

    public function setEmailAddress(String $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress(): String
    {
        return $this->emailAddress;
    }

    public function setUsername(String $username)
    {
        $this->username = $username;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }

    public function getPassword(): String
    {
        return $this->password;
    }

    public function setAcType(String $acType)
    {
        $this->acType = $acType;
    }

    public function getAcType(): String
    {
        return $this->acType;
    }

    public function setBankName(String $bankName)
    {
        $this->bankName = $bankName;
    }

    public function getBankName(): String
    {
        return $this->bankName;
    }

    public function setBankAcNumber(String $bankAcNumber)
    {
        $this->bankAcNumber = $bankAcNumber;
    }

    public function getBankAcNumber(): String
    {
        return $this->bankAcNumber;
    }

    public function setBankEvidence($bankEvidence)
    {
        $this->bankEvidence = $bankEvidence;
    }

    public function getBankEvidence()
    {
        return $this->bankEvidence;
    }
    
    public function setInstituteEvidence($instituteEvidence)
    {
        $this->instituteEvidence = $instituteEvidence;
    }

    public function getInstituteEvidence()
    {
        return $this->instituteEvidence;
    }
    
    
}