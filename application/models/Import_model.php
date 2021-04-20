<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_port($T,$port)
    {
        $query = "SELECT count(*) as count_port FROM [$T].[dbo].[tbl_PortUn_2] WHERE Port = '$port' ";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    // public function check_port_sum()
    // {
    //     $query = "SELECT  Port 
    //                 ,(select ROW_NUMBER() OVER (ORDER BY Port)
    //                     from [JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] 
    //                     where Port = a.Port group by Port) as 'ColCnt'
    //                 ,[Mont_Year]
    //                 ,Sum(CashReceive) as CashReceive
    //                 ,SUM(TransferFee) as TransferFee
    //                 ,SUM(RevokeCustomer) as RevokeCustomer
    //                 ,SUM(CourtFee) as CourtFee
    //                 ,Sum([Adjust]) as Adjust
    //                 ,Sum([Commission]) as Commission
    //         FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
    //         group by Port 
    //                  ,a.Port
    //                 ,[Mont_Year]";

    //     return $this->db->query($query)->result();
    // }

    //////////////////////////////////////////////////////////////////////////////////

    public function count_port($T, $username)
    {
        $query = "SELECT Port FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Name_Import = '$username'
            ORDER BY Port";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function insert_data_true($T, $port, $mob, $cash, $date, $revoke, $courtFee, $transferFee)
    {
        $query = "INSERT INTO [$T].[dbo].[tbl_CashFlowUn_2] 
                    (Port, Mob, MONTH_YEAR, CashFlowIFRS, CashFlow, TransferFee, CourtFee, RevokeCustomer,NPV,ProvisionOnMonth,ProvisionCumulative) 
                    VALUES ('$port', '$mob', '$date', '0', '$cash', '$transferFee', '$courtFee', '$revoke', '0', '0','0')";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////
    // public function remove_error($num, $port, $error, $name)
    // {
    //     $query = "UPDATE [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST]
    //         SET Error = '$error' 
    //         WHERE Number = '$num' and Port = '$port' and  Name_Import = '$name'";
    //     return $this->db->query($query);
    // }

    public function remove_error($T, $port, $error, $username)
    {
        $query = "UPDATE [$T].[dbo].[TBL_TMP_EIR_TEST]
            SET Error = '$error' 
            WHERE Port = '$port' and  Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_remove_error($T, $port, $Number, $username)
    {
        $query = "SELECT Error,Number,Port
            FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$username' and Number <> '$Number'";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_edit_remove_error($T, $number, $username)
    {
        $query = "SELECT Port FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Number = '$number' and Name_Import = '$username'";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function check_error($T)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_TMP_EIR_TEST] WHERE Error <> ''";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    // public function insert_data($number, $port, $cash, $revoke, $courtFee, $transferFee, $error, $name)
    // {
    //     $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] 
    //                  (Number, Port, CashReceive, RevokeCustomer, CourtFee, TransferFee, Error, Name_Import) 
    //                  VALUES ('$number', '$port', '$cash', '$revoke', '$courtFee', '$transferFee', '$error', '$name')";
    //     return $this->db->query($query);
    // }


    public function insert_data(
        $T,
        $number,
        $PortNameAccounting,
        $port,
        $Mont_Year,
        $revoke,
        $courtFee,
        $transferFee,
        $cash,
        $Adjust,
        $Commission,
        $NetCashReceive,
        $StatusPort,
        $error,
        $username
    ) {
        $query = "INSERT INTO [$T].[dbo].[TBL_TMP_EIR_TEST] 
                     (Number,PortNameAccounting,Port,Mont_Year,RevokeCustomer,CourtFee,TransferFee,
                     CashReceive,Adjust,Commission,NetCashReceive,StatusPort,Error, Name_Import) 
                     VALUES ('$number','$PortNameAccounting', '$port','$Mont_Year', '$revoke', 
                     '$courtFee', '$transferFee', '$cash','$Adjust','$Commission','$NetCashReceive'
                     ,'$StatusPort', '$error', '$username')";
        return $this->db->query($query);
    }



    //////////////////////////////////////////////////////////////////////////////////

    public function select_data($T, $username)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
                      WHERE Name_Import = '$username' ORDER BY Port";
        return $this->db->query($query)->result();
    }

    public function selectdatatrue($T, $username)
    {
        $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY Port DESC)  AS Number, 
                    a.Port 
                    ,Mont_Year
                    ,SUM(TransferFee) as TransferFee
                    ,SUM(CourtFee) as CourtFee
                    ,SUM(RevokeCustomer) as RevokeCustomer
                    ,Sum(CashReceive) as CashReceive 
                    ,Sum(Adjust) as Adjust
                    ,Sum(Commission) as Commission
                    ,Sum(NetCashReceive) as NetCashReceive
                    ,Date_Import
                    ,StatusPort
                ,(select ROW_NUMBER() OVER (ORDER BY Port)
                    from [$T].[dbo].[TBL_TMP_EIR_TEST] 
                    where Port = a.Port group by Port) as 'ColCnt'
                    ,Error
                 FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
                 WHERE Name_Import = '$username'  group by Port 
                ,a.Port
                ,a.Mont_Year
                ,Date_Import
                ,StatusPort
                ,Error ) AA";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_data_true($T, $username)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
                      WHERE Error = ''and Name_Import = '$username'    ORDER BY Port";

        return $this->db->query($query)->result();
    }


    // public function select_data_true($username)
    // {
    //     $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY Port DESC)  AS Number, 
    //                 a.Port 
    //                 ,Mont_Year
    //                 ,SUM(TransferFee) as TransferFee
    //                 ,SUM(CourtFee) as CourtFee
    //                 ,SUM(RevokeCustomer) as RevokeCustomer
    //                 ,Sum(CashReceive) as CashReceive 
    //                 ,Sum(Adjust) as Adjust
    //                 ,Sum(Commission) as Commission
    //                 ,Sum(NetCashReceive) as NetCashReceive
    //                 ,Date_Import
    //                 ,StatusPort
    //             ,(select ROW_NUMBER() OVER (ORDER BY Port)
    //                 from [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] 
    //                 where Port = a.Port group by Port) as 'ColCnt'
    //                 ,Error
    //             FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
    //             WHERE Error = ''and Name_Import = '$username'  group by Port 
    //             ,a.Port
    //             ,a.Mont_Year
    //             ,Date_Import
    //             ,StatusPort
    //             ,Error ) AA";

    //     return $this->db->query($query)->result();
    // }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_data_false($T, $username)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
                      WHERE Error <> '' and Name_Import = '$username'
                      ORDER BY Port";
        return $this->db->query($query)->result();
    }

    // public function select_data_false($username)
    // {
    //     $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY Port DESC)  AS Number, 
    //                 a.Port 
    //                 ,Mont_Year
    //                 ,SUM(TransferFee) as TransferFee
    //                 ,SUM(CourtFee) as CourtFee
    //                 ,SUM(RevokeCustomer) as RevokeCustomer
    //                 ,Sum(CashReceive) as CashReceive 
    //                 ,Sum(Adjust) as Adjust
    //                 ,Sum(Commission) as Commission
    //                 ,Sum(NetCashReceive) as NetCashReceive
    //                 ,Date_Import
    //                 ,StatusPort
    //             ,(select ROW_NUMBER() OVER (ORDER BY Port)
    //                 from [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] 
    //                 where Port = a.Port group by Port) as 'ColCnt'
    //                 ,Error
    //              FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
    //             WHERE Error <> ''and Name_Import = '$username'  group by Port 
    //             ,a.Port
    //             ,a.Mont_Year
    //             ,Date_Import
    //             ,StatusPort
    //             ,Error ) AA";
        // $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY Port DESC)  AS Number, 
        //         a.Port 
        //     ,(select ROW_NUMBER() OVER (ORDER BY Port)
        //         from [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] 
        //         where Port = a.Port group by Port) as 'ColCnt'
        //     ,Mont_Year
        //     ,Error
        //     ,Date_Import
        //     ,Sum(CashReceive) as CashReceive
        //     ,SUM(TransferFee) as TransferFee
        //     ,SUM(RevokeCustomer) as RevokeCustomer
        //     ,SUM(CourtFee) as CourtFee 
        //     ,Sum([Adjust]) as Adjust
        //     ,Sum([Commission]) as Commission
        //         FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
        //         WHERE Error <> ''and Name_Import = '$name'  group by Port 
        //     ,a.Port
        //     ,a.Mont_Year
        //     ,Error
        //     ,Date_Import) AA";
    //     return $this->db->query($query)->result();
    // }

    //////////////////////////////////////////////////////////////////////////////////

    public function clear_data($T, $username)
    {
        $query = "DELETE FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function edit_data($T,$number, $port, $cash, $revoke, $courtFee, $transferFee, $Adjust,$Commission,$NetCashReceive, $error, $username)
    {
        $query = "UPDATE [$T].[dbo].[TBL_TMP_EIR_TEST]
                SET  Port = '$port', CashReceive = '$cash', RevokeCustomer = '$revoke',
                CourtFee = '$courtFee', TransferFee = '$transferFee',  Adjust = '$Adjust',
                 Commission = '$Commission',  NetCashReceive = '$NetCashReceive',Error = '$error' 
                WHERE Number = '$number' and  Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function import_data_true($T,$port, $cash, $date, $revoke, $courtFee, $transferFee, $Adjust, $Commission, $NetCashReceive, $StatusPort, $CashFlow)
    {
        $query = "UPDATE [$T].[dbo].[tbl_CashFlowUn_2] 
                      SET CashReceive = '$cash', TransferFee = '$transferFee', CourtFee = '$courtFee', RevokeCustomer = '$revoke'
                      ,MONTH_YEAR = '$date', Adjust = '$Adjust',Commission = '$Commission',NetCashReceive = '$NetCashReceive'
                      ,StatusPort = '$StatusPort',CashFlow = '$CashFlow'
                      WHERE Port = '$port' AND MONTH_YEAR =  CONVERT(date, '$date')
                      
                      
                      
                      ";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function set_date($T,$date, $username)
    {
        $query = "UPDATE [$T].[dbo].[TBL_TMP_EIR_TEST]
                SET Date_Import = '$date'
                WHERE Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function delete_data($T,$port, $username)
    {
        echo $query = "DELETE FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE port = '$port' AND Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_port($T)
    {
        $query = "SELECT Port FROM [$T].[dbo].[tbl_PortUn_2] ORDER BY Port";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function check_port_in_cashflow($T,$port, $date)
    {
        $query = "SELECT count(*) as count_data FROM [$T].[dbo].[tbl_CashFlowUn_2]
            WHERE MONTH_YEAR = '$date' AND Port = '$port'";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function import_data_false($T,$port, $cash, $date, $error, $username)
    {
        $query = "INSERT INTO [$T].[dbo].[TBL_TMP_EIR_ERROR] 
                     (Port, Cash, Date_Import, Error, Name_Import) 
                     VALUES ('$port','$cash', '$date','$error','$username')";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function select_cash($T,$port, $date)
    {
        $query = "SELECT CashFlow,TransferFee, CourtFee, RevokeCustomer,Adjust,Commission 
        FROM [$T].[dbo].[tbl_CashFlowUn_2]
        WHERE Port = '$port' AND MONTH_YEAR = '$date'";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    // public function select_import_false($name)
    // {
    //     $query = "SELECT * FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_ERROR]
    //                   WHERE Name_Import = '$name' ORDER BY Port";
    //     return $this->db->query($query)->result();
    // }

    public function select_import_false($T,$username)
    {
        $query = "SELECT  [Port],(select ROW_NUMBER() OVER (ORDER BY Port)
                    from [$T].[dbo].[TBL_TMP_EIR_TEST] 
                    where Port = a.Port group by Port) as 'ColCnt'
                    ,Sum(Recently_Cash) as Recently_Cash
                    ,Recently_Updated
                    ,Name_Import
                    ,[Date_Import]
					,[Error]
                    FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
                    WHERE Name_Import = '$username' AND Error <> '' 
                    group by Port,Recently_Updated,Name_Import,[Date_Import],[Error] ORDER BY Port";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function delete_import_false($T,$username)
    {
        $query = "DELETE FROM [$T].[dbo].[TBL_TMP_EIR_ERROR]
                      WHERE Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function check_recently_updated($T,$date_start, $date_end, $port, $date)
    {
        $query = "SELECT TOP 1 [Cash_After],[Date_Update] FROM [$T].[dbo].[TBL_TMPLogUpdateCashFlow]
                      WHERE (Date_Update between '$date_start' and '$date_end') and 
                      (Log_Event = 'Import' or Log_Event = 'ADD') and 
                      (Port = '$port') and 
                      (MONTH_YEAR = '$date') 
                      ORDER BY Date_Update DESC";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function insert_recently_updated($T,$port, $date, $username, $recently_cash, $recently_updated)
    {
        $query = "UPDATE [$T].[dbo].[TBL_TMP_EIR_TEST]
                SET Recently_Cash = '$recently_cash', Recently_Updated = '$recently_updated'
                WHERE Port = '$port' and Date_Import = '$date' and Name_Import = '$username'";
        return $this->db->query($query);
    }

    //////////////////////////////////////////////////////////////////////////////////

    // public function select_recently_updated($name)
    // {
    //     $query = "SELECT [Port],[Recently_Cash],[Recently_Updated]  FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST]
    //                   WHERE Recently_Cash <> '' and Recently_Updated <> '' and Name_Import = '$name'
    //                   ORDER BY Port ";
    //     return $this->db->query($query)->result();
    // }


    //////////////////////////////////////////////////////////////////////////////////
    public function select_recently_updated($T,$username)
    {
         $query = "SELECT  [Port],(select ROW_NUMBER() OVER (ORDER BY Port)
                    from [$T].[dbo].[TBL_TMP_EIR_TEST] 
                    where Port = a.Port group by Port) as 'ColCnt'
                    ,Sum(Recently_Cash) as Recently_Cash
                    ,Recently_Updated
                    ,Name_Import
                    ,[Date_Import]
					,[Error]
                    FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_TMP_EIR_TEST] a
                    WHERE Recently_Cash <> '' and Recently_Updated <> '' and Name_Import = '$username'
                    group by Port,Recently_Updated,Name_Import,[Date_Import],[Error] ORDER BY Port";
        return $this->db->query($query)->result();
    }

    //////////////////////////////////////////////////////////////////////////////////

    public function delete_import_error($T,$port, $username)
    {
        $query = "DELETE FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$username'";
        return $this->db->query($query);
    }

    public function delete_import_recently($T,$port, $username)
    {
        $query = "DELETE FROM [$T].[dbo].[TBL_TMP_EIR_TEST]
            WHERE Port = '$port' and Name_Import = '$username'";
        return $this->db->query($query);
    }

    public function count_port_error($T,$port, $date)
    {
        $query = "SELECT COUNT(Port) as CP
            FROM [$T].[dbo].[TBL_TMP_EIR_ERROR]
            WHERE Port = '$port' and Date_Import = '$date'";
        return $this->db->query($query)->result();
    }
}
