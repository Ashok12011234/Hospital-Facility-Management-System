<?php

abstract class Request
{
    protected int $id;
    protected Member $from;
    protected Member $to;
    protected RequestState $state;
    protected String $equipment;
    protected String $quantity;
    protected Chat $chat;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->state = new Requested(); 
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getFrom() 
    {
        return $this->from;
    }

    public function getTo () 
    {
        return $this->to;
    }

    public function getEquipment(): String 
    {
        return $this->equipment;
    }

    public function getQuantity(): String
    {
        return $this->quantity;
    }
    
    public function setState(RequestState $state)
    {
        $this->state = $state;
    }

    public abstract function assignAll();
    
    public function accept()
    {
        $this->state->accept($this);
    }

    public function cancel()
    {
        $this->state->cancel($this);
    }

    public function decline()
    {
        $this->state->decline($this);
    }

    public function confirmExchange()
    {
        $this->state->confirmExchange($this);
    }

    public function transport()
    {
        $this->state->transport($this);
    }

}

class HHRequest extends Request
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function assignAll()
    {
        $sql1 = "SELECT * FROM HHrequest WHERE RequestId=$this->id";

        if($result = QueryExecutor::query($sql1)){
           
            $row = $result->fetch_assoc();
            
                $hospitalID=$row["HospitalId"];
                $providerID=$row["ProviderId"];
                $this->equipment=$row["Equipment"];
                $this->quantity=$row["Quantity"];
        
          
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($result = QueryExecutor::query($sql2)){
            $row = $result->fetch_assoc();
            $this->from = Hospital::getInstance($row["HospitalId"]);

        }

        $sql3 = "SELECT * FROM Hospital WHERE HospitalId=$providerID";

        if($result = QueryExecutor::query($sql3)){
            
            $row = $result->fetch_assoc();
            $this->to = Hospital::getInstance($row["HospitalId"]);

        }
    }



}

class HPRequest extends Request
{
    public function __construct($id) 
    {
        parent::__construct($id);
    }

    public function assignAll()
    {
        $sql1 = "SELECT * FROM HPrequest WHERE RequestId=$this->id";

        if($result = QueryExecutor::query($sql1)) {
            $row = $result->fetch_assoc();
            $hospitalID=$row["HospitalId"];
            $providerID=$row["ProviderId"];
            $this->equipment=$row["Equipment"];
            $this->quantity=$row["Quantity"];
          
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($result = QueryExecutor::query($sql2)){
            //$result = $this->connection->query($sql2);
            $row = $result->fetch_assoc();
            $this->from = Hospital::getInstance($row["HospitalId"]);

        }

        $sql3 = "SELECT * FROM Provider WHERE ProviderId=$providerID";

        if($result = QueryExecutor::query($sql3)){
            //$result = $this->connection->query($sql3);
            $row = $result->fetch_assoc();
            $this->to = Provider::getInstance($row["ProviderId"]);

        }
    }
}

abstract class RequestState
{
    //public abstract function request(Request $request);
    public abstract function accept(Request $request);
    public abstract function transport(Request $request);
    public abstract function confirmExchange(Request $request);
    public abstract function cancel(Request $request);
    public abstract function decline(Request $request);

}

class Requested extends RequestState
{
    public function accept(Request $request)
    {
        $request->setState(new Accepted());
    }

    public function cancel(Request $request)
    {
        $request->setState(new Cancelled());
    }

    public function decline(Request $request)
    {
        $request->setState(new Declined());
    }

    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
}

class Accepted extends RequestState
{
    public function transport(Request $request)
    {
        $request->setState(new Transporting());
    }

    public function cancel(Request $request)
    {
        $request->setState(new Cancelled());
    }

    public function accept(Request $request){}
    public function decline(Request $request){}
    public function confirmExchange(Request $request){}
}

class Transporting extends RequestState
{
    public function confirmExchange(Request $request)
    {
        $request->setState(new ExchangeCompleted());
    }

    public function accept(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
    public function transport(Request $request){}
}

class Cancelled extends RequestState
{
    public function accept(Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class Declined extends RequestState
{
    public function accept(Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class ExchangeCompleted extends RequestState
{
    public function accept(Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class Chat
{
    private array $messages;

    public function __construct()
    {
        $this->messages = array();
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function addMessage(Message $msg): void
    {
        $this->messages[] = $msg;
    }
}

class ChatBuilder
{
    private Chat $chat;

    public function buildHHChat(HHRequest $hhrequest): Chat
    {
        $this->chat = new Chat();
        $sql="SELECT * FROM `Message` WHERE requestId ='".$hhrequest->getId()."' AND requestType ='HH' ORDER BY time ASC";
        $result = QueryExecutor::query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row) {
            $this->chat->addMessage(new Message($row));
        }
        return $this->chat;
    }

    public function buildHPChat(HPRequest $hprequest): Chat
    {
        $this->chat = new Chat();
        $sql="SELECT * FROM `Message` WHERE requestId ='".$hprequest->getId()."' AND requestType ='HP' ORDER BY time ASC";
        $result = QueryExecutor::query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row) {
            $this->chat->addMessage(new Message($row));
        }
        return $this->chat;
    }
}
class Message
{
    private int $id;
    private int $requestId;
    private String $requestType;
    private int $senderId;
    private int $receiverId;
    private String $msg;
    private int $time;

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->requestId = $data["requestId"];
        $this->requestType = $data["requestType"];
        $this->senderId = $data["senderId"];
        $this->receiverId = $data["receiverId"];
        $this->msg = $data["msg"];
        $this->time = $data["time"];
    }

    public function getId()
    {
        $this->id;
    }

    public function getRequestId()
    {
        $this->requestId;
    }

    public function getRequestType()
    {
        $this->requestType;
    }

    public function getSenderId()
    {
        $this->senderId;
    }

    public function getReceiverId()
    {
        $this->receiverId;
    }

    public function getMsg()
    {
        $this->msg;
    }

    public function getTime()
    {
        $this->time;
    }

}


?>