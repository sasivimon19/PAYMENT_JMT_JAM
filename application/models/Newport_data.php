<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newport_data extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function insert_data_newport($T,$datanewport, $username, $NetCost)
    {
        $query = "INSERT INTO [$T].[dbo].[tbl_Tmp_CashFlowUn_2]
                     ([Port],[Mob],[MONTH_YEAR],[CashFlow],Name_Import,NetCost,[StatusPort]) 
                     VALUES ('$datanewport[Port]','$datanewport[Mob]', '$datanewport[MONTH_YEAR]',
                     '$datanewport[CashFlow]','$username','$NetCost','0')";

        return $this->db->query($query);
    }

    public function Delete_newport($username, $StatusPort)
    {
        $query = "DELETE FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
                  WHERE Name_Import = '$username' AND [StatusPort] = '$StatusPort'";

        return $this->db->query($query);
    }

    public function  Update_Tmp_CashFlowUn($Port, $username, $StatusPort)
    {
        $query = "UPDATE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] 
                  SET [StatusPort] = '$StatusPort' 
                  WHERE  Name_Import = '$username' AND Port = '$Port' AND  StatusPort = '0'";

        return $this->db->query($query);
    }


    public function  UpdateTmpCashFlowUnApp($StatusPort, $Port, $username)
    {
         $query = "UPDATE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] 
                  SET [StatusPort] = '$StatusPort',Name_Import = '$username' 
                  WHERE  Port = '$Port' AND  StatusPort = 'Request'";

        return $this->db->query($query);
    }

    public function  Update_LogApprae($StatusPort, $username, $ID_Logapprae, $Port, $remark)
    {
         $query = "UPDATE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]
                  SET [Status_Log] = '$StatusPort' ,[NameApprae] = '$username' ,[DateApprae] = GETDATE() , [remark] = '$remark'
                  WHERE  [ID_Logapprae] = '$ID_Logapprae' AND Port = '$Port'  AND  [Status_Log] = 'Request'";

        return $this->db->query($query);
    }

    public function  Update_LogApprae_true($StatusPort, $username, $ID_Logapprae, $Port)
    {
        $query = "UPDATE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]
                  SET [Status_Log] = '$StatusPort' ,[NameApprae] = '$username' ,[DateApprae] = GETDATE()
                  WHERE  [ID_Logapprae] = '$ID_Logapprae' AND Port = '$Port'  AND  [Status_Log] = 'Request'";

        return $this->db->query($query);
    }


    public function Get_LogApprae($port)
    {
        $query = "SELECT [ID_Logapprae],[Port],[Mob],[DateStart],[Cost],[Typeport] ,[nol] ,[OriginOS] ,[Bcost]
                ,[EIR],[NumAcct] ,[Company] ,[Status_Log],[Date_Log] ,[Namesave] ,[NameApprae] ,[DateApprae],[remark]
                FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]  where Port = '$port'";

        return $this->db->query($query)->result();
    }

    // public function Get_LogApprae($port)
    // {
    //     $query = "SELECT A.*,B.* FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]  A inner join  
    //             [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2] B ON A.Port = B.Port  where  A.Port = '$port'";

    //     return $this->db->query($query)->result();
    // }


    // public function Get_LogAppraeclick($port, $Logapprae)
    // {
    //     $query = "SELECT A.*,B.* FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]  A inner join  
    //             [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2] B ON A.Port = B.Port  where  A.Port = '$port'
    //              AND A.[ID_Logapprae] = '$Logapprae'";

    //     return $this->db->query($query)->result();
    // }

    public function Get_LogAppraeclick($port, $Logapprae)
    {
        $query = "SELECT [ID_Logapprae],[Port],[Mob],[DateStart],[Cost],[Typeport] ,[nol] ,[OriginOS] ,[Bcost]
                ,[EIR],[NumAcct] ,[Company] ,[Status_Log],[Date_Log]  ,[Namesave] ,[NameApprae] ,[DateApprae],[remark]
                FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]  where Port = '$port'
                 AND [ID_Logapprae] = '$Logapprae' ";

        return $this->db->query($query)->result();
    }

    public function Update_data_newport($error_port, $Port)
    {
        $query = "UPDATE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
               SET [Status_error_port] = '$error_port'
        WHERE Port = '$Port'";

        return $this->db->query($query);
    }


    public function CountTrue_Tmpnewport($port)
    {
        $query = "SELECT COUNT(Port) AS Porttmpapprae FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
        where Port = '$port'";

        return $this->db->query($query)->result();
    }

    // public function check_newport($Port, $StatusPort)
    // {
    //     $query = "SELECT * FROM  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] where Port = '$Port' AND [StatusPort] = '$StatusPort' ORDER BY Mob ASC";

    //     return $this->db->query($query)->result();
    // }

    public function check_newport($Port)
    {
        $query = "SELECT * FROM  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] where Port = '$Port' ORDER BY Mob ASC";

        return $this->db->query($query)->result();
    }

    public function CountTmp_newport($Port)
    {
        $query = "SELECT COUNT(Port) AS Countport FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] where Port = '$Port'";

        return $this->db->query($query)->result();
    }

    public function CountTrue_newport($port)
    {
        $query = "SELECT COUNT(Port) AS Countport FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn_2] 
        where Port = '$port'";

        return $this->db->query($query)->result();
    }

    public function CountTrueTmpnewport($port)
    {
        $query = "SELECT COUNT(Port) AS Countport FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
        where Port = '$port'";

        return $this->db->query($query)->result();
    }

    public function check_newportAll($Port, $username)
    {
        $query = "SELECT * FROM  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
         where Port = '$Port' AND Name_Import = '$username' ORDER BY Mob ASC";

        return $this->db->query($query)->result();
    }

    public function select_data_newport($username, $StatusPort)
    {
        $query = "SELECT * FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
         where Name_Import = '$username' AND StatusPort = '$StatusPort'";

        return $this->db->query($query)->result();
    }

    public function select_data_newpor_getport($StatusPort, $port)
    {
        $query = "SELECT * FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
         where  StatusPort = '$StatusPort' AND Port = '$port'";

        return $this->db->query($query)->result();
    }


    public function select_data_TypePort()
    {
        $query = "SELECT TypePort  FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2] GROUP BY TypePort";

        return $this->db->query($query)->result();
    }

    public function select_data_Cost()
    {
        $query = "SELECT [ID_Cost],[Cost],[Status_Cost]
                FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[Tbl_Cost] where Status_Cost = 'On'";
        return $this->db->query($query)->result();
    }

    // public function select_sum_newport($port, $StatusPort)
    // {
    //     $query = "SELECT [Port] as topport
    //         ,(select top 1 MONTH_YEAR FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] ORDER BY MONTH_YEAR ASC ) AS TopMONTH_YEAR
    //         ,COUNT([Mob]) AS CountMob
    //         ,SUM(NetCost) AS  SumNetCost 
    //     FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] where Port = '$port'  AND [StatusPort] = '$StatusPort' GROUP BY Port";

    //     return $this->db->query($query)->result();
    // }

    public function select_sum_newport($port)
    {
        $query = "SELECT [Port] as topport
            ,(select top 1 MONTH_YEAR FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] ORDER BY MONTH_YEAR ASC ) AS TopMONTH_YEAR
            ,COUNT([Mob]) AS CountMob
            ,SUM(NetCost) AS  SumNetCost 
        FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2] where Port = '$port' GROUP BY Port";

        return $this->db->query($query)->result();
    }

    // บันทึกลงฐานจริง ตาราง [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn_2]
    public function insertnewporttrue($selectnewport)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn_2]
                     ([Port],[Mob],[MONTH_YEAR],[CashFlow],[CashFlowIFRS]) 
                     VALUES ('$selectnewport[Port]','$selectnewport[Mob]',
                      '$selectnewport[MONTH_YEAR]','$selectnewport[CashFlow]','$selectnewport[CashFlowIFRS]')";

        return $this->db->query($query);
    }

    // บันทึกลงฐานจริง ตาราง [JMTLOAN_PROD-Restore].[dbo].[tbl_CashFlowUn_2]
    public function insert_Postun_get($Postun_get, $nol)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2]
                     ([Port],[TypePort],[nol],[DateStart],[Bcost],[EIR],[Company],[OriginOS],[NumAcct]) 
                     VALUES ('$Postun_get[NEWPORT]','$Postun_get[TypePort]','$nol',
                     '$Postun_get[DateStart]','$Postun_get[Bcost]','$Postun_get[EIR]'
                     ,'$Postun_get[Company]','$Postun_get[OriginOS]','$Postun_get[NumAcct]')";

        return $this->db->query($query);
    }

    //insert logapprae เพื่อรอ อนุมัติ
    public function Insert_LogApprae($Logapprae_get, $username)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]
                     ([Port],[Mob],[DateStart],[Cost],[Typeport],[OriginOS],[Bcost],[EIR],[NumAcct]
                    ,[Company],[Status_Log],[Date_Log],[Namesave]) 
                     VALUES ('$Logapprae_get[NEWPORT]','$Logapprae_get[Mob]','$Logapprae_get[DateStart]'
                     ,'$Logapprae_get[COST]','$Logapprae_get[TypePort]','$Logapprae_get[OriginOS]'
                     ,'$Logapprae_get[Bcost]','$Logapprae_get[EIR]','$Logapprae_get[NumAcct]'
                     ,'$Logapprae_get[Company]','Request',GETDATE(),'$username')";

        return $this->db->query($query);
    }


    // บันทึกลงฐานจริง ตาราง [JMTLOAN_PROD-Restore].[dbo].[tbIRR_2]
    public function insert_newport_true_tbIRR_2($selectnewport)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbIRR_2]
                     ([Port],[Mob],[MONTH_YEAR]) 
                     VALUES ('$selectnewport[Port]','$selectnewport[Mob]',
                      '$selectnewport[MONTH_YEAR]')";

        return $this->db->query($query);
    }


    public function CountTrue_newport_tbIRR($port)
    {
        $query = "SELECT COUNT(Port) AS Countport_tbIRR_2 FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbIRR_2] 
        where Port = '$port'";

        return $this->db->query($query)->result();
    }


    public function CountTrue_newport_tbl_PortUn($port)
    {
        $query = "SELECT COUNT(Port) AS Countport_tbporun FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2]
        where Port = '$port'";

        return $this->db->query($query)->result();
    }


    // บันทึกลงฐานจริง add เอง
    public function insert_newport_Add($arr, $username)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
                     ([Port],[Mob],[MONTH_YEAR],[CashFlow],Name_Import) 
                     VALUES ('$arr[Port]','$arr[MOB]',
                      '$arr[MONTH]','0','$username')";

        return $this->db->query($query);
    }

    public function Select_maxnol($TypePort)
    {
        $query = "select max(nol) AS MAXNOT FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_PortUn_2]  
        where TypePort = '$TypePort' group by [TypePort]";

        return $this->db->query($query)->result();
    }

    // คำนวน EIR
    public function Cal_Eir($Port, $Bcost)
    {
        $query = "EXEC [dbo].[EIR_Code_Cal_EIR] '$Port',$Bcost";

        return $this->db->query($query)->result();
    }



    public function select_logapprae($T,$username)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_LogApprae] where Namesave = '$username' ORDER BY [Date_Log] ASC";

        return $this->db->query($query)->result();
    }

    public function select_logappraeclick($username, $Logapprae)
    {
        $query = "SELECT * FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae] where Namesave = '$username' AND [ID_Logapprae] = '$Logapprae' ORDER BY [Date_Log] ASC";

        return $this->db->query($query)->result();
    }

    public function select_Apprae($T)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_LogApprae] where Status_Log = 'Request' ORDER BY [Date_Log] ASC";

        return $this->db->query($query)->result();
    }

    public function CountTmp_logapprae($Port)
    {
        $query = "SELECT COUNT(Port) AS Portapprae FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae] where Port = '$Port'";

        return $this->db->query($query)->result();
    }

    public function Delete_logapprae($Logapprae, $Port, $username)
    {
        $query = "DELETE  [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[TBL_LogApprae]
                 WHERE ID_Logapprae = '$Logapprae' AND Port = '$Port' AND [Namesave] = '$username'";

        return $this->db->query($query);
    }

    public function Delete_Tmp_CashFlowUn($Port, $username)
    {
        $query = "DELETE [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[tbl_Tmp_CashFlowUn_2]
                 WHERE [Port] = '$Port' AND [Name_Import] = '$username'";

        return $this->db->query($query);
    }
}
