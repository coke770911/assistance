<?php 
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class Manage extends BaseController {
	public function index()	{
        return view('templates/v_loginform',array('message'=>''));
    }

    /**
     * 匯出搜尋報表
     */
    public function exreportlist() {
        $this->isChkLogin();
        $data['field'] = array(
            'FormDate' => isset($_GET['FormDate']) ? $_GET['FormDate'] : '' ,
            'FormTime' => isset($_GET['FormTime']) ? $_GET['FormTime'] : '00:00' ,
            'ToDate' => isset($_GET['ToDate']) ? $_GET['ToDate'] : '',
            'ToTime' => isset($_GET['ToTime']) ? $_GET['ToTime'] : '23:59',
            'Pid' => isset($_GET['Pid']) ? $_GET['Pid'] : '',
            'is_pay' => isset($_GET['is_pay']) ? $_GET['is_pay'] : '',
            'tl_is_receipt' => isset($_GET['tl_is_receipt']) ? $_GET['tl_is_receipt'] : '',
        );
        $TransactionList = model('App\Models\TransactionList', true);
        $TransactionList->setValue(array(
            "FromDateTime" => $_GET['FormDate'] !== '' ? date_format(date_create($_GET['FormDate'].' '.$_GET['FormTime']),'Y-m-d H:i:s') : '',
            "ToDateTime" => $_GET['FormDate'] !== '' ? date_format(date_create($_GET['ToDate'] .' '. $_GET['ToTime']),'Y-m-d H:i:s') : '',
            "tl_pid" => $_GET['Pid'] !== '' ? $_GET['Pid'] : '',
            "tl_is_pay" => $data['field']['is_pay'] == 1 ? $data['field']['is_pay'] : '',
            "tl_is_receipt" => $data['field']['tl_is_receipt'] == 1 ? $data['field']['tl_is_receipt'] : ''
        ));

        $data['list'] = $TransactionList->getList();
   
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet
            ->setCellValue('A1', '交易編號')
            ->setCellValue('B1', '交易時間')
            ->setCellValue('C1', '金額')
            ->setCellValue('D1', '收據抬頭')
            ->setCellValue('E1', '學號')
            ->setCellValue('F1', '捐款人姓名')
            ->setCellValue('G1', '是否索取收據')
            ->setCellValue('H1', '是否付款成功')
            ->setCellValue('I1', '捐款人信箱')
            ->setCellValue('J1', '捐款人電話')
            ->setCellValue('K1', '捐款人姓名地址')
            ->setCellValue('L1', '捐款人留言');


        foreach($data['list'] AS $key => $val) {
            $is_receipt = $val['tl_is_receipt'] == '0' ? '不需要收據' : '需要收據' ;
            $is_pay = $val['tl_is_pay'] == '0' ? '未完成付款' : '已完成付款' ;           
            $sheet
                ->setCellValue('A'.($key+2), $val['tl_pid'])
                ->setCellValue('B'.($key+2), $val['tl_create_time'])
                ->setCellValue('C'.($key+2), $val['tl_money'])
                ->setCellValue('D'.($key+2), $val['tl_receipt_title'])
                ->setCellValue('E'.($key+2), $val['tl_std_id'])
                ->setCellValue('F'.($key+2), $val['tl_name'])
                ->setCellValue('G'.($key+2), $is_receipt)
                ->setCellValue('H'.($key+2), $is_pay)
                ->setCellValue('I'.($key+2), $val['tl_email'])
                ->setCellValue('J'.($key+2), $val['tl_tel'])
                ->setCellValue('K'.($key+2), $val['tl_address'])
                ->setCellValue('L'.($key+2), $val['tl_message']);

        }
        
     
        $report_fileName = date("Ymd")."對帳捐款資料.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$report_fileName);
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    /**
     * 主畫面頁面
     */
    public function main() {
        $this->isChkLogin();
        $data = array();
		echo view('templates/v_header', $data);
        echo view('templates/v_footer', $data);
    }

    /**
     * 信用卡清單資料
     */
    public function TransactionList() {
        $this->isChkLogin();
        $data = array();
        
        $data['field'] = array(
            'FormDate' => isset($_POST['FormDate']) ? $_POST['FormDate'] : '' ,
            'FormTime' => isset($_POST['FormTime']) ? $_POST['FormTime'] : '00:00' ,
            'ToDate' => isset($_POST['ToDate']) ? $_POST['ToDate'] : '',
            'ToTime' => isset($_POST['ToTime']) ? $_POST['ToTime'] : '23:59',
            'Pid' => isset($_POST['Pid']) ? $_POST['Pid'] : '',
            'is_pay' => isset($_POST['is_pay']) ? $_POST['is_pay'] : '',
            'tl_is_receipt' => isset($_POST['tl_is_receipt']) ? $_POST['tl_is_receipt'] : '',
        );
        
        //GET方式 初始化刷新
        if(!isset($_POST['Pid'])) {
            echo view('templates/v_header', $data);
            echo view('manage/v_search_view.php', $data);
            echo view('templates/v_footer', $data);
            exit;
        }

        $TransactionList = model('App\Models\TransactionList', true);
        $TransactionList->setValue(array(
            "FromDateTime" => $_POST['FormDate'] !== '' ? date_format(date_create($_POST['FormDate'].' '.$_POST['FormTime']),'Y-m-d H:i:s') : '',
            "ToDateTime" => $_POST['FormDate'] !== '' ? date_format(date_create($_POST['ToDate'] .' '. $_POST['ToTime']),'Y-m-d H:i:s') : '',
            "tl_pid" => $_POST['Pid'] !== '' ? $_POST['Pid'] : '',
            "tl_is_pay" => $data['field']['is_pay'] == 1 ? $data['field']['is_pay'] : '',
            "tl_is_receipt" => $data['field']['tl_is_receipt'] == 1 ? $data['field']['tl_is_receipt'] : ''
        ));

        $data['list'] = $TransactionList->getList();

        echo view('templates/v_header', $data);
        echo view('manage/v_search_view.php', $data);
        echo view('manage/v_transaction_list', $data);
        echo view('templates/v_footer', $data);   
    }

    /**
     * 登出處理
     */
    public function logout() {
        unset($_SESSION['USER_LOGIN']);
        return view('templates/v_loginform',array('message'=>'已成功登出！'));
    }

    /**
     * 後台登入LDAP處理
     */
    public function login() {
        $acc = isset($_POST["account"]) ? (string)chop(strtoupper($_POST["account"])) : "";
        $pwd = isset($_POST["password"]) ? (string)$_POST["password"] : "";
        
        if($this->ldap_check($acc,$pwd)) {
            if(in_array($acc,explode(',',getenv('AdminManage')))) {
                $_SESSION['USER_LOGIN'] = 1;
                $this->main();
            } else {
                return view('templates/loginform',array('message' => "沒有使用權限！"));
            }
        } else {
            return view('templates/loginform',array('message' => "帳號或者密碼錯誤！"));
        }
    }

    /**
     * ldap 認證
     */
    private function ldap_check($username,$password) {
        $dn = ldap_connect($_SERVER["LDAPServer"]);
        $username = $username.$_SERVER['LDAPDomain'];
        @ldap_bind( $dn, $username, $password );
        $code = ldap_errno($dn);
        if($code === 0) {
            return true;
        } else {
            return false;
        }
    }
  
}