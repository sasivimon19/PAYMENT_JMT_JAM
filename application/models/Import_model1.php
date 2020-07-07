<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Import_model extends CI_Model {
 
        public function __construct(){
            parent:: __construct();
            $this->load->database();
        }
        
        public function check_port($port) {
            $query = "SELECT count(*) as count_port FROM [EASYBUY].[dbo].[tbl_PortUn] WHERE Port = '$port' ";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function count_port($name) {
            $query = "SELECT Port
            FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Name_Import = '$name'
            ORDER BY Port";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////
        
        public function insert_data_true($port, $mob, $cash, $date, $revoke, $courtFee, $transferFee){
            $query="INSERT INTO [EASYBUY].[dbo].[tbl_CashFlowUn] 
                    (Port, Mob, MONTH_YEAR, CashFlowIFRS, CashFlow, TransferFee, CourtFee, RevokeCustomer,NPV,ProvisionOnMonth,ProvisionCumulative) 
                    VALUES ('$port', '$mob', '$date', '0', '$cash', '$transferFee', '$courtFee', '$revoke', '0', '0','0')";
            return $this->db->query($query);

        }


        //////////////////////////////////////////////////////////////////////////////////
        public function remove_error($num, $port, $error, $name){
            $query = "UPDATE [EASYBUY].[dbo].[TMP_EIR_TEST]
            SET Error = '$error' 
            WHERE Number = '$num' and Port = '$port' and  Name_Import = '$name'";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function select_remove_error($port, $num, $name) {
            $query = "SELECT Error,Number,Port
            FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$name' and Number <> '$num'";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function select_edit_remove_error($number, $name) {
            $query = "SELECT Port
            FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Number = '$number' and Name_Import = '$name'";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function check_error(){
            $query = "SELECT * FROM [EASYBUY].[dbo].[TMP_EIR_TEST] WHERE Error <> ''";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////
        
        public function insert_data($number, $port, $cash, $revoke, $courtFee, $transferFee, $error, $name){
            $query="INSERT INTO [EASYBUY].[dbo].[TMP_EIR_TEST] 
                     (Number, Port, Cash, RevokeCustomer, CourtFee, TransferFee, Error, Name_Import) 
                     VALUES ('$number', '$port', '$cash', '$revoke', '$courtFee', '$transferFee', '$error', '$name')";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_data($name){
            $query = "SELECT * FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
                      WHERE Name_Import = '$name'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_data_true($name){
            $query = "SELECT * FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
                      WHERE Error = ''and Name_Import = '$name'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_data_false($name){
            $query = "SELECT * FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
                      WHERE Error <> '' and Name_Import = '$name'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function clear_data($name){
            $query="DELETE FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Name_Import = '$name'";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function edit_data($number, $port ,$cash, $error,$name){
            $query="UPDATE [EASYBUY].[dbo].[TMP_EIR_TEST]
                SET  Port = '$port', Cash = '$cash', Error = '$error' 
                WHERE Number = '$number' and  Name_Import = '$name'";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function import_data_true($port, $cash, $date, $revoke, $courtFee, $transferFee) {
            $query="UPDATE [EASYBUY].[dbo].[tbl_CashFlowUn] 
                      SET CashFlow = '$cash', TransferFee = '$transferFee', CourtFee = '$courtFee', RevokeCustomer = '$revoke'
                      WHERE Port = '$port' AND MONTH_YEAR = '$date'";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function set_date($date, $name) {
            $query="UPDATE [EASYBUY].[dbo].[TMP_EIR_TEST]
                SET Date_Import = '$date'
                WHERE Name_Import = '$name'";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function delete_data($num,$name) {
            $query = "DELETE FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Number = '$num' and Name_Import = '$name'";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////
        
        public function select_port() {
            $query = "SELECT Port FROM [EASYBUY].[dbo].[tbl_PortUn]
                      ORDER BY Port";
            return $this->db->query($query)->result();            
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function check_port_in_cashflow($port, $date){
            $query = "SELECT count(*) as count_data FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
            WHERE MONTH_YEAR = '$date' AND Port = '$port'";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function import_data_false($port, $cash, $date, $error, $name){
            $query="INSERT INTO [EASYBUY].[dbo].[TMP_EIR_ERROR] 
                     (Port, Cash, Date_Import, Error, Name_Import) 
                     VALUES ('$port','$cash', '$date','$error','$name')";
            return $this->db->query($query);
        }
        
        //////////////////////////////////////////////////////////////////////////////////

        public function select_cash($port, $date){
            $query = "SELECT CashFlow FROM [EASYBUY].[dbo].[tbl_CashFlowUn]
                      WHERE Port = '$port' AND MONTH_YEAR = '$date'";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function select_import_false($name) {
            $query = "SELECT * FROM [EASYBUY].[dbo].[TMP_EIR_ERROR]
                      WHERE Name_Import = '$name'
                      ORDER BY Port";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function delete_import_false($name) {
            $query = "DELETE FROM [EASYBUY].[dbo].[TMP_EIR_ERROR]
                      WHERE Name_Import = '$name'";
            return $this->db->query($query);

        }

        //////////////////////////////////////////////////////////////////////////////////

        public function check_recently_updated($date_start, $date_end, $port, $date ) {
            $query = "SELECT TOP 1 [Cash_After],[Date_Update] FROM [EASYBUY].[dbo].[TMPLogUpdateCashFlow]
                      WHERE (Date_Update between '$date_start' and '$date_end') and 
                      (Log_Event = 'Import' or Log_Event = 'ADD') and 
                      (Port = '$port') and 
                      (MONTH_YEAR = '$date') 
                      ORDER BY Date_Update DESC";
            return $this->db->query($query)->result();
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function insert_recently_updated($port, $date, $name, $recently_cash, $recently_updated) {
            $query="UPDATE [EASYBUY].[dbo].[TMP_EIR_TEST]
                SET Recently_Cash = '$recently_cash', Recently_Updated = '$recently_updated'
                WHERE Port = '$port' and Date_Import = '$date' and Name_Import = '$name'";
            return $this->db->query($query);
        }

        //////////////////////////////////////////////////////////////////////////////////

        public function select_recently_updated($name){
            $query = "SELECT [Port],[Recently_Cash],[Recently_Updated]  FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
                      WHERE Recently_Cash <> '' and Recently_Updated <> '' and Name_Import = '$name'
                      ORDER BY Port ";
            return $this->db->query($query)->result();
        }

        public function delete_import_error($port, $name){
            $query = "DELETE FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$name'";
            return $this->db->query($query);
        }
        
        public function delete_import_recently($port, $name){
            $query = "DELETE FROM [EASYBUY].[dbo].[TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$name'";
            return $this->db->query($query);
        }

        public function count_port_error($port , $date){
            $query = "SELECT COUNT(Port) as CP
            FROM [EASYBUY].[dbo].[TMP_EIR_ERROR]
            WHERE Port = '$port' and Date_Import = '$date'";
            return $this->db->query($query)->result();
        }

    }
?>