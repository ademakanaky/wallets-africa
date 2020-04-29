<?php

namespace Ademakanaky;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException as ConnectException;
use GuzzleHttp\Exception\ClientException as ClientException;

trait Helper
{	
	private $currency;
    
    protected $url,$config;

	public function __construct()
    {
        $this->config = Config::getInstance();
    }

    private function api_keys()
    {
         
         $keys = $this->config->getAppKeys();
            return [
                'api_secret' => $keys['secret'], 
                'api_public' => $keys['public'],
            ];
    }

    private function setCurrency()
    {
        $this->currency = $this->config::getCurrency();
        return $this->currency;
    }

    private function setBaseUrl()
    {
        $this->url = $this->config::getBaseUrl();
        return $this->url;
    }
    private function endpoints()
    {
        $urls = $this->config::endpoints();
        return $urls;
    }

    private function call($endpoint, $method = 'POST', $body)
    {
        $keys = $this->api_keys();
        $public = $keys['api_public'];
        $baseServiceURL = $this->setBaseUrl();
        $headers = ['authorization' => 'Bearer ' . $public, 'content-type' => 'application/x-www-form-urlencoded'];
        $client = new Client(array(
                'base_uri' => $baseServiceURL,
                'headers' => $headers
            ));
        try{
                $response = $client->request(
                $method,
                $endpoint,
                ['body' => $body]
            );

            return $response->getBody();
        }catch(ConnectException $e){
            return "Error in connection to the service. Please try again.";
        }
        
    }

    private function json_call($endpoint, $method = 'POST', $jsonData)
    {
        $keys = $this->api_keys();
        $public = $keys['api_public'];
        $baseServiceURL = $this->setBaseUrl();
        $headers = ['authorization' => 'Bearer ' . $public, 'content-type' => 'application/json'];
        $client = new Client(array(
                'base_uri' => $baseServiceURL,
                'headers' => $headers
            ));
        try{
                $response = $client->request(
                $method,
                $endpoint,
                ['json' => $jsonData]
            );

            return $response->getBody();
        }catch(ConnectException | ClientException $e){
        	$err = get_class($e);
        	switch ($err) {
        		case "GuzzleHttp\Exception\ClientException":
        			return "Invalid verification code.";
        			break;
        		
        		default:
        			return "Error in connection to the service. Please try again.";
        			break;
        	}
            
        }
        
    }
    private function InsufficientBalanceMessage()
    {
        return 'A friendly message should be sent to customer in this scenario.';
    }

    private function genTranxRef()
    {
        return TransactionRefGen::getHashedToken();
    }
 }