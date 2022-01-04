<?php

$rand=rand(0,1);

if($rand==0){
    echo '0';
}
else{
    echo '1';
}

class Donation
{
    private DonationStrategy $donationStrategy;

    public function __construct()
    {

    }

    public function setStrategy(DonationStrategy $donationStrategy): void
    {
        $this->donationStrategy = $donationStrategy;
    }

    public function donate(int $amount): bool
    {
        return $this->donationStrategy->donate($amount);
    }
}

interface DonationStrategy
{
	public function donate(int $amount): bool;
}

class CreditCardStrategy implements DonationStrategy
{
	private String $name;
	private String $cardNumber;
	private String $cvv;
	private String $dateOfExpiry;
	
    public function __construct(String $name, String $cardNumber, String $cvv, String $dateOfExpiry)
    {
        $this->name = $name;
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->dateOfExpiry = $dateOfExpiry;
    }
	
	public function donate(int $amount): bool
    {
        return rand(0,1)==0;
	}

}

class PaypalStrategy implements DonationStrategy
{
	private String $emailId;
	private String $password;
	
    public function __construct(String $emailId, String $password)
    {
        $this->emailId = $emailId;
        $this->password = $password;
    }
	
	public function donate(int $amount): bool
    {
		return rand(0,1)==0;
	}

}

?>
