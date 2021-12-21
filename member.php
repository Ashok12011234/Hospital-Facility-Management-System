<?php

include("config.php");

abstract class Member
{
  public $name;
  public $address;
  public $phoneNo;
  public $bedAval;
  public $ceylinderAval;
  public $id;
  public $profile;
  public $email;
  public $username;
  public $accountNo;
  public $bankName;
  public $website;
  public $password;

  public $connection;

  public abstract function request();

  public function get_password()
  {
    return $this->password;
  }
  public function get_name()
  {

    return $this->name;
  }
  public function set_name($name)
  {
    $sql = "UPDATE `hospital` SET `Name`= '$name' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->name = $name;
  }

  public function get_address()
  {
    return $this->address;
  }
  public function set_address($address)
  {
    $sql = "UPDATE `hospital` SET `Address` = '$address' WHERE `hospital`.`HospitalId` = $this->id";
    $this->connection->query($sql);
    $this->address = $address;
  }

  public function get_phoneno()
  {
    return $this->phoneNo;
  }
  public function set_phoneno($phoneNo)
  {
    $sql = "UPDATE `hospital` SET `TelephoneNo`= '$phoneNo' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->phoneNo = $phoneNo;
  }
  public function get_website()
  {
    return $this->website;
  }
  public function set_website($website)
  {
    $sql = "UPDATE `hospital` SET `Website`= '$website' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->website = $website;
  }
  public function get_id()
  {
    return $this->id;
  }
  public function set_connection($connection)
  {
    $this->connection = $connection;
  }
  public function get_profile()
  {
    return $this->profile;
  }
  public function set_profile($profile)
  {

    $sql = "UPDATE `hospital` SET `profile` =  '$profile' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->profile = $profile;
  }
  public function get_username()
  {
    return $this->username;
  }
  public function get_email()
  {

    return $this->email;
  }
  public function set_email($email)
  {
    $sql = "UPDATE `hospital` SET `Email`= '$email' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->email = $email;
  }
  public function get_bankName()
  {

    return $this->bankName;
  }
  public function set_bankName($bankName)
  {
    $sql = "UPDATE `hospital` SET `BankName`= '$bankName' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->bankName = $bankName;
  }
  public function get_accountNo()
  {
    return $this->accountNo;
  }
  public function set_accountNo($accountNo)
  {
    $sql = "UPDATE `hospital` SET `AccountNumber`= '$accountNo' WHERE `hospital`.`HospitalId` =  $this->id";
    $this->connection->query($sql);
    $this->accountNo = $accountNo;
  }

  
}

class Hospital extends Member
{

  public $bloodAval;
  public $vaccineAval;

  public function __construct($id, $name, $username, $address, $phoneNo, $profile, $email, $website, $accountNo, $bankName, $password, $connection)
  {
    $this->username = $username;
    $this->name = $name;
    $this->address = $address;
    $this->phoneNo = $phoneNo;
    $this->id = $id;
    $this->profile = $profile;
    $this->email = $email;
    $this->website = $website;
    $this->accountNo = $accountNo;
    $this->bankName = $bankName;
    $this->set_connection($connection);
    $this->password = $password;
  }

  public function request()
  {
  }

  public function get_bed()
  {
    if (is_null($this->bedAval)) {
      $sql = "SELECT  NormalAvailability, ICUAvailability FROM hospitalbeddetail WHERE HospitalId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);
      $this->bedAval = new Bed($row["NormalAvailability"], $row["ICUAvailability"]);
    }
    return $this->bedAval;
  }

