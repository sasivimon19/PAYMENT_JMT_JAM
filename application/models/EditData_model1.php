<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class EditData_model extends CI_Model {
 
        public function __construct(){
            parent:: __construct();
            $this->load->database();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_data_withDate($date){
            $query = "SELECT * FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
                      WHERE MONTH_YEAR = '$date'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function select_data_withPort($port){
            $query = "SELECT * FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
                      WHERE Port = '$port'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////


        public function select_data_withDateAndPort($date, $port){
            $query = "SELECT * FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
                      WHERE MONTH_YEAR = '$date' and Port = '$port'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function edit_data($port ,$cash, $date){
           $query="UPDATE [EASYBUY].[dbo].[tbl_CashFlowUn]
                SET  CashFlow = '$cash' 
                WHERE Port = '$port' and  MONTH_YEAR = '$date'";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function Log_Update($port, $date, $cash_before, $cash_after, $id, $name,$log_event){
            $query="INSERT INTO [EASYBUY].[dbo].[TMPLogUpdateCashFlow] 
                    (Port, MONTH_YEAR, Cash_Before, Cash_After, Date_Update, IDEmp, NameEmp, Log_Event) 
                    VALUES ('$port', '$date', '$cash_before', '$cash_after', GETDATE(), '$id', '$name', '$log_event')";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function delete_data($port, $date) {
           $query = "DELETE FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
                    WHERE Port = '$port' and MONTH_YEAR = '$date'";
            return $this->db->query($query);
            
        }
    }
?>