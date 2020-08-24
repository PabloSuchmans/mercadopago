<?php
    require __DIR__ .  '/vendor/autoload.php';
    
    MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");

    switch($_POST["topic"]) {
            case "payment":
                $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
                break;
            case "plan":
                $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
                break;
            case "subscription":
                $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
                break;
            case "invoice":
                $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
                break;
        }

    function logfile($str){
        $file='log.txt';
        $myfile = fopen(dirname(__FILE__)."/log.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $str);
        fclose($myfile);
    }
    $notifications=file_get_contents("php://input");
    logfile($payment);

//    {
//       "id": 12345,
//        "live_mode": true,
//        "type": "payment",
//        "date_created": "2015-03-25T10:04:58.396-04:00",
//        "application_id": 123123123,
//        "user_id": 44444,
//        "version": 1,
//        "api_version": "v1",
//       "action": "payment.created",
//       "data": {
//           "id": "999999999"
//       }
//   }

?>
