<?php

namespace Ademakanaky;

class Airtime
{
	use Helper;

	public function GetProviders()
    {
    	$url = $this->endpoints()->airtimeproviders;
    	$data = new \stdClass();
		$data->SecretKey = $this->api_keys()['api_secret'];

		return $this->json_call($url,'POST', $data);
    }

    public function purchase($Code, $PhoneNumber, $Amount)
    {
    	$url = $this->endpoints()->airtimepurchase;
    	$data = new \stdClass();
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->Code = $Code;
		$data->PhoneNumber = $PhoneNumber;
		$data->Amount = $Amount;

		return $this->json_call($url,'POST', $data);
    }
}