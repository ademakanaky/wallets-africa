<?php

/**
* This class defines operations on the main wallet 
*/

namespace Ademakanaky;

class BaseWallet
{
	use Helper;

	public function GetBalance()
	{
		$url = $this->endpoints()->balance;
		$data = new \stdClass();
		$data->Currency = $this->setCurrency();
		$data->SecretKey = $this->api_keys()['api_secret'];

		return $this->json_call($url,'POST', $data);
	}

	public function GetWallets()
	{
		$url = $this->endpoints()->wallets;
		$data = new \stdClass();
		$data->SecretKey = $this->api_keys()['api_secret'];

		return $this->json_call($url,'POST', $data);
	}

	public function GetTransactions($transactionType, $dateFrom, $dateTo, $skip, $take)
	{
		$url = $this->endpoints()->transactions;
    	$data = new \stdClass();
    	$data->Currency = $this->setCurrency();//can also be sent as a parameter otherwise leave default
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->transactionType	= $transactionType;
		$data->dateFrom	= $dateFrom; 
		$data->dateTo	= $dateTo; 
		$data->skip	= $skip;
		$data->take	= $take;

		return $this->json_call($url,'POST', $data);
	}

	public function UpdateBvn($bvn, $dob)
    {
    	$url = $this->endpoints()->bvn;
    	$data = new \stdClass();
    	$data->bvn = $bvn;
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->dateOfBirth	= $dob;

    	return $this->json_call($url,'POST', $data);
    }
	
}