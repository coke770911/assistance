<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Libraries\Ecpay;

class Home extends BaseController {


    private $HashKey = '5294y06JbISpM5x9';
    private $HashIV = 'v77hoKGq4kWxNNIS';
    private $EncryptType = '1';
    
    public function index()
    {   
        $city_data = model('App\Models\RefData', true);
        $data = array(
            "City" => $city_data->getCity(),
            "CityArea" => $city_data->getCityArea()
        );
        echo view('v_index', $data);       
    }

    #驗證資訊
    public function cashcheck() {
        //訂單編號與訂單時間
        $p_id = "OIT".time();
        $OrderDate = date('Y/m/d H:i:s');

        $money = isset($_POST["money"]) ? $_POST["money"] : 0 ;
        $receipt = isset($_POST["receipt"]) ? $_POST["receipt"] : "" ;
        $name = isset($_POST["name"]) ? $_POST["name"] : "" ;
        $tel = isset($_POST["tel"]) ? $_POST["tel"] : "" ;
        $email = isset($_POST["email"]) ? $_POST["email"] : "" ;
        $message = isset($_POST["message"]) ? $_POST["message"] : "" ;
        $city = isset($_POST["city"]) ? $_POST["city"] : "" ;
        $city_area = isset($_POST["city_area"]) ? $_POST["city_area"] : "" ;
        $address = isset($_POST["address"]) ? $_POST["address"] : "" ;
        
        //參數檢查避免傳送至綠界出錯
        if(!is_numeric($money) || !($money >= 100 &&  $money <= 100000)) {
            die("捐款金額一百元至十萬元新台幣整。");
        }

        if(strlen($name) > 450) {
            die("捐款人姓名輸入字元過多。");
        }

        if(strlen($tel) > 450) {
            die("聯絡電話輸入字元過多。");
        }

        if(strlen($email) > 450) {
            die("Email輸入字元過多。");
        }

        if(strlen($message) > 450) {
            die("想說的話輸入字元過多。");
        }

        if(strlen($address) > 150) {
            die("地址輸入字元過多。");
        }

        echo "將為您導向綠界金流平台！...";
        
        $data = array(
            "tl_id" => 0,
            "tl_pid" => $p_id,
            "tl_money" => $money,
            "tl_receipt" => $receipt,
            "tl_name" => $name,
            "tl_email" => $email,
            "tl_tel" => $tel,
            "tl_message" => $message,
            "tl_city" => $city,
            "tl_city_area" => $city_area,
            "tl_address" => $address,
            "tl_create_time" => $OrderDate,
            "tl_modtfy_time" => $OrderDate
        );
        $TransactionList = model('App\Models\TransactionList', true);
        $TransactionList->setValue($data);
        $TransactionList->update_table();
        $this->cashflow($p_id,$money,$OrderDate);
    }

    #金流處理
    private function cashflow($p_id = '',$p_money = 0,$OrderDate) {
        $MerchantTradeNo = $p_id;
        $Money = $p_money; 
        try {
            $obj = new ECPay();
            #商店參數
            $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
            $obj->HashKey     = $this->HashKey ;                                               //測試用Hashkey，請自行帶入ECPay提供的HashKey
            $obj->HashIV      = $this->HashIV ;                                                //測試用HashIV，請自行帶入ECPay提供的HashIV
            $obj->MerchantID  = '2000214' ;                                                    //測試用MerchantID，請自行帶入ECPay提供的MerchantID
            $obj->EncryptType = $this->EncryptType ;                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密

            #基本參數(請依系統規劃自行調整)
            $obj->Send['ReturnURL']         = "https://donate.oit.edu.tw/Home/cashflowresult" ; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                                 //訂單編號
            $obj->Send['MerchantTradeDate'] = $OrderDate;                                       //交易時間
            $obj->Send['TotalAmount']       = $Money;                                           //交易金額
            $obj->Send['TradeDesc']         = urlencode("助學捐款") ;                            //交易描述
            $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;                       //付款方式:全功能
            $obj->Send['ClientBackURL']     = "https://donate.oit.edu.tw";                      //返回主首頁
                           
            //訂單的商品資料
            array_push($obj->Send['Items'], array(
                    'Name' => "捐贈金額", 
                    'Price' => (int)$Money,
                    'Currency' => "元", 
                    'Quantity' => (int) "1", 
                    'URL' => "dedwed"
                ));

            # 電子發票參數
            /*
            $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
            $obj->SendExtend['RelateNumber'] = "Test".time();
            $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
            $obj->SendExtend['CustomerPhone'] = '0911222333';
            $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
            $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
            $obj->SendExtend['InvoiceItems'] = array();
            // 將商品加入電子發票商品列表陣列
            foreach ($obj->Send['Items'] as $info)
            {
                array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                    $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
            }
            $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
            $obj->SendExtend['DelayDay'] = '0';
            $obj->SendExtend['InvType'] = ECPay_InvType::General;
            */

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
        $returnCheckMacValue = \ECPay_CheckMacValue::generate($_POST,$this->HashKey,$this->HashIV,$this->EncryptType);
        $checkValue = $returnCheckMacValue;

        $data = array(
            "tr_MerchantTradeNo" => $_POST["MerchantTradeNo"],
            "tr_PaymentType" => $_POST["PaymentType"],
            "tr_PaymentDate" => $_POST["PaymentDate"],
            "tr_TradeAmt" => $_POST["TradeAmt"],
            "tr_TradeDate" => $_POST["TradeDate"],
            "tr_TradeNo" => $_POST["TradeNo"],
            "tr_content" => json_encode($_POST)
        );

        if($returnCheckMacValue === $_POST['CheckMacValue']) {
            $TransactionReturn = model('App\Models\TransactionReturn', true);
            $TransactionReturn->setValue($data);
            $TransactionReturn->update_table();  
        }
        echo '1|OK';
    }

    /**
     * 
     */
    public function flowResult() {

    } 
}
