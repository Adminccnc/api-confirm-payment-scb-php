<?php

//Ref special thanks
//https://developer.scb/#/documents/documentation/qr-payment/payment-confirmation.html
//https://line.amn-corporation.com/convert/flex
//https://medium.com/linedevth/%E0%B8%88%E0%B8%B1%E0%B8%94%E0%B8%81%E0%B8%B2%E0%B8%A3-dynamic-flex-message-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-php-ep-5-df1510f3cfcd
//https://www.slimframework.com/docs/v3/
//https://www.mulberryai.com/post/php-line-notify
#Admin CCNC

require 'vendor/autoload.php';
require 'Message.php'; //send->>Line<<
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->post('{Endpointpath}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    //print_r($data);
    //echo $data['transactionId'];
    $responseconfirm = array(
        'resCode' => '00', //Fix 00
        'resDesc' => 'success', // Fix success
        'transactionId' => "{$data['transactionId']}", // echo -> trasactionid 
        'confirmId' => "{$data['transactionDateandTime']}" //,Optional
    );

    $data1 = json_encode($data, JSON_PRETTY_PRINT);
    var_dump($data1);

    $data2 = json_encode($responseconfirm, JSON_PRETTY_PRINT);
    var_dump($data2);

    /* function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    $rand = generateRandomString(); */

    /* $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

    $fp = fopen("{$uuid}.{$data['payerAccountName']}.response.json",'x');
    fwrite($fp, json_encode($data1));
    fclose($fp); */

    /* $fq = fopen("{$uuid}.{$data['payerAccountName']}.confirm.json",'x');
    fwrite($fq, json_encode($data2));
    fclose($fq); */

   /*  $datas = [];
    $datas["type"] = "flex";
    $datas["altText"] = "This is a Flex Message";
    $datas["contents"]['payeeProxyId'] = $data['payeeProxyId'];
    $datas["contents"]['payeeProxyType'] = $data['payeeProxyType'];
    $datas["contents"]['payeeAccountNumber'] = $data['payeeAccountNumber'];
    $datas["contents"]['payerAccountNumber'] = $data['payerAccountNumber'];
    $datas["contents"]['payerAccountName'] = $data['payerAccountName'];
    $datas["contents"]['payerName'] = $data['payerName'];
    $datas["contents"]['sendingBankCode'] = $data['sendingBankCode'];
    $datas["contents"]['receivingBankCode'] = $data['receivingBankCode'];
    $datas["contents"]['amount'] = $data['amount'];
    $datas["contents"]['transactionId'] = $data['transactionId'];
    $datas["contents"]['transactionDateandTime'] = $data['transactionDateandTime'];
    $datas["contents"]['billPaymentRef1'] = $data['billPaymentRef1'];
    $datas["contents"]['billPaymentRef2'] = $data['billPaymentRef2'];
    $datas["contents"]['billPaymentRef3'] = $data['billPaymentRef3'];
    $datas["contents"]['currencyCode'] = $data['currencyCode'];
    $datas["contents"]['channelCode'] = $data['channelCode'];
    $datas["contents"]['transactionType'] = $data['transactionType']; */

    $datas = [];
    $datas["type"] = "flex";
    $datas["altText"] = "This is a Flex Message";
    $datas["contents"]["resCode"] = 00;
    $datas["contents"]["resDesc "] = "success";
    $datas["contents"]["transactionId"] = $data['transactionId'];
    $datas["contents"]["confirmId"] = $data['transactionDateandTime'];

    //print_r($datas);

    $chOne = curl_init(); 
    $sToken = "<Token id>";
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt( $chOne, CURLOPT_POST, 1); 
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message="."resCode = "."00 \n"."resDesc = "."success \n"."transactionId = ".$data['transactionId']."\n"."confirmId = ".$data['transactionDateandTime']); 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $chOne ); 

    //check Result error  something

    if(curl_error($chOne)) 
    { 
    echo 'error:' . curl_error($chOne);
    } 
    else { 
    $result_ = json_decode($result, true); 
    echo "status : ".$result_['status']; echo "message : ". $result_['message'];
    } 
    curl_close( $chOne );
    
    /*    
    //curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    $dataPushMessages['url'] = "https://api.line.me/v2/bot/message/push";
    $dataPushMessages['token'] = "";
    $messages['to'] = "";
    $messages['messages'][] = $datas;
    $encodeJson = json_encode($messages);

    print_r($encodeJson);
    sentMessage($encodeJson,$dataPushMessages); */
    
    return $response;
});

$app->run();
