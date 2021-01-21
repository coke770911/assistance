<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Libraries\Ecpay;

class Home extends BaseController {

 
    public function index()
    {   
        $city_data = model('App\Models\RefData', true);

        $data = array(
            "City" => $city_data->getCity(),
            "CityArea" => $city_data->getCityArea()
        );
        echo view('v_index', $data);       
    }


    /**
     * 驗證表單資訊
     * @var $p_id 最多20碼
     */
    public function cashcheck() {
        //訂單編號與訂單時間
        $p_id = "OIT".time().rand(10001,20000);
        $OrderDate = date('Y/m/d H:i:s');

        $money = isset($_POST["money"]) ? $_POST["money"] : 0 ;
        $receipt = isset($_POST["tl_is_receipt"]) ? $_POST["tl_is_receipt"] : "" ;
        $name = isset($_POST["name"]) ? $_POST["name"] : "" ;
        $tel = isset($_POST["tel"]) ? $_POST["tel"] : "" ;
        $email = isset($_POST["email"]) ? $_POST["email"] : "" ;
        $message = isset($_POST["message"]) ? $_POST["message"] : "" ;
        $city = isset($_POST["city"]) ? $_POST["city"] : "" ;
        $city_area = isset($_POST["city_area"]) ? $_POST["city_area"] : "" ;
        $address = isset($_POST["address"]) ? $_POST["address"] : "" ;

        $tl_receipt_title = isset($_POST["tl_receipt_title"]) ? $_POST["tl_receipt_title"] : "" ;
        $tl_std_id = isset($_POST["tl_std_id"]) ? $_POST["tl_std_id"] : "" ;
        $tl_is_show = isset($_POST["tl_is_show"]) ? $_POST["tl_is_show"] : 0 ;

        $tl_is_Credit = isset($_POST["Credit"]) ? $_POST["Credit"] : 0 ;
        
        //參數檢查避免傳送至綠界出錯
        if(!is_numeric($money) || !($money >= 100 &&  $money <= 100000)) {
            die("捐款金額一百元至十萬元新台幣整。");
        }

        if(strlen($name) > 50) {
            die("捐款人姓名輸入字元過多。");
        }

        if(strlen($tel) > 50) {
            die("聯絡電話輸入字元過多。");
        }

        if(strlen($email) > 50) {
            die("Email輸入字元過多。");
        }

        if(strlen($message) > 450) {
            die("想說的話輸入字元過多。");
        }

        if(strlen($tl_receipt_title) > 150) {
            die("收據抬頭輸入名稱過長。");
        }

        if(strlen($tl_std_id) > 20) {
            die("學號字元輸入過長。");
        }

        echo "將為您導向綠界金流平台！...";

        $data = array(
            "tl_id" => 0,
            "tl_pid" => $p_id,
            "tl_money" => $money,
            "tl_is_receipt" => $receipt,
            "tl_name" => $name,
            "tl_email" => $email,
            "tl_tel" => $tel,
            "tl_message" => $message,
            "tl_city" => $city,
            "tl_city_area" => $city_area,
            "tl_address" => $address,
            "tl_create_time" => $OrderDate,
            "tl_modtfy_time" => $OrderDate,
            "tl_receipt_title" => $tl_receipt_title,
            "tl_std_id" => $tl_std_id,
            "tl_is_show" => $tl_is_show,
            "tl_is_Credit" => $tl_is_Credit
        );
        //將申請付款的資料寫入資料庫
        $TransactionList = model('App\Models\TransactionList', true);
        $TransactionList->setValue($data);
        $TransactionList->update_table();
        //準備處理綠界導向的參數
        $this->cashflow($p_id,$money,$OrderDate,$tl_is_Credit,$tl_is_Credit);
    }

