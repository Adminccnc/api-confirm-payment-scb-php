<?php
require 'vendor/autoload.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class confirmpayment{
    public function connect(){
        $transaction_id = strtr();
        $amount(str) = Field(description="Amount of Transaction");
        $transaction_date_and_time(str) = Field(alias="transactionDateandTime",
        $description="Date and Time of transaction in ISO 8601 format SCB EASY App Payment (BP), SCB EASY App Payment (CCFA), SCB EASY App Payment (IPP), QR30, Alipay, WeChatPay : Time in GMT+7 QRCS : Time in GMT",
        );
        $currency_code(str) = Field(description="Code to define currency for transaction based on ISO 4217 for transactionAmount. Thai Baht is ‘764’");
        $transaction_type Union[str];
        }
}

$x = new confirmpayment();

$app = new \Slim\App;
$app->post('/scb/confirm/payment', function (Request $requset, Response $response ) use ($x) {
    
    $data = $x->$requset->getParsedBody();
    $data = [
        "resCode" =>  "00",
        "resDesc " => "success",
        "transactionId" => $response.'transactionId',
        "confirmId" => "abc00confirm",
        $response->getBody()->write("Hello, $values ".'<br>');
    ];
    $data_s = json_encode($data);
    var_dump($data_s);
    return $data;
});
$app->run();
