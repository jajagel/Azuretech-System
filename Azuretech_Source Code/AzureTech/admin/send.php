<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
$oid=$_POST['oid'];
$account_sid = 'AC0c4538f8b406027b11e6e8414cb0eae4';
$auth_token = '0c42b0ee6e0dcc477f50a28c33d58dbf';

$twilio_number = "+15672352478";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    '+639215857751',
    array(
        'from' => $twilio_number,
        'body' => 'Admin'
    )
);
header("Location: view-order.php?orderid=$oid");
//action="send.php?orderid=<?php echo $oid?>"