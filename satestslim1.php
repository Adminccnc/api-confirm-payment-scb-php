<?php

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->post('/scb/confirm/payment', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    print_r($data);
    
    //$data = array();
    //print_r($data);
/*     foreach ($data as $x => $val) {
        $data[] = array(
            $x['payeeProxyId'] => $val['payeeProxyId'],
            $x['payeeProxyType'] => $val['payeeProxyType'],
            $x['payeeAccountNumber'] => $val['payeeAccountNumber'],
            $x['payerAccountNumber'] => $val['payerAccountNumber'],
            $x['payerAccountName'] => $val['payerAccountName'],
            $x['payerName'] => $val['payerName'],
            $x['sendingBankCode'] => $val['sendingBankCode'],
            $x['receivingBankCode'] => $val['receivingBankCode'],
            $x['amount'] => $val['amount'],
            $x['transactionId'] => $val['transactionId'],
            $x['transactionDateandTime'] => $val['transactionDateandTime'],
            $x['billPaymentRef1'] => $val['billPaymentRef1'],
            $x['billPaymentRef2'] => $val['billPaymentRef2'],
            $x['billPaymentRef3'] => $val['billPaymentRef3'],
            $x['currencyCode'] => $val['currencyCode'],
            $x['channelCode'] => $val['channelCode'],
            $x['transactionType'] => $val['transactionType'],
        ); */
    $data1 = json_encode($data, JSON_PRETTY_PRINT);
    var_dump($data1);

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    
    echo  generateRandomString();  // OR: generateRandomString(24)
    $rand = generateRandomString();

    $fp = fopen("{$rand}.results.json",'x');
    fwrite($fp, json_encode($data1));
    fclose($fp);

    return $response;
    //};
    //print_r($response);
    //echo $response;

});
$app->run();
