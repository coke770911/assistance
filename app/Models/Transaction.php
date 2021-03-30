<?php 
namespace App\Models;
use CodeIgniter\Model;

class Transaction extends Model {
    protected $table = 'Transaction';
    protected $db ;
    
    #資料庫欄位
    private $t_Orderid = '';
    private $t_id = 0;
    private $t_sel_mode = 0;
    private $t_money = 0;
    private $t_Credit_money = 0;
    private $t_is_receipt = 0;
    private $t_receipt_title ;
    private $t_id_number = '';
    private $t_city ;
    private $t_address = '';
    private $t_name = '';
    private $t_tel = '';
    private $t_email = '';
    private $t_stdno = '';
    private $t_is_show = 0;
    private $t_create_datetime ;
    private $t_modify_datetime ;
    private $t_is_del = 0;
    private $t_is_test_mode = 0;


    private $sdate ;
    private $edate ;

    /**
     * 初始連線
     */
    function __construct() {
        $this->db = db_connect();
        $this->db->connect();
    }

    /**
     * 取得付款資料
     */
    public function getList() {
        $data = array(
            $this->sdate,
            $this->edate,
        );
        $sql = "SELECT 
                [t_id]
                ,[t_Orderid] 
                ,CASE WHEN [t_sel_mode] = 1 THEN '定期定額' ELSE '一般捐款' END AS pay_mode
                ,[t_money]
                ,[t_Credit_money]
                ,CASE WHEN [t_is_receipt] = 1 THEN '索取' ELSE '不索取' END AS receipt
                ,[t_receipt_title]
                ,[t_id_number]
                ,ISNULL([city_name],'') AS city_name
                ,[t_address]
                ,[t_name]
                ,[t_tel]
                ,[t_email]
                ,[t_stdno]
                ,[t_is_show]
                ,[t_create_datetime]
                ,[t_modify_datetime]
                ,[t_is_del]
                ,CASE WHEN [t_is_test_mode] = 1 THEN '測試' ELSE '非測試' END AS t_mode
                ,ISNULL(tr_PaymentType,'尚未完成付款') AS PaymentType
                ,ISNULL(tr_PaymentDate,'') AS PaymentDate
                FROM [Assistance].[dbo].[Transaction]
                LEFT JOIN [Assistance].[dbo].[TransactionReturn] ON tr_MerchantTradeNo = t_Orderid
                LEFT JOIN [Assistance].[dbo].[ref_city] ON city_code = t_city
                WHERE CONVERT(DATE,t_create_datetime) BETWEEN ? AND ?";
        $this->db->srv_query($sql,$data);
        return $this->db->fetchAll();
    }

    /**
     * update table
     */
    public function update_table() {
        if($this->t_id === 0) {
            $sql = "INSERT INTO [Assistance].[dbo].[Transaction]
            ([t_Orderid]
            ,[t_sel_mode]
            ,[t_money]
            ,[t_Credit_money]
            ,[t_is_receipt]
            ,[t_receipt_title]
            ,[t_id_number]
            ,[t_city]
            ,[t_address]
            ,[t_name]
            ,[t_tel]
            ,[t_email]
            ,[t_stdno]
            ,[t_is_show]
            ,[t_is_test_mode])
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $data = array(
                $this->t_Orderid
                ,$this->t_sel_mode
                ,$this->t_money
                ,$this->t_Credit_money
                ,$this->t_is_receipt
                ,$this->t_receipt_title
                ,$this->t_id_number
                ,$this->t_city
                ,$this->t_address
                ,$this->t_name
                ,$this->t_tel
                ,$this->t_email
                ,$this->t_stdno
                ,$this->t_is_show
                ,$this->t_is_test_mode
            );
            $this->db->srv_query($sql,$data);
            return $this->db->insertID();
        } else {
            $sql = "UPDATE [dbo].[TransactionList]
            SET [tl_is_receipt] = ?, 
                [tl_is_pay] = ?, 
                [tl_pay_type] = ?,
                [tl_modtfy_time] = ?
                WHERE tl_id = ?" ;
            $this->db->srv_query($sql,$data);
            return $this->db->affectedRows();
        }
        
    }

    /**
     * setVaule -> $this->$key
     * @var data array
     */
    public function setValue($data = array()) {
        foreach($data as $key => $val) {
            $this->$key = $val;
        }
    }
}