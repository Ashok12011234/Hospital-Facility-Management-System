<?php
include("config.php");

abstract class Member{
    public $name;
    public $address;
    public $phoneNo;
    public $bedAval;
    public $ceylinderAval;
    public $id;
    public $connection;

    public abstract function request();

    public function get_name() {
       
        return $this->name;
    }
    public function set_name($name) {
       
        $this->name=$name;
    }

    public function get_address() {
        return $this->address;
    }
    public function set_address($address) {
        $this->address=$address;
    }

    public function get_phoneno() {
        return $this->phoneNo;
    }
    public function set_phoneno($phoneNo) {
        $this->phoneNo=$phoneNo;
    }
    public function get_id() {
        return $this->id;
    }
    public function set_id($id) {
        $this->id=$id;
    }
    public function set_connection($connection) {
        $this->connection=$connection;
    }

    

}

class Hospital extends Member{
    
    public $bloodAval;
    public $vaccineAval;

    public function __construct($id,$name,$address,$phoneNo,$connection) {
        $this->set_name($name);
        $this->set_address($address);
        $this->set_phoneno($phoneNo);
        $this->set_id($id);
        $this->set_connection($connection);
      }
      
      public function request(){

      }
    
    public function get_bed() {
        if(is_null($this->bedAval)){
            $sql = "SELECT  NormalAvailability, ICUAvailability FROM HospitalBedDetail WHERE HospitalId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);
            $this->bedAval= new Bed($row["NormalAvailability"],$row["ICUAvailability"]);
        }
        return $this->bedAval;
    }

    public function get_ceylinder() {
        if(is_null($this->ceylinderAval)){
            $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM HospitalCylinderDetail WHERE HospitalId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);

            $this->ceylinderAval= new Ceylinder($row["SmallAvailability"],$row["MediumAvailability"],$row["LargeAvailability"]);
        }
        return $this->ceylinderAval;
    }

    public function get_blood() {
        if(is_null($this->bloodAval)){
            $sql = "SELECT  AplusAvailability,AminusAvailability, BplusAvailability ,BminusAvailability, OplusAvailability, OminusAvailability, ABplusAvailability ,ABminusAvailability  FROM BloodDetail WHERE HospitalId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);

            $this->bloodAval= new Blood($row["AplusAvailability"],$row["AminusAvailability"],$row["BplusAvailability"],$row["BminusAvailability"],$row["OplusAvailability"],$row["OminusAvailability"],$row["ABplusAvailability"],$row["ABminusAvailability"]);
        }
        return $this->bloodAval;
      }

    public function get_vaccine() {
        if(is_null($this->vaccineAval)){
            $sql = "SELECT  OxfordAvailability,PfizerAvailability, ModernalAvailability ,SinopharmAvailability, SputnikAvailability  FROM VaccineDetail WHERE HospitalId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);
            $this->vaccineAval= new Vaccine($row["OxfordAvailability"],$row["PfizerAvailability"],$row["ModernalAvailability"],$row["SinopharmAvailability"],$row["SputnikAvailability"]);
        }
        return $this->vaccineAval;
    }
}

class Provider extends Member{

    public function __construct($id,$name,$address,$phoneNo,$connection) {
        $this->name = $name;
        $this->address=$address;
        $this->phoneNo=$phoneNo;
        $this->id=$id;
        $this->set_connection($connection);
      }
    
      public function request(){

      }
      public function get_bed() {
        if(is_null($this->bedAval)){
            $sql = "SELECT  NormalAvailability, ICUAvailability FROM ProviderBedDetail WHERE ProviderId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);
            $this->bedAval= new Bed($row["NormalAvailability"],$row["ICUAvailability"]);
        }
        return $this->bedAval;
    }

    public function get_ceylinder() {
        if(is_null($this->ceylinderAval)){
            $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM ProviderCylinderDetail WHERE ProviderId=$this->id";
            $result = $this->connection->query($sql);
            $row = mysqli_fetch_assoc($result);
            $this->ceylinderAval= new Ceylinder($row["SmallAvailability"],$row["MediumAvailability"],$row["LargeAvailability"]);
        }
        return $this->ceylinderAval;
    }

}

abstract class Equipment {
        
} 

class Bed extends Equipment{
        public $normal;
        public $icu;

        public function __construct($normal,$icu) {
            $this->normal = $normal;
            $this->icu=$icu;
           
          }


        public function check_normal(){
            if($this->normal=="YES"){
                return true;
            }
            return false;
        }
        public function check_icu(){
            if($this->icu=="YES"){
                return true;
            }
            return false;
        }

        
       

}

class Vaccine extends Equipment{
    public $oxford;

    public $pfizer;

    public $moderna;

    public $sinopharm;

    public $sputnik;

    public function __construct($oxford,$pfizer,$moderna,$sinopharm,$sputnik) {
        $this->oxford =$oxford;
        $this->pfizer=$pfizer;
        $this->moderna=$moderna;
        $this->sinopharm=$sinopharm;
        $this->sputnik=$sputnik;
      }
        public function check_oxford(){
            if($this->oxford=="YES"){
                return true;
            }
            return false;
        }
        public function check_pfizer(){
            if($this->pfizer=="YES"){
                return true;
            }
            return false;
        }
        public function check_moderna(){
            if($this->moderna=="YES"){
                return true;
            }
            return false;
        }

        public function check_sinopharm(){
            if($this->sinopharm=="YES"){
                return true;
            }
            return false;
        }
        public function check_sputnik(){
            if($this->sputnik=="YES"){
                return true;
            }
            return false;
        }
}


class Blood extends Equipment{
    public $aplus;
    public $aminus;
    public $bplus;
    public $bminus;
    public $oplus;
    public $ominus;
    public $abplus;
    public $abminus;

    public function __construct($aplus,$aminus,$bplus,$bminus,$oplus,$ominus,$abplus,$abminus) {
        $this->aplus =$aplus;
        $this->aminus=$aminus;
        $this->bplus=$bplus;
        $this->bminus=$bminus;
        $this->oplus=$oplus;
        $this->ominus=$ominus;
        $this->abplus=$abplus;
        $this->abminus=$abminus;
      }

    public function check_aplus(){
        if($this->aplus=="YES"){
            return true;
        }
        return false;
    }
    public function check_aminus(){
        if($this->aminus=="YES"){
            return true;
        }
        return false;
    }

    public function check_bplus(){
        if($this->bplus=="YES"){
            return true;
        }
        return false;
    }
    public function check_bminus(){
        if($this->bminus=="YES"){
            return true;
        }
        return false;
    }
    public function check_oplus(){
        if($this->oplus=="YES"){
            return true;
        }
        return false;
    }
    public function check_ominus(){
        if($this->ominus=="YES"){
            return true;
        }
        return false;
    }
    public function check_abplus(){
        if($this->abplus=="YES"){
            return true;
        }
        return false;
    }
    public function check_abminus(){
        if($this->abminus=="YES"){
            return true;
        }
        return false;
    }

}

class Ceylinder extends Equipment{
    public $small;
    public $medium;
    public $large;

    public function __construct($small,$medium,$large) {
        $this->small=$small;
        $this->medium=$medium;
        $this->large=$large;
      }
    public function check_small(){
        if($this->small=="YES"){
            return true;
        }
        return false;
    }
    public function check_medium(){
        if($this->medium=="YES"){
            return true;
        }
        return false;
    }
    public function check_large(){
        if($this->large=="YES"){
            return true;
        }
        return false;
    }


}





?>