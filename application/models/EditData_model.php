<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class EditData_model extends CI_Model {
 
        public function __construct(){
            parent:: __construct();
            $this->load->database();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_data_withDate($date){
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                      WHERE MONTH_YEAR = '$date' AND Type = 'Collection'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function select_data_withPort($port){
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                      WHERE Port = '$port' AND Type = 'Collection'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////


        public function select_data_withDateAndPort($date, $port){
            $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                      WHERE MONTH_YEAR = '$date' and Port = '$port' AND Type = 'Collection'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        
        
        
        //////////////////////////////////////////////////////////////////////////////////

        public function edit_data($port ,$cash, $date, $transferFee, $courtFee, $revoke){
           $query="UPDATE [EASYBUY].[dbo].[tbl_CashFlowUn]
                SET  CashFlow = '$cash' , TransferFee = '$transferFee', CourtFee = '$courtFee', RevokeCustomer = '$revoke'
                WHERE Port = '$port' and  MONTH_YEAR = '$date'";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function Log_Update($port, 
                                   $date, 
                                   $cash_before, 
                                   $cash_after, 
                                   $revoke_before, 
                                   $revoke_after, 
                                   $courtFee_before, 
                                   $courtFee_after, 
                                   $transferFee_before, 
                                   $transferFee_after, 
                                   $id, 
                                   $name,
                                   $log_event){

            $query="INSERT INTO [JMTLOAN_PROD-Restore].[dbo].[TBL_TMPLogUpdateCashFlow]  
                    (Port, 
                    MONTH_YEAR, 
                    Cash_Before, 
                    Cash_After, 
                    RevokeCustomer_Before, 
                    RevokeCustomer_After, 
                    CourtFee_Before, 
                    CourtFee_After, 
                    TransferFee_Before, 
                    TransferFee_After,  
                    Date_Update, 
                    IDEmp, 
                    NameEmp, 
                    Log_Event)

                    VALUES ('$port', 
                            '$date', 
                            '$cash_before', 
                            '$cash_after', 
                            '$revoke_before', 
                            '$revoke_after', 
                            '$courtFee_before', 
                            '$courtFee_after',
                            '$transferFee_before',
                            '$transferFee_after', 
                            GETDATE(),
                            '$id',
                            '$name',
                            '$log_event')";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function delete_data($port, $date) {
           $query = "DELETE FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                    WHERE Port = '$port' and MONTH_YEAR = '$date'";
            return $this->db->query($query);
            
        }
        
        public function getDataCanEdit($date_start, $date_end) {
        $query = "SELECT Port,MONTH_YEAR
                      FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                      WHERE Date_Update >= '$date_start' and Date_Update <= '$date_end'
                      GROUP BY MONTH_YEAR, Port
                      ORDER By Port";
        return $this->db->query($query)->result();
    }

    public function select_cash($port, $date) {
        $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn]
                      WHERE MONTH_YEAR = '$date' and Port = '$port'
                      ORDER BY Port";
        return $this->db->query($query)->result();
    }

}

?>