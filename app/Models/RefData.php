<?php 
namespace App\Models;
use CodeIgniter\Model;

class RefData extends Model { 
    protected $table = 'RefData';
    protected $db ;


      //初始連線
    function __construct() {
        $this->db = db_connect();
        $this->db->connect();
    }

    public function getCity() {
        $sql = "SELECT [city_code],[city_parent_code],[city_name] FROM [Assistance].[dbo].[ref_city] WHERE city_code = city_parent_code";
        $this->db->srv_query($sql,array());
        $data = $this->db->fetchAll();
        return $data;
    }

    public function getCityArea() {
        $sql = "SELECT [city_code],[city_parent_code],[city_name] FROM [Assistance].[dbo].[ref_city] WHERE city_code <> city_parent_code";
        $this->db->srv_query($sql,array());
        $data = $this->db->fetchAll();
        return $data;
    }

}