<?php

namespace Ademakanaky;

class Payout
{
    use Helper;

    public function canTransfer($amount)
    {
        $url = $this->endpoints()->balance;
        $body = "Currency=". $this->setCurrency() ."&SecretKey=". $this->api_keys()['api_secret'];
        $balance = $this->call($url,'POST', $body);
        $balance = json_decode($balance,true);
        $transferFee = 15;
        $amountPlusTransferFee = $amount + $transferFee;
        $balancec = $balance['Data']['WalletBalance'];

        if ($balancec <= $amountPlusTransferFee){
            return false;
        }
        return true;
    }


    public function getBanks(){
        ///fetch all banks
        $url = $this->endpoints()->banks;
        $keys = $this->api_keys();
        $secret = $keys['api_secret'];
        $body = "Secret%20Key=" . $secret;
        $response = $this->call($url,'POST',$body);

        ///update banks.json file
        file_put_contents('banks.json', $response);
        return $response;
    }

    public function accountEnquiry($bankCode, $accountNo)
    {
        $params = "AccountNumber=". $accountNo . "&BankCode=" . $bankCode . "&SecretKey=" . $this->api_keys()['api_secret'];
        $url = $this->endpoints()->enquiry;
        $response = $this->call($url, 'POST', $params);
        return $response;
    }

      public function initiateTransfer($bankCode, $accountNo, $amount, $reason)
    {
        /// Only transfer if there is enough balance.

        if (!$this->canTransfer($amount)) {
            return $this->InsufficientBalanceMessage();
        }

        //save this $transref in db transactions table alongside other details of the transaction
        $transref = $this->genTranxRef();
        $resolveAccount = json_decode($this->accountEnquiry($bankCode, $accountNo),true);
        if (!$resolveAccount) {
            return "Account cannot be resolved. Please try again";
        }

        $url = $this->endpoints()->transfer;
        $body = "BankCode=". $resolveAccount['BankCode'] . "&SecretKey=" . $this->api_keys()['api_secret']. "&AccountNumber=". $accountNo . "&AccountName=". $resolveAccount['AccountName']. "&TransactionReference=". $transref . "&Amount=". $amount . "&Naration=". $reason;
        $transferResponse = $this->call($url,'POST',$body);
        $res = json_decode($transferResponse, true);
        $ResponseCode = $res['ResponseCode'];
        $message = $res['Message'];
        if (is_null($ResponseCode) || $ResponseCode != 100) {
            return "Transaction not successful. Please try again.";
        }
        
        return $message;
    }

    public function fetchTransferStatus($transactionId)
    {
        $url = $this->endpoints()->transferStatus;
        $body = "SecretKey=".$this->api_keys()['api_secret']."&TransactionReference=" . $transactionId;
        $status = $this->call($url,'POST' ,$body);
        return $status;
    }


}