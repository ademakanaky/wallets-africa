<?php
// only a post with paystack signature header gets our attention
if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) 
	|| !array_key_exists('HTTP_X_WALLET_AFRICA_SIGNATURE', $_SERVER) ) 
    exit();

// Retrieve the request's body
$input = @file_get_contents("php://input");
define('WALLET_AFRICA_SECRET_KEY','hfucj5jatq8h');//change this to your live secret key

// validate event do all at once to avoid timing attack
if($_SERVER['HTTP_X_WALLET_AFRICA_SIGNATURE'] !== hash_hmac('sha512', $input, WALLET_AFRICA_SECRET_KEY))
  exit();

http_response_code(200);

// parse event (which is json string) as object
// Do something - that will not take long - with $event
$event = json_decode($input);
///do the tranasction update here using the status field of $event
///this is necessary for requests that were pending
///example is the switch below
switch($event->event){
    // transfer.success
    case 'transfer.success':
        // TIP: update transaction detail like so
    	$status = $event->data->Message;
    	$code = $event->data->TransactionReference;
    	$transtime = $event->data->transferred_at;
    	$sql = "UPDATE 'transaction' SET 'trans_status' = {$status},'transaction_time' = {$transtime} WHERE 'transaction_reference' = {$code}"; //then you run the query. Do not return any response
        break;
    case 'transfer.failed':
    	// TIP: update transaction detail
    	// same as above
    	break;
}
exit();