    /**
     * 綠界金流處理
     * @var $p_id 產生的訂單編號
     * @var $p_money 金額
     * @var $OrderDate 產生訂單日期
     */
    private function cashflow($p_id = '',$p_money = 0,$OrderDate,$is_Credit = 0) {
        $MerchantTradeNo = $p_id;
        $Money = $p_money; 
        try {
            $obj = new ECPay();
            #商店參數
            $obj->ServiceURL  = $_ENV["ServiceURL"] ;                   //服務位置
            $obj->HashKey     = $_ENV["HashKey"] ;                      //Hashkey，請自行帶入ECPay提供的HashKey
            $obj->HashIV      = $_ENV["HashIV"] ;                       //HashIV，請自行帶入ECPay提供的HashIV
            $obj->MerchantID  = $_ENV["MerchantID"] ;                   //MerchantID，請自行帶入ECPay提供的MerchantID
            $obj->EncryptType = $_ENV["EncryptType"] ;                  //CheckMacValue加密類型，請固定填入1，使用SHA256加密

            #基本參數(請依系統規劃自行調整)
            $obj->Send['ReturnURL']         = $_ENV['ReturnURL'] ;        //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;           //訂單編號
            $obj->Send['MerchantTradeDate'] = $OrderDate ;                //交易時間
            $obj->Send['TotalAmount']       = $Money ;                    //交易金額
            $obj->Send['TradeDesc']         = urlencode("助學捐款") ;      //交易描述
            $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ; //付款方式:全功能
            $obj->Send['ClientBackURL']     = $_ENV['ClientBackURL'] ;    //返回主首頁
            //$obj->Send['OrderResultURL']    = $_ENV['OrderResultURL'];    //返回自訂頁面
            $obj->Send['NeedExtraPaidInfo'] = 'Y';                        //額外的付款資訊
                
            //訂單的商品資料
            array_push($obj->Send['Items'], 
                array(
                    'Name' => "捐贈金額", 
                    'Price' => (int)$Money,
                    'Currency' => "元", 
                    'Quantity' => (int) "1", 
                    'URL' => "dedwed"
            ));

            //定期定額 
            if($is_Credit){
                $obj->Send['ChoosePayment'] = \ECPay_PaymentMethod::Credit ;
                $obj->SendExtend['PeriodAmount']  = (int)$Money ; //交易金額
                $obj->SendExtend['PeriodType']    = "M" ;         //天數 D M Y
                $obj->SendExtend['Frequency']     = 1 ;           //執行頻率
                $obj->SendExtend['ExecTimes']     = 24 ;          //執行次數
            }
            $obj->CheckOut(); //產生訂單(auto submit至ECPay) 
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }

    /**
     * 綠界回傳的資料 交易結果寫入資料庫
     * @return 回傳 1|OK
     */
    public function cashflowresult() {
        $obj = new ECPay();
        $returnCheckMacValue = \ECPay_CheckMacValue::generate($_POST,$_ENV["HashKey"],$_ENV["HashKey"],$_ENV["EncryptType"]);

        $data = array(
            "tr_MerchantTradeNo" => $_POST["MerchantTradeNo"],
            "tr_PaymentType" => $_POST["PaymentType"],
            "tr_PaymentDate" => $_POST["PaymentDate"],
            "tr_TradeAmt" => $_POST["TradeAmt"],
            "tr_TradeDate" => $_POST["TradeDate"],
            "tr_TradeNo" => $_POST["TradeNo"],
            "tr_content" => json_encode($_POST),
        );

        //if($returnCheckMacValue == $_POST['CheckMacValue']) {
            $TransactionReturn = model('App\Models\TransactionReturn', true);
            $TransactionReturn->setValue($data);
            $TransactionReturn->update_table();  
        //}
        echo '1|OK';
    }
    /*
    public function keycheck() {
        $obj = new ECPay();
        $returnCheckMacValue = \ECPay_CheckMacValue::generate($_POST,$_ENV["HashKey"],$_ENV["HashKey"],$_ENV["EncryptType"]);
        print_r($returnCheckMacValue);

    }
    */
}
