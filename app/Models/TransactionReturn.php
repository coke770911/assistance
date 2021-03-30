<?php 
namespace App\Models;
use CodeIgniter\Model;

class TransactionReturn extends Model
{
  protected $table = 'TransactionReturn';
  protected $db ;
  
  #資料庫欄位
    private $tr_id = 0 ;

    private $tr_MerchantTradeNo;
    private $tr_PaymentType;
    private $tr_PaymentDate;
    private $tr_TradeAmt;
    private $tr_TradeDate;
    private $tr_TradeNo;

    private $tr_content ;
    private $tr_create_datetime ;

  //初始連線
  function __construct() {
    $this->db = db_connect();
    $this->db->connect();
  }

  /**
   * INSERT UPDATE to function
   * @var tr_id int
   */
    public function update_table() {
        if($this->tr_id === 0) {
            $sql = "INSERT INTO [Assistance].[dbo].[TransactionReturn] ([tr_MerchantTradeNo]
            ,[tr_PaymentType]
            ,[tr_PaymentDate]
            ,[tr_TradeAmt]
            ,[tr_TradeDate]
            ,[tr_TradeNo]
            ,[tr_content]) VALUES(?,?,?,?,?,?,?)";
            $data = array(
                $this->tr_MerchantTradeNo,
                $this->tr_PaymentType,
                $this->tr_PaymentDate,
                $this->tr_TradeAmt,
                $this->tr_TradeDate,
                $this->tr_TradeNo,
                $this->tr_content
            );
            $this->db->srv_query($sql,$data);
            //return $this->db->insertID();
        } else {
            /*
            $sql = "UPDATE [dbo].[TransactionReturn]
            SET [tl_receipt] = ?, 
                [tl_is_pay] = ?, 
                [tl_pay_type] = ?,
                [tl_modtfy_time] = ?
                WHERE tr_id = ?" ;
            $this->db->srv_query($sql,$data);
            return $this->db->affectedRows();
            */
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
