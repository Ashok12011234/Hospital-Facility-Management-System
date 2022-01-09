<?php
require("classes/probDomCls/Mail.php");
require("classes/probDomCls/NewAccount.php");
require("classes/sysLvlCls/Password.php");
require("./config.php");
include("classes/File.php");

class Signupper
{
    private String $OTP;
    private NewAccount $newAC;
    private String $usernameSuffix;

    public function __construct()
    {
        $this->newAC = new NewAccount();
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
        $result = QueryExecutor::query("SELECT * FROM `NewAccount` WHERE username = '$username' AND NOT status = 'REJECTED'");
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

        return QueryExecutor::query($query);
    }

    public function signup(array $signupData)
    {
        $error = "";
        $next = "";
        $result = array();
        $data = $signupData["post"];
        $files = $signupData["files"];

        if (array_key_exists("emailAddress", $data)) {
            $this->newAC->setEmailAddress($data["emailAddress"]);
            if(!$this->sendOTP()) {
                $error = "We couldn't send an OTP";
                $next = "one-sendOTP";
            }
        }
        else if (array_key_exists("OTP-3", $data)) {
            $enteredOTP = "";
            for ($i = 3; $i >= 0; $i--) { 
                $enteredOTP .= $data["OTP-$i"];
            }
            if(!$this->verifyEmail($enteredOTP)) {
                $error = "OTP didn't match";
                $next = "two-verify";
            }
            else {
            }
        }
        else if (array_key_exists("username", $data)) {
            if(!$this->isAvailableUsername($data["username"])) {
                $error = "Username already exists";
                $next = "three-username";
            }
            else {
                $this->newAC->setUsername($data["username"]);
            }
        }
        else if (array_key_exists("password", $data)) {
            $this->newAC->setPassword($data["password"]);
        }
        else if (array_key_exists("cPassword", $data)) {
            if(!$this->confirmPassword($data["cPassword"])) {
                $error = "Passwords didn't match";
                $next = "four-password";
            }
            else {
            }
        }
        else if (array_key_exists("acType", $data)) {
            $this->newAC->setAcType($data["acType"]);
            if($data["acType"] == "PROVIDER") {
                $next = "eight-evidence";
            }
            else {
            }
        }
        else if (array_key_exists("bankType", $data)) {
            $username = $this->newAC->getUsername();
            $result = File::upload($files["bankEvidence"], FileType::VIEW_PRINT, "assets/documents/DatabaseFiles/NewAccount/BankEvidence/$username");
            if (!empty($result["errorUploadFile"])) {
                $error = $result["errorUploadFile"];
                $next = "seven-bankAC";
            }
            else{
                $this->newAC->setBankName($data["bankType"]);
                $this->newAC->setBankAcNumber($data["acNo"]);
                $this->newAC->setBankEvidence($result["fileName"]);
            }
        }
        else if (array_key_exists("instituteEvidence", $files)) {
            $username = $this->newAC->getUsername();
            $result = File::upload($files["instituteEvidence"], FileType::VIEW_PRINT, "assets/documents/DatabaseFiles/NewAccount/InstituteEvidence/$username");
            if (!empty($result["errorUploadFile"])) {
                $error = $result["errorUploadFile"];
                $next = "eight-evidence";
            }
            else{
                $this->newAC->setInstituteEvidence($result["fileName"]);
                if(!$this->insertInToNewAc()) {
                }
                else {
                }
            }
            
        }

        $result["error"] = $error;
        $result["next"] = $next;
        return $result;
    }
}