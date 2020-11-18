<?php
namespace App\Libraries;
require_once APPPATH.'ThirdParty/AioSDK/sdk/ECPay.Payment.Integration.php';

class ECPay extends \ECPay_AllInOne {
    public function __construct(){
        parent::__construct();
    }
}


