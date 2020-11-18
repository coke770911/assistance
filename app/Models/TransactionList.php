<?php 
namespace App\Models;
use CodeIgniter\Model;

class TransactionList extends Model {
    protected $table = 'TransactionList';
    protected $db ;
    
    #資料庫欄位
    private $tl_id = 0;
    private $tl_pid ='';
    private $tl_money = 0;
    private $tl_receipt ;
    private $tl_name ;
    private $tl_email ;
    private $tl_tel ;
    private $tl_message;
    private $tl_city ;
    private $tl_city_area ;
    private $tl_address ;
    private $tl_is_pay ;
    private $tl_pay_type ;
    private $tl_create_time ;
    private $tl_modtfy_time ;

    private $FromDateTime ;
    private $ToDateTime ;

    /**
     * 初始連線
     */
    function __construct() {
        $this->db = db_connect();
        $this->db->connect();
    }

    /**
     * 取得募款清單
     */
    public function getList() {
        $data = array(
            $this->FromDateTime,
            $this->ToDateTime,
            $this->FromDateTime,
            $this->tl_pid,
            $this->tl_pid,
            $this->tl_is_pay,
            $this->tl_is_pay,
            $this->tl_receipt,
            $this->tl_receipt,
        );
        $sql = "SELECT * FROM [Assistance].[dbo].[TransactionList] WHERE 
        (([tl_create_time] BETWEEN ? AND ?) OR ('' = ?))
        AND ('' = ? OR tl_pid LIKE ?)
        AND ('' = ? OR tl_is_pay = ?)
        AND ('' = ? OR tl_receipt = ?)";
       
        $this->db->srv_query($sql,$data);
        return $this->db->fetchAll();
    }

  /**
   * INSERT UPDATE to function
   * @var tl_id int
   */
    public function update_table() {
        if($this->tl_id === 0) {
            $sql = "INSERT INTO [Assistance].[dbo].[TransactionList] (
            [tl_pid],
            [tl_money],
            [tl_receipt],
            [tl_name],
            [tl_email],
            [tl_tel],
            [tl_message],
            [tl_city],
            [tl_city_area],
            [tl_address],
            [tl_create_time],
            [tl_modtfy_time]) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

            $data = array(
                $this->tl_pid,
                $this->tl_money,
                $this->tl_receipt,
                $this->tl_name,
                $this->tl_email,
                $this->tl_tel,
                $this->tl_message,
                $this->tl_city,
                $this->tl_city_area,
                $this->tl_address,
                $this->tl_create_time,
                $this->tl_modtfy_time
            );

            $this->db->srv_query($sql,$data);
            return $this->db->insertID();
        } else {
            $sql = "UPDATE [dbo].[TransactionList]
            SET [tl_receipt] = ?, 
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