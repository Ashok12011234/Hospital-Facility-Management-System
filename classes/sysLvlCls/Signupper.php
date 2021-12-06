<?php
require("classes/probDomCls/Mail.php");
require("classes/probDomCls/NewAccount.php");
require("classes/sysLvlCls/Password.php");
require("config.php");

class Signupper
{
    private String $OTP;
    private NewAccount $newAC;
    private String $usernameSuffix;
    private mysqli $connection;

    public function __construct()
    {
        $this->newAC = new NewAccount();
        //$result = $this->connection->query("SELECT MAX(`NewAccountID`) FROM `NewAccount`");
        //$row = $result -> fetch_assoc();
        //$id = $row["NewAccountID"] + 1;
        $this->usernameSuffix = "@001";
    }

    public function setConnection(mysqli $connection): void
    {
        $this->connection = $connection;
    }

    public function getNewAccount(): NewAccount
    {
        return $this->newAC;
    }

    public function getUsernameSuffix(): String
    {
        return $this->usernameSuffix;
    }

    private function generateOTP(): String
    {
        $this->OTP = (String)rand(1000,9999);
        return $this->OTP;
    }


    public function sendOTP(): bool
    {
        $emailAddress = $this->newAC->getEmailAddress();
        if (Mail::isValidEmailAddress($emailAddress)) {
            $otpMail = new Mail($emailAddress, "OTP from Life Share", $this->generateOTP());
            if ($otpMail->send()) {
                return true;
            }
            else {
                return $otpMail->send();
            }
        }
        else {
            return false;
        }
    }

    public function verifyEmail(String $enteredOTP): bool
    {
        return $this->OTP == $enteredOTP;
    }

    public function isAvailableUsername(String $username): bool
    {
        $result = $this->connection -> query("SELECT * FROM `NewAccount` WHERE username = '$username'");
        return $result->num_rows == 0;
    }

    public function confirmPassword(String $cPassword): bool
    {
        return $this->newAC->getPassword() == $cPassword;
    }

    public function insertInToNewAc(): bool
    {
        if ($this->newAC->getAcType() == "PROVIDER") {
            $query = "INSERT INTO `NewAccount` (`UserName`,`Email`,`AccountType`,
                `InstituteEvidence`,`Password`) VALUES ('".
            $this->newAC->getUsername()."','".
            $this->newAC->getEmailAddress()."','".
            $this->newAC->getAcType()."','".
            $this->newAC->getInstituteEvidence()."','".
            Password::encrypt($this->newAC->getPassword())."'".
            ")";
        }
        else {
            $query = "INSERT INTO `NewAccount` (`UserName`,`Email`,`AccountType`,`BankName`,
                `AccountNumber`,`BankEvidence`,`InstituteEvidence`,`Password`) VALUES ('".
            $this->newAC->getUsername()."','".
            $this->newAC->getEmailAddress()."','".
            $this->newAC->getAcType()."','".
            $this->newAC->getBankName()."','".
            $this->newAC->getBankAcNumber()."','".
            $this->newAC->getBankEvidence()."','".
            $this->newAC->getInstituteEvidence()."','".
            Password::encrypt($this->newAC->getPassword())."'".
            ")";
        }

        return $this->connection->query($query);
    }
}