  public function set_bed()
  {
    if (isset($_POST['bed'])) {
      $resources = array('NormalAvailability' => 'normalBed', 'ICUAvailability' => 'icuBed');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['bed'])) {
          $sql = "UPDATE `hospitalbeddetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        } else {
          $sql = "UPDATE `hospitalbeddetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        }
      }
    } else {
      $sql = "UPDATE `hospitalbeddetail` SET `NormalAvailability`='NO',`ICUAvailability`='NO'  WHERE HospitalId=$this->id;";
      $this->connection->query($sql);
    }
  }

  public function get_ceylinder()
  {
    if (is_null($this->ceylinderAval)) {
      $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM HospitalCylinderDetail WHERE HospitalId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);

      $this->ceylinderAval = new Ceylinder($row["SmallAvailability"], $row["MediumAvailability"], $row["LargeAvailability"]);
    }
    return $this->ceylinderAval;
  }

  public function set_ceylinder()
  {
    if (isset($_POST['cylinder'])) {
      $resources = array('SmallAvailability' => 'oxCylinderSmall', 'MediumAvailability' => 'oxCylinderMedium', 'LargeAvailability' => 'oxCylinderLarge');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['cylinder'])) {
          $sql = "UPDATE `hospitalcylinderdetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        } else {
          $sql = "UPDATE `hospitalcylinderdetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        }
      }
    } else {
      $sql = "UPDATE `hospitalcylinderdetail` SET `SmallAvailability`='NO',`MediumAvailability`='NO',`LargeAvailability`='NO'  WHERE HospitalId=$this->id;";
      $this->connection->query($sql);
    }
  }

  public function get_blood()
  {
    if (is_null($this->bloodAval)) {
      $sql = "SELECT  AplusAvailability,AminusAvailability, BplusAvailability ,BminusAvailability, OplusAvailability, OminusAvailability, ABplusAvailability ,ABminusAvailability  FROM BloodDetail WHERE HospitalId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);

      $this->bloodAval = new Blood($row["AplusAvailability"], $row["AminusAvailability"], $row["BplusAvailability"], $row["BminusAvailability"], $row["OplusAvailability"], $row["OminusAvailability"], $row["ABplusAvailability"], $row["ABminusAvailability"]);
    }
    return $this->bloodAval;
  }
  public function set_blood()
  {
    if (isset($_POST['blood'])) {
      $resources = array('AplusAvailability' => 'bloodAp', 'BplusAvailability' => 'bloodBp', 'OplusAvailability' => 'bloodOp', 'ABplusAvailability' => 'bloodABp', 'AminusAvailability' => 'bloodAn', 'BminusAvailability' => 'bloodBn', 'OminusAvailability' => 'bloodOn', 'ABminusAvailability' => 'bloodABn');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['blood'])) {
          $sql = "UPDATE `blooddetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        } else {
          $sql = "UPDATE `blooddetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        }
      }
    } else {
      $sql = "UPDATE `blooddetail` SET `AplusAvailability`='NO',`AminusAvailability`='NO',`BplusAvailability`='NO',`BminusAvailability`='NO',`OplusAvailability`='NO',`OminusAvailability`='NO',`ABplusAvailability`='NO',`ABminusAvailability`='NO'  WHERE HospitalId=$this->id;";
      $this->connection->query($sql);
    }
  }

  public function get_vaccine()
  {
    if (is_null($this->vaccineAval)) {
      $sql = "SELECT  OxfordAvailability,PfizerAvailability, ModernalAvailability ,SinopharmAvailability, SputnikAvailability  FROM VaccineDetail WHERE HospitalId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);
      $this->vaccineAval = new Vaccine($row["OxfordAvailability"], $row["PfizerAvailability"], $row["ModernalAvailability"], $row["SinopharmAvailability"], $row["SputnikAvailability"]);
    }
    return $this->vaccineAval;
  }
  public function set_vaccine()
  {
    if (isset($_POST['vaccine'])) {
      $resources = array('OxfordAvailability' => 'oxfordAsterzeneca', 'PfizerAvailability' => 'pfizer', 'ModernalAvailability' => 'moderna', 'SinopharmAvailability' => 'sinopharm', 'SputnikAvailability' => 'sputnik');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['vaccine'])) {
          $sql = "UPDATE `VaccineDetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        } else {
          $sql = "UPDATE `VaccineDetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          $this->connection->query($sql);
        }
      }
    } else {
      $sql = "UPDATE `VaccineDetail` SET `OxfordAvailability`='NO',`PfizerAvailability`='NO',`ModernalAvailability`='NO',`SinopharmAvailability`='NO',`SputnikAvailability`='NO'  WHERE HospitalId=$this->id;";
      $this->connection->query($sql);
    }
  }

  public function filter($para){

    switch($para){
    
      case '1':
        $out=true;
        break;
      case '11':
        $this->get_bed();
        $out= $this->bedAval->providable();
        break;
      case '12':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->providable();
        break;
      case '13':
        $this->get_blood();
        $out= $this->bloodAval->providable();
        break;
      case '14':
        $this->get_vaccine();
        $out= $this->vaccineAval->providable();
        break;
     
      case '111':
        $this->get_bed();
        $out= $this->bedAval->check_normal();
        break;
      case '112':
        $this->get_bed();
        $out= $this->bedAval->check_icu();
        break;
      case '121':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_small();
        break;
      case '122':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_large();
        break;
      case '123':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_medium();
        break;
      case '131':
        $this->get_blood();
        $out= $this->bloodAval->check_aplus();
        break;
      case '132':
        $this->get_blood();
        $out= $this->bloodAval->check_aminus();
        break;
      case '133':
        $this->get_blood();
        $out= $this->bloodAval->check_bplus();
        break;
      case '134':
        $this->get_blood();
        $out= $this->bloodAval->check_bminus();
        break;
      case '135':
        $this->get_blood();
        $out= $this->bloodAval->check_oplus();
        break;
      case '136':
        $this->get_blood();
        $out= $this->bloodAval->check_ominus();
        break;
      case '137':
        $this->get_blood();
        $out= $this->bloodAval->check_abplus();
        break;
      case '138':
        $this->get_blood();
        $out= $this->bloodAval->check_abminus();
        break;
      case '141':
        $this->get_vaccine();
        $out= $this->vaccineAval->check_oxford();
        break;
      case '142':
        $this->get_vaccine();
        $out= $this->vaccineAval->check_pfizer();
        break;
      case '143':
        $this->get_vaccine();
        $out= $this->vaccineAval->check_moderna();
        break;
      case '144':
        $this->get_vaccine();
        $out= $this->vaccineAval->check_sinopharm();
        break;
      case '145':
        $this->get_vaccine();
        $out= $this->vaccineAval->check_sputnik();
        break;

    
      default:
        $out=false;
    
    
    
      }

      return $out;
  }


}

