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
     * 主畫面頁面
     */
    public function main() {
        $this->isChkLogin();
        $data = array();
		echo view('templates/v_header', $data);
        echo view('templates/v_footer', $data);
    }

    /**
     * 申請付款紀錄
     */
    public function TransactionList() {
        $this->isChkLogin();
        
        $data = array();
        $data['sdate'] = isset($_POST['sdate']) ? $_POST['sdate'] : date("Y").'-01-01' ;
        $data['edate'] = isset($_POST['edate']) ? $_POST['edate'] : date('Y-m-d') ;
        $Transaction = model('App\Models\Transaction', true);
        $Transaction->setValue($data);

        $data['list'] = $Transaction->getList();
        echo view('templates/v_header', $data);
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