<?php

namespace Ademakanaky;

use Dotenv\Dotenv;

class Config
{
     private static $instance = null;
     private $config;

     private function __construct()
     {
         $dotenv = Dotenv::createImmutable(__DIR__.'/');
         $this->config = $dotenv->load();
     }

     public static function getInstance()
     {
        if(!self::$instance)
        {
          self::$instance = new Config();
        }
       
        return self::$instance;
     }

     protected static function getAppMode()
     {
        return getenv('APP_ENV');
     }

     public static function getCurrency()
     {
         return getenv('CURRENCY');
     }

     public static function getBaseUrl()
     {
        if (self::getAppMode() === 'development') {
            return getenv('BASE_URL');
        }

        if (self::getAppMode() === 'production') {
            return getenv('BASE_URL_LIVE');
        }
         return null;
     }

     public static function getAppKeys()
     {
        $keys = [];
        if (self::getAppMode() === 'development') {
            $keys['secret'] = getenv('TEST_SECRET');
            $keys['public'] = getenv('TEST_PUBLIC');
        }

        if (self::getAppMode() === 'production') {
            $keys['secret'] = getenv('LIVE_SECRET');
            $keys['public'] = getenv('LIVE_PUBLIC');
        }
         return $keys;
     }

     public static function endpoints()
     {
        $urls = new \stdClass();
            
        $urls->balance = getenv('BALANCE_EP');
        $urls->transfer = getenv('TRANSFER_EP');
        $urls->transferStatus = getenv('TRANSFERST_EP');
        $urls->enquiry = getenv('ENQUIRY_EP');
        $urls->banks = getenv('BANKS_EP');
        $urls->wallet_bal = getenv('WALLET_BALANCE_EP');
        $urls->wallet_user = getenv('WALLET_USER_EP');
        $urls->wallet_bvn = getenv('WALLET_BVN_EP');
        $urls->wallet_txn = getenv('WALLET_TXN_EP');
        $urls->pin = getenv('WALLET_PIN_EP');
        $urls->password = getenv('WALLET_PASSWORD_EP');
        $urls->retnuban = getenv('WALLET_RETRIEVE_NUBAN_EP');
        $urls->genuban = getenv('WALLET_GENERATE_NUBAN_EP');
        $urls->generate = getenv('WALLET_GENERATE_EP');
        $urls->verify = getenv('WALLET_VERIFY_EP');
        $urls->credit = getenv('WALLET_CREDIT_EP');
        $urls->debit = getenv('WALLET_DEBIT_EP');
        $urls->resolvebvn = getenv('BVN_RESOLUTION_EP');
        $urls->resolvebvndetails = getenv('BVN_RESOLUTION_DETAILS_EP');
        $urls->airtimeproviders = getenv('AIRTIME_PROVIDERS_EP');
        $urls->airtimepurchase = getenv('AIRTIME_PURCHASE_EP');
        $urls->transactions = getenv('GET_TRANSACTIONS_EP');
        $urls->bvn = getenv('VERIFY_BVN_EP');
        $urls->wallets = getenv('GET_WALLETS_EP');
        $urls->wallet2wallet = getenv('GET_WALLET2WALLET_TXNS_EP');

        return $urls;
     }


}