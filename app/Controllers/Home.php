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
        $money = 0;

        //定期定額模式確認
        if($_POST["sel_mode"] === '0') {
            $money = $_POST["money"];
        } else {
            $money = $_POST["Credit_money"];
        }
        
        //收據資料確認
        if($_POST["is_receipt"] === '1') {
            if($_POST['t_receipt_title'] == '') {
                die("請輸入收據抬頭。");
            }

            if($_POST['t_id_number'] == '') {
                die("請輸入身分證字號或公司統編。");
            }

            if($_POST['t_city'] == '0') {
                die("請選擇收據縣市。");
            }

            if($_POST['t_address'] !== '') {
                die("請輸入收據地址。");
            }
        }

        echo "將為您導向綠界金流平台！...";
        //$_ENV["CI_ENVIRONMENT"] ;
        $data = array(
            "t_Orderid" => $p_id,
            "t_sel_mode" => $_POST["sel_mode"],
            "t_money" => $money,
            "t_Credit_money" => $money,
            "t_is_receipt" => $_POST["is_receipt"],
            "t_receipt_title" => $_POST["receipt_title"],
            "t_id_number" => $_POST["id_number"],
            "t_city" => $_POST["city"],
            "t_address" => $_POST["address"],
            "t_name" => $_POST["name"],
            "t_tel" => $_POST["tel"],
            "t_email" => $_POST["email"],
            "t_stdno" => $_POST["stdno"],
            "t_is_show" => $_POST["is_show"],
            "t_is_test_mode" => $_ENV["CI_ENVIRONMENT"] === 'production' ? 0 : 1 ,
        );
        print_r($data);
        //將申請付款的資料寫入資料庫
        $TransactionList = model('App\Models\Transaction', true);
        $TransactionList->setValue($data);
        $TransactionList->update_table();
        //準備處理綠界導向的參數
        $this->cashflow($p_id,$money,$OrderDate,$_POST["sel_mode"]);
        print_r($TransactionList);
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
            if($is_Credit == '1'){
                $obj->Send['ChoosePayment'] = \ECPay_PaymentMethod::Credit ;
                $obj->SendExtend['PeriodAmount']  = (int)$Money ; //交易金額
                $obj->SendExtend['PeriodType']    = "M" ;         //天數 D M Y
                $obj->SendExtend['Frequency']     = 1 ;           //執行頻率
                $obj->SendExtend['ExecTimes']     = 12 ;          //執行次數
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
