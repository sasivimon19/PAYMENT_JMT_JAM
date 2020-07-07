<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class ShowLog_model extends CI_Model {
 
        public function __construct(){
            parent:: __construct();
            $this->load->database();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
//        public function select_log(){
//            $query = "SELECT * FROM [EASYBUY].[dbo].[TMPLogUpdateCashFlow]
//                      ORDER BY Date_Update DESC";
//            return $this->db->query($query)->result();
//        }
        
     public function select_log() {
        $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY Date_Update DESC) AS row,
                [Port] , [MONTH_YEAR], [Cash_Before], [Cash_After] , [Date_Update] , [IDEmp], [NameEmp], [Log_Event]
                FROM  [EASYBUY].[dbo].[TMPLogUpdateCashFlow] ) A";
        return $this->db->query($query)->result();
    }
    
    
       public function select_log_Count() {
        $query = "SELECT COUNT(Port)AS Count  FROM  [EASYBUY].[dbo].[TMPLogUpdateCashFlow]";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

        
    }
?>