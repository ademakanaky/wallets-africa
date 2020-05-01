<?php 

/**
* This class defines operations on the sub wallets
* i.e. on wallets created within the main wallet. 
*/

namespace Ademakanaky;

class Wallet
{
	use Helper;
    
    public function createWallet($fname,$lname,$email,$dob){

    	$url = $this->endpoints()->generate;
    	$body = "firstName=".$fname."&lastName=".$lname."&email=".$email."&secretKey=". $this->api_keys()['api_secret']."&dateOfBirth=".$dob."&Currency=". $this->setCurrency();

    	return $this->call($url,'POST',$body);
    }

    public function GenerateAccountNumber($phone)
    {
    	$url = $this->endpoints()->genuban;
    	$body = "phoneNumber=".$phone."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }

    public function RetrieveAccountNumber($phone)
    {
    	$url = $this->endpoints()->retnuban;
    	$body = "phoneNumber=".$phone."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }

    public function GetUser($phone)
    {
    	$url = $this->endpoints()->wallet_user;
    	$body = "phoneNumber=".$phone."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }

    public function SetPassword($phone, $password)
    {
    	$url = $this->endpoints()->password;
    	$body = "phoneNumber=".$phone."&password=".$password."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }

    public function SetPin($phone, $pin)
    {
    	$url = $this->endpoints()->pin;
    	$body = "phoneNumber=".$phone."&transactionPin=".$pin."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }
    public function VerifyBvn($phone, $bvn, $dob)
    {
    	$url = $this->endpoints()->wallet_bvn;
    	$body = "phoneNumber=".$phone."&bvn=".$bvn."&dateOfBirth=".$dob."&secretKey=". $this->api_keys()['api_secret'];

    	return $this->call($url,'POST',$body);
    }

    public function Credit($phone, $amount)
    {
    	$url = $this->endpoints()->credit;
    	$data = new \stdClass();
    	$data->transactionReference = $this->genTranxRef();
    	$data->amount = $amount;
    	$data->phoneNumber = $phone;
    	$data->secretKey = $this->api_keys()['api_secret'];

    	return $this->json_call($url,'POST', $data);
    }

    public function Debit($phone, $amount)
    {
    	$url = $this->endpoints()->debit;
    	$data = new \stdClass();
    	$data->transactionReference = $this->genTranxRef();
    	$data->amount = $amount;
    	$data->phoneNumber = $phone;
    	$data->secretKey = $this->api_keys()['api_secret'];
    	
    	return $this->json_call($url,'POST', $data);
    }

    public function Transactions($transactionType, $dateFrom, $dateTo, $skip, $take, $transactionPin, $phoneNumber)
    {
    	$url = $this->endpoints()->wallet_txn;
    	$data = new \stdClass();
    	$data->Currency = $this->setCurrency();//can also be sent as a parameter otherwise leave default
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->transactionType	= $transactionType;
		$data->dateFrom	= $dateFrom; 
		$data->dateTo	= $dateTo; 
		$data->skip	= $skip;
		$data->take	= $take;
		$data->transactionPin = $transactionPin;
		$data->phoneNumber = $phoneNumber;

		return $this->json_call($url,'POST', $data);
    }

    public function GetBalance($phone)
    {
    	$url = $this->endpoints()->wallet_bal;
    	$data = new \stdClass();
    	$data->Currency = $this->setCurrency(); 
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->phoneNumber = $phone;

		return $this->json_call($url,'POST', $data);
    }

}