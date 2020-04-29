<?php

namespace Ademakanaky;

class Identity {
	use Helper;

	public function ResolveBvn($bvn)
    {
    	$url = $this->endpoints()->resolvebvn;
    	$data = new \stdClass();
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->bvn = $bvn;

		return $this->json_call($url,'POST', $data);
    }

    public function ResolveBvnDetails($bvn)
    {
    	$url = $this->endpoints()->resolvebvndetails;
    	$data = new \stdClass();
		$data->SecretKey = $this->api_keys()['api_secret'];
		$data->bvn = $bvn;

		return $this->json_call($url,'POST', $data);
    }
}