class Provider extends Member
{

  public function __construct($id, $name, $address, $phoneNo, $connection)
  {
    $this->name = $name;
    $this->address = $address;
    $this->phoneNo = $phoneNo;
    $this->id = $id;
    $this->set_connection($connection);
  }

  public function request()
  {
  }
  public function get_bed()
  {
    if (is_null($this->bedAval)) {
      $sql = "SELECT  NormalAvailability, ICUAvailability FROM ProviderBedDetail WHERE ProviderId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);
      $this->bedAval = new Bed($row["NormalAvailability"], $row["ICUAvailability"]);
    }
    return $this->bedAval;
  }

  public function get_ceylinder()
  {
    if (is_null($this->ceylinderAval)) {
      $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM ProviderCylinderDetail WHERE ProviderId=$this->id";
      $result = $this->connection->query($sql);
      $row = mysqli_fetch_assoc($result);
      $this->ceylinderAval = new Ceylinder($row["SmallAvailability"], $row["MediumAvailability"], $row["LargeAvailability"]);
    }
    return $this->ceylinderAval;
  }

  public function filter($para){

    switch($para){
    
      case '2':
        $out=true;
        break;
      case '21':
        $this->get_bed();
        $out= $this->bedAval->providable();
        break;
      case '22':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->providable();
        break;
      case '21':
        $this->get_bed();
        $out= $this->bedAval->providable();
        break;
      case '22':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->providable();
        break;
      case '211':
        $this->get_bed();
        $out= $this->bedAval->check_normal();
        break;
      case '212':
        $this->get_bed();
        $out= $this->bedAval->check_icu();
        break;
      case '221':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_small();
        break;
      case '222':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_medium();
        break;
      case '223':
        $this->get_ceylinder();
        $out= $this->ceylinderAval->check_large();
        break;

      default:
        $out=false;
    
    
    
      }

      return $out;
  }


}

abstract class Equipment
{
}

class Bed extends Equipment
{
  public $normal;
  public $icu;

  public function __construct($normal, $icu)
  {
    $this->normal = $normal;
    $this->icu = $icu;
  }


  public function check_normal()
  {
    if ($this->normal == "YES") {
      return true;
    }
    return false;
  }
  public function check_icu()
  {
    if ($this->icu == "YES") {
      return true;
    }
    return false;
  }

  public function providable(){
    return $this->check_normal() || $this->check_icu();
  }

}

class Vaccine extends Equipment
{
  public $oxford;

  public $pfizer;

  public $moderna;

  public $sinopharm;

  public $sputnik;

  public function __construct($oxford, $pfizer, $moderna, $sinopharm, $sputnik)
  {
    $this->oxford = $oxford;
    $this->pfizer = $pfizer;
    $this->moderna = $moderna;
    $this->sinopharm = $sinopharm;
    $this->sputnik = $sputnik;
  }
  public function check_oxford()
  {
    if ($this->oxford == "YES") {
      return true;
    }
    return false;
  }
  public function check_pfizer()
  {
    if ($this->pfizer == "YES") {
      return true;
    }
    return false;
  }
  public function check_moderna()
  {
    if ($this->moderna == "YES") {
      return true;
    }
    return false;
  }

  public function check_sinopharm()
  {
    if ($this->sinopharm == "YES") {
      return true;
    }
    return false;
  }
  public function check_sputnik()
  {
    if ($this->sputnik == "YES") {
      return true;
    }
    return false;
  }

  public function providable(){
    return $this->check_sputnik() || $this->check_sinopharm() || $this->check_sputnik() || $this->check_moderna() || $this->check_pfizer() || $this->check_oxford();
  }


}


class Blood extends Equipment
{
  public $aplus;
  public $aminus;
  public $bplus;
  public $bminus;
  public $oplus;
  public $ominus;
  public $abplus;
  public $abminus;

  public function __construct($aplus, $aminus, $bplus, $bminus, $oplus, $ominus, $abplus, $abminus)
  {
    $this->aplus = $aplus;
    $this->aminus = $aminus;
    $this->bplus = $bplus;
    $this->bminus = $bminus;
    $this->oplus = $oplus;
    $this->ominus = $ominus;
    $this->abplus = $abplus;
    $this->abminus = $abminus;
  }

  public function check_aplus()
  {
    if ($this->aplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_aminus()
  {
    if ($this->aminus == "YES") {
      return true;
    }
    return false;
  }

  public function check_bplus()
  {
    if ($this->bplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_bminus()
  {
    if ($this->bminus == "YES") {
      return true;
    }
    return false;
  }
  public function check_oplus()
  {
    if ($this->oplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_ominus()
  {
    if ($this->ominus == "YES") {
      return true;
    }
    return false;
  }
  public function check_abplus()
  {
    if ($this->abplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_abminus()
  {
    if ($this->abminus == "YES") {
      return true;
    }
    return false;
  }

  public function providable(){
    return $this->check_aplus() || $this->check_aminus() ||$this->check_bplus() || $this->check_bminus() ||$this->check_oplus() || $this->check_ominus() ||$this->check_abplus() || $this->check_abminus()  ;
  }


}

class Ceylinder extends Equipment
{
  public $small;
  public $medium;
  public $large;

  public function __construct($small, $medium, $large)
  {
    $this->small = $small;
    $this->medium = $medium;
    $this->large = $large;
  }
  public function check_small()
  {
    if ($this->small == "YES") {
      return true;
    }
    return false;
  }
  public function check_medium()
  {
    if ($this->medium == "YES") {
      return true;
    }
    return false;
  }
  public function check_large()
  {
    if ($this->large == "YES") {
      return true;
    }
    return false;
  }

  public function providable(){
    return $this->check_small() || $this->check_medium() || $this->check_large();
  }
}
