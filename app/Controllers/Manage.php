<?php 
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Manage extends BaseController {
	public function index()	{
        return view('templates/v_loginform',array('message'=>''));
    }

    public function exreportlist() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', '這是第一格');

        
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
     * 
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
            'tl_receipt' => isset($_POST['tl_receipt']) ? $_POST['tl_receipt'] : '',
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
            "tl_receipt" => $data['field']['tl_receipt'] == 1 ? $data['field']['tl_receipt'] : ''
        ));

        $data['list'] = $TransactionList->getList();

        echo view('templates/v_header', $data);
        echo view('manage/v_search_view.php', $data);
        echo view('manage/v_transaction_list', $data);
        echo view('templates/v_footer', $data);   
    }

    /**
     * 後台登入LDAP處理
     */
    public function login() {
        $acc = isset($_POST["account"]) ? (string)chop(strtoupper($_POST["account"])) : "";
        $pwd = isset($_POST["password"]) ? (string)$_POST["password"] : "";
        
        if($this->ldap_check($acc,$pwd)) {
            if(in_array($acc,array("FZ083","OT195","OT119"))) {
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
     * 登出處理
     */
    public function logout() {
        unset($_SESSION['USER_LOGIN']);
        return view('templates/v_loginform',array('message'=>'已成功登出！'));
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