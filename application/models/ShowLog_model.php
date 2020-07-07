<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ShowLog_model extends CI_Model {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_log() {
        $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
                      ORDER BY Date_Update DESC";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////
//    public function select_log() {
//        $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
//                      ORDER BY Date_Update DESC";
//        return $this->db->query($query)->result();
//    }
        public function search_log($date) {
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
                      WHERE Date_Update >= '$date.T00:00:00.000' AND 
                      Date_Update <= '$date.T23:59:59.999'
                      ORDER BY Date_Update desc";
            return $this->db->query($query)->result();

        }
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_Log_withDate($date_start,$date_end){
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
                      WHERE Date_Update >= '$date_start' AND 
                      Date_Update <= '$date_end'
                      ORDER BY Date_Update desc";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function select_Log_withPort($port){
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
                      WHERE Port = '$port'
                      ORDER BY Date_Update desc";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////


        public function select_Log_withDateAndPort($date_start, $date_end, $port) {
        $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]
                      WHERE (Date_Update >= '$date_start' AND 
                      Date_Update <= '$date_end') AND Port = '$port'
                      ORDER BY Port";
        return $this->db->query($query)->result();
        
    }

}
    
?>