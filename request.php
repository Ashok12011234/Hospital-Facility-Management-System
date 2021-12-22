<?php

include("member.php");

abstract class Request{
    public $id;
    public $from;
    public $to;
    public $state;
    public $equipment;
    public $quantity;
    public $connection;

  public function getId () {return $this->id;}
  public function getFrom () {return $this->from;}

  public function getTo () {return $this->to;}

  public function getEquipment () {return $this->equipment;}

  public function getQuantity () {return $this->quantity;}

  

 
    


    public function __construct($id,$connection){
        $this->id=$id;
        $this->connection=$connection;
        $this->state=new NewRequest(); 
    }
    
    public function setState($state){
        $this->state=$state; 

    }

    public abstract function assignAll();
    
    public function send(){
        $this->state->send($this);
    }
    public function cancel(){
        $this->state->cancel($this);
    }
    public function decline(){
        $this->state->decline($this);
    }
    public function acceptRequest(){
        $this->state->acceptRequest($this);
    }
    public function acceptEquipment(){
        $this->state->acceptEquipment($this);
    }
    public function transport(){
        $this->state->transport($this);
    }

}

class HHRequest extends Request{

    public function __construct($id,$connection){
       // super($id,$connection);
        parent::__construct($id,$connection);
    }

    public function assignAll(){
        $sql1 = "SELECT * FROM HHrequest WHERE RequestId=$this->id";

        if($this->connection->query($sql1)){
            $result = $this->connection->query($sql1);
            $row = $result->fetch_assoc();
            $hospitalID=$row["HospitalId"];
            $providerID=$row["ProviderId"];
            $this->equipment=$row["Equipment"];
            $this->quantity=$row["Quantity"];
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($this->connection->query($sql2)){
            $result = $this->connection->query($sql2);
            $row = $result->fetch_assoc();
            $this->from = new Hospital($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['Profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $this->connection);

        }

        $sql3 = "SELECT * FROM Hospital WHERE HospitalId=$providerID";

        if($this->connection->query($sql3)){
            $result = $this->connection->query($sql3);
            $row = $result->fetch_assoc();
            $this->to = new Hospital($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['Profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $this->connection);

        }


    }



}

class HPRequest extends Request{

    public function __construct($id,$connection){
        //super($id,$connection);
        parent::__construct($id,$connection);
    }

    public function assignAll(){
        $sql1 = "SELECT * FROM HPrequest WHERE RequestId=$id";

        if($this->connection->query($sql1)){
            $result = $this->connection->query($sql1);
            $row = $result->fetch_assoc();
            $hospitalID=$row["HospitalId"];
            $providerID=$row["ProviderId"];
            $this->equipment=$row["Equipment"];
            $this->quantity=$row["Quantity"];
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($this->connection->query($sql2)){
            $result = $this->connection->query($sql2);
            $row = $result->fetch_assoc();
            $this->from = new Hospital($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['Profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $this->connection);

        }

        $sql3 = "SELECT * FROM Provider WHERE ProviderId=$providerID";

        if($this->connection->query($sql3)){
            $result = $this->connection->query($sql3);
            $row = $result->fetch_assoc();
            $this->to = new Provider($row["HospitalId"], $row["Name"], $row['UserName'], $row['Address'], $row["TelephoneNo"], $row['Profile'], $row['Email'], $row["Website"], $row['AccountNumber'], $row['BankName'], $row['Password'],  $this->connection);

        }
    }
}

abstract class State{
    public abstract function send($request);
    public abstract function cancel($request);
    public abstract function decline($request);
    public abstract function acceptRequest($request);
    public abstract function acceptEquipment($request);
    public abstract function transport($request);

}

class NewRequest extends State{
    public function send($request){
        $request.setState(new PendingRequest() );
    }
    public function cancel($request){
        $request.setState(new CancelledRequest() );
    }
    public function decline($request){
    }
    public function acceptRequest($request){
    }
    public function acceptEquipment($request){
    }
    public function transport($request){
    }
}

class PendingRequest extends State{
    public function send($request){
    }
    public function cancel($request){
        $request.setState(new CancelledRequest() );
    }
    public function decline($request){
        $request.setState(new DeclinedRequest() );

    }
    public function acceptRequest($request){
        $request.setState(new AcceptedRequest() );

    }
    public function acceptEquipment($request){
    }
    public function transport($request){
    }
}

class CancelledRequest extends State{
    public function send($request){
    }
    public function cancel($request){
    }
    public function decline($request){

    }
    public function acceptRequest($request){

    }
    public function acceptEquipment($request){
    }
    public function transport($request){
    }
}

class DeclinedRequest extends State{
    public function send($request){
    }
    public function cancel($request){
    }
    public function decline($request){

    }
    public function acceptRequest($request){

    }
    public function acceptEquipment($request){
    }
    public function transport($request){
    }
}

class AcceptedRequest extends State{
    public function send($request){
    }
    public function cancel($request){
        $request.setState(new CancelledRequest() );
    }
    public function decline($request){

    }
    public function acceptRequest($request){

    }
    public function acceptEquipment($request){
    }
    public function transport($request){
        $request.setState(new TransportedRequest() );

    }
}

class TransportedRequest extends State{
    public function send($request){
    }
    public function cancel($request){
    }
    public function decline($request){

    }
    public function acceptRequest($request){
        $request.setState(new ArrivedRequest() );

    }
    public function acceptEquipment($request){
    }
    public function transport($request){

    }
}

class ArrivedRequest extends State{
    public function send($request){
    }
    public function cancel($request){
    }
    public function decline($request){

    }
    public function acceptRequest($request){

    }
    public function acceptEquipment($request){
    }
    public function transport($request){
    }
}


?>