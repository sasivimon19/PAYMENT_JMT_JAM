
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class eir extends CI_Model {

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('eir');
        $this->load->model('Payment_model','PM');
        $this->load->database();
    }

    function all($start, $pageend) {

        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER (ORDER BY AutoIDEmp DESC)as row ,* from EASYBUY.dbo.TbEmployee)AA
            WHERE row > $start AND row <= $pageend  order by AutoIDEmp desc";

        return $this->db->query($query)->result();
    }

    function count_all() {
        $query = "SELECT COUNT(*)AS Count FROM(
        select ROW_NUMBER()OVER (ORDER BY AutoIDEmp DESC)as row ,* from EASYBUY.dbo.TbEmployee)AA";
        return $this->db->query($query)->result();
    }

    function delete($AutoIDEmp) {
        $query = "DELETE FROM [EASYBUY].[dbo].[TbEmployee] WHERE AutoIDEmp ='$AutoIDEmp'";
        return $this->db->query($query);
    }

    function export() {
        $query = "SELECT top 100 * FROM EASYBUY.dbo.TbEmployee";

        return $this->db->query($query)->result();
    }

    function exportbyid($AutoIDEmp) {
        $query = "SELECT * FROM EASYBUY.dbo.TbEmployee WHERE AutoIDEmp ='$AutoIDEmp'";

        return $this->db->query($query)->result();
    }

    //ข้อมูลของหน้าแรก
//    function all_eir($start, $pageend, $search)
//    {
//
//        $query = "SELECT * from(
//            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row, IR.*, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
//              FROM [tbl_PortUn] PU 
//              INNER JOIN tbIRR IR ON PU.Port = IR.Port
//              WHERE PU.Port Like '%%' and Type = 'Collection' $search 
//              group by PU.Port,IR.[Port]
//                  ,IR.[Mob]
//                  ,IR.[MONTH_YEAR]
//                  ,IR.[TransferFee] 
//                  ,IR.[CourtFee]
//                  ,IR.[RevokeCustomer]
//                  ,IR.[OS_Before_Provision]
//                  ,IR.[ProvisonOnMonth]
//                  ,IR.[OS_NetProvision]
//                  ,IR.[CashReceive]
//                  ,IR.[Receive]
//                  ,IR.[Cash_Balance]
//                  ,IR.[Interest]
//                  ,IR.[Cumulative_Interest]
//                  ,IR.[Cut_InterestOnMonth]
//                  ,IR.[Interest_BalanceOnMonth]
//                  ,IR.[Cut_OSDebt]
//                  ,IR.[Revert_ProvisionOnMonth]
//                  ,IR.[Revert_ProvisionOld]
//                  ,IR.[Rec100]
//                  ,IR.[OS_BalanceNPV]
//                  ,IR.[OS_BalanceInterestLast]
//                  ,IR.[NPV]
//                  ,IR.[PV_BalanceOnMonth]
//                  ,IR.[PV_NetMonth]
//                  ,IR.[ProvisionCumulative]
//                  ,IR.Type
//                  ,IR.[ProvisionOld_Balance]
//                  ,IR.[Total_Provision_Balance]
//              ,PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort)AA
//            
//            where row > $start AND row <=$pageend order by row";
//
//        return $this->db->query($query)->result();
//    }

    function all_eir($start, $pageend, $search) {

        $query = "SELECT * from(
            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row,IR.[Port],IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
		  ,round(CF.CashFlowIFRS,2) AS CashFlowIFRS
                  ,IR.[CashReceive]
                  ,IR.[Receive]
                  ,IR.[Cash_Balance]
                  ,IR.[Interest]
                  ,IR.[Cumulative_Interest]
                  ,IR.[Cut_InterestOnMonth]
                  ,IR.[Interest_BalanceOnMonth]
                  ,IR.[Cut_OSDebt]
                  ,IR.[Rec100]
                  ,IR.[OS_BalanceNPV]
                  ,IR.[OS_BalanceInterestLast]
                  ,IR.[NPV]
                  ,IR.[PV_BalanceOnMonth]
                  ,IR.[PV_NetMonth]
                  ,IR.[ProvisionCumulative]
                  ,IR.ProvisionOld_Balance
		  ,IR.Total_Provision_Balance
		  ,IR.Revert_ProvisionOnMonth
		  ,IR.Revert_ProvisionOld
		  ,IR.PV_Old, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
                   FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] PU 
                   INNER JOIN [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] IR ON PU.Port = IR.Port
                   INNER JOIN [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] CF ON IR.Port = CF.Port AND IR.MONTH_YEAR = CF.MONTH_YEAR
                   WHERE PU.Port Like '%%' $search 
                   group by PU.Port,IR.[Port]
                  ,IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
		  ,CF.CashFlowIFRS
                  ,IR.[CashReceive]
                  ,IR.[Receive]
                  ,IR.[Cash_Balance]
                  ,IR.[Interest]
                  ,IR.[Cumulative_Interest]
                  ,IR.[Cut_InterestOnMonth]
                  ,IR.[Interest_BalanceOnMonth]
                  ,IR.[Cut_OSDebt]
                  ,IR.[Rec100]
                  ,IR.[OS_BalanceNPV]
                  ,IR.[OS_BalanceInterestLast]
                  ,IR.[NPV]
                  ,IR.[PV_BalanceOnMonth]
                  ,IR.[PV_NetMonth]
                  ,IR.[ProvisionCumulative]
		  ,IR.ProvisionOld_Balance
		  ,IR.Total_Provision_Balance
		  ,IR.Revert_ProvisionOnMonth
		  ,IR.Revert_ProvisionOld
		  ,IR.PV_Old
              ,PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
            )AA
            where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_all_eir($search) {
        $query = "SELECT COUNT(*) as Count from(
            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row ,IR.[Port],IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
		  ,round(CF.CashFlowIFRS,2) AS CashFlowIFRS
                  ,IR.[CashReceive]
                  ,IR.[Receive]
                  ,IR.[Cash_Balance]
                  ,IR.[Interest]
                  ,IR.[Cumulative_Interest]
                  ,IR.[Cut_InterestOnMonth]
                  ,IR.[Interest_BalanceOnMonth]
                  ,IR.[Cut_OSDebt]
                  ,IR.[Rec100]
                  ,IR.[OS_BalanceNPV]
                  ,IR.[OS_BalanceInterestLast]
                  ,IR.[NPV]
                  ,IR.[PV_BalanceOnMonth]
                  ,IR.[PV_NetMonth]
                  ,IR.[ProvisionCumulative]
		  ,IR.ProvisionOld_Balance
		 ,IR.Total_Provision_Balance
		,IR.Revert_ProvisionOnMonth
		,IR.Revert_ProvisionOld
		,IR.PV_Old, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
                FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] PU 
                INNER JOIN [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] IR ON PU.Port = IR.Port
                INNER JOIN [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] CF ON IR.Port = CF.Port AND IR.MONTH_YEAR = CF.MONTH_YEAR
                WHERE PU.Port Like '%%' $search 
                group by PU.Port,IR.[Port]
                  ,IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
		  ,CF.CashFlowIFRS
                  ,IR.[CashReceive]
                  ,IR.[Receive]
                  ,IR.[Cash_Balance]
                  ,IR.[Interest]
                  ,IR.[Cumulative_Interest]
                  ,IR.[Cut_InterestOnMonth]
                  ,IR.[Interest_BalanceOnMonth]
                  ,IR.[Cut_OSDebt]
                  ,IR.[Rec100]
                  ,IR.[OS_BalanceNPV]
                  ,IR.[OS_BalanceInterestLast]
                  ,IR.[NPV]
                  ,IR.[PV_BalanceOnMonth]
                  ,IR.[PV_NetMonth]
                  ,IR.[ProvisionCumulative]
		  ,IR.ProvisionOld_Balance
		  ,IR.Total_Provision_Balance
		  ,IR.Revert_ProvisionOnMonth
		  ,IR.Revert_ProvisionOld
		  ,IR.PV_Old
              ,PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
            )AA";
        return $this->db->query($query)->result();
    }

    //นับจำนวน ข้อมูลของหน้าแรก
//    function count_all_eir($search) {
//        $query = "SELECT COUNT(*) as Count from(
//            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row, IR.*, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
//              FROM [tbl_PortUn] PU 
//              INNER JOIN tbIRR IR ON PU.Port = IR.Port
//              WHERE PU.Port Like '%%' and Type = 'Collection' $search 
//              group by PU.Port,IR.[Port]
//                  ,IR.[Mob]
//                  ,IR.[MONTH_YEAR]
//                  ,IR.[TransferFee] 
//                  ,IR.[CourtFee]
//                  ,IR.[RevokeCustomer]
//                  ,IR.[OS_Before_Provision]
//                  ,IR.[ProvisonOnMonth]
//                  ,IR.[OS_NetProvision]
//                  ,IR.[CashReceive]
//                  ,IR.[Receive]
//                  ,IR.[Cash_Balance]
//                  ,IR.[Interest]
//                  ,IR.[Cumulative_Interest]
//                  ,IR.[Cut_InterestOnMonth]
//                  ,IR.[Interest_BalanceOnMonth]
//                  ,IR.[Cut_OSDebt]
//                  ,IR.[Revert_ProvisionOnMonth]
//                  ,IR.[Revert_ProvisionOld]
//                  ,IR.[Rec100]
//                  ,IR.[OS_BalanceNPV]
//                  ,IR.[OS_BalanceInterestLast]
//                  ,IR.[NPV]
//                  ,IR.[PV_BalanceOnMonth]
//                  ,IR.[PV_NetMonth]
//                  ,IR.[ProvisionCumulative]
//                  ,IR.Type
//                  ,IR.[ProvisionOld_Balance]
//                  ,IR.[Total_Provision_Balance]
//                  ,PU.Bcost
//                  ,PU.Company
//                  ,PU.DateStart
//                  ,PU.EIR
//                 ,PU.TypePort)AA";
//          
//        return $this->db->query($query)->result();
//    }
    // function delete_eir($Number)
    // {
    //     $query = "DELETE FROM EIR_Jmt WHERE Number ='$Number'";
    //     return $this->db->query($query);
    // }
//    function delete_eir($Number) {
//        $query = "DELETE FROM [JMTLOAN_PROD].[dbo].[EIR_Jmt] WHERE Number ='$Number'";
//        return $this->db->query($query);
//    }
//    function exportbyid_eir($start, $pageend, $port)
//    {
//        $query = "SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbl_PortUn where Port = '$port')AA
//            WHERE row > $start AND row <= $pageend  order by row   ";
//
//        return $this->db->query($query)->result();
//    }
//     function exportbyid_eir($start, $pageend, $port) {
//        $query = "SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn]  where Port = '$port')AA
//            WHERE row > $start AND row <= $pageend  order by row   ";
//
//        return $this->db->query($query)->result();
//    }
//
//    function exportbyid1_eir($start, $pageend, $search) {
//        $query = "SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn]  Where Port LIKE '%%'  $search)AA
//            WHERE row > $start AND row <= $pageend  order by row   ";
//
//        return $this->db->query($query)->result();
//    }
//
//    function exportbyid2_eir($start, $pageend, $search) {
//        $query = "SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By R.Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] R Where R.Port LIKE '%%'and R.Port = '$search')AA
//            WHERE row > $start AND row <= $pageend  order by row";
//
//        return $this->db->query($query)->result();
//    }


    function exportbyid_eir($start, $pageend, $port) {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] where Port = '$port')AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }

    function exportbyid1_eir($start, $pageend, $search) {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By R.Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] R Where R.Port LIKE '%%'  $search)AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }

    function exportbyid2_eir($start, $pageend, $search) {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By R.Port )as row ,* from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] R Where R.Port LIKE '%%'and R.Port = '$search')AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }

//    function exportbyid2_eir($start, $pageend, $search) {
//        $query = "SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbl_PortUn Where Port LIKE '%%'and Port = '$search')AA
//            WHERE row > $start AND row <= $pageend  order by row   ";
//
//        return $this->db->query($query)->result();
//    }
    //ข้อมูลของหน้า Cashflow หรือ หน้า Detail
//    function cash_flow($search) {
//
//        $query = "SELECT [Port],[Mob]
//         ,[MONTH_YEAR] 
//         ,[TransferFee],[CourtFee],[OS_Before_Provision]
//         ,[ProvisonOnMonth]
//         ,[OS_NetProvision]
//         ,[CashReceive]
//         ,[Receive]
//         ,[Cash_Balance]
//         ,[Interest]
//         ,[RevokeCustomer]
//         ,[Cumulative_Interest]
//         ,[Cut_InterestOnMonth]
//         ,[Interest_BalanceOnMonth]
//         ,[Cut_OSDebt]
//         ,[Revert_ProvisionOnMonth]
//         ,[Revert_ProvisionOld]
//         ,[Rec100]
//         ,[OS_BalanceNPV]
//         ,[OS_BalanceInterestLast]
//         ,[NPV]
//         ,[PV_BalanceOnMonth]
//         ,[PV_NetMonth]
//         ,[ProvisionCumulative]
//         ,case  convert(nvarchar,year([MONTH_YEAR]))+'-'+convert(nvarchar,month([MONTH_YEAR]))
//         when convert(nvarchar,year(GETDATE()))+'-'+convert(nvarchar,month(GETDATE()))
//         then  '1'
//         else '0'
//         end as Today
//        ,[ProvisionOld_Balance]
//        ,[Total_Provision_Balance]
//        FROM [JMTLOAN_PROD-Restore].[dbo].[tbIRR] 
//        Where Port is NOT NULL and Type = 'Collection' $search order by Mob";
//
//        return $this->db->query($query)->result();
//    }

    function cash_flow($search) {

        $query = "SELECT R.Port,R.Mob
         ,R.MONTH_YEAR
         ,R.TransferFee,R.CourtFee,R.OS_Before_Provision
         ,R.ProvisonOnMonth
         ,R.OS_NetProvision
         ,CF.CashFlowIFRS
         ,R.CashReceive
         ,R.Receive
         ,R.Cash_Balance
         ,R.Interest
         ,R.RevokeCustomer
         ,R.Cumulative_Interest
         ,R.Cut_InterestOnMonth
         ,R.Interest_BalanceOnMonth
         ,R.Cut_OSDebt
	 ,R.Revert_ProvisionOnMonth
	 ,R.Revert_ProvisionOld
         ,R.Rec100
         ,R.OS_BalanceNPV
         ,R.OS_BalanceInterestLast
         ,R.NPV
         ,R.PV_BalanceOnMonth
         ,R.PV_NetMonth
	 ,R.PV_Old
         ,R.ProvisionCumulative
         ,case  convert(nvarchar,year(R.MONTH_YEAR))+'-'+convert(nvarchar,month(R.MONTH_YEAR))
         when convert(nvarchar,year(GETDATE()))+'-'+convert(nvarchar,month(GETDATE()))
         then  '1'
         else '0'
         end as Today
        ,R.ProvisionOld_Balance
	,R.Total_Provision_Balance
        FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] R 
        INNER JOIN [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] CF ON R.Port = CF.Port AND  R.Mob = CF.Mob 
        Where R.Port is NOT NULL $search order by R.Mob";

        return $this->db->query($query)->result();
    }

    //คำนวณ ผลรวมของหน้า Detail
//    function cal_cash($search) {
//        $query = "SELECT sum(CashReceive) as CashFlow From tbIRR Where Port is NOT NULL and Type = 'Collection' $search";
//
//        return $this->db->query($query)->result();
//    }


    function cal_cash($search) {

        $query = "SELECT sum(R.CashReceive) as CashFlow From [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] R Where R.Port is NOT NULL $search";
        return $this->db->query($query)->result();
    }

    //นับจำนวนข้อมูลของหน้า Detail
//    function count_cash_flow($search) {
//
//        $query = "SELECT COUNT(*)AS Count FROM(
//            select ROW_NUMBER()OVER (ORDER BY Port)as row ,* from tbIRR Where Port LIKE '%%' and Type = 'Collection' $search)AA";
//
//        return $this->db->query($query)->result();
//    }
    function count_cash_flow($search) {

        $query = "SELECT COUNT(*)AS Count FROM(
            select ROW_NUMBER()OVER (ORDER BY R.Port)as row ,* FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] R Where R.Port LIKE '%%' $search)AA";

        return $this->db->query($query)->result();
    }

    function exportbyid_cash($start, $pageend, $Port) {
        $query = "SELECT * from(SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By R.Mob )as row ,R.*,CF.CashFlowIFRS FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbIRR] R INNER JOIN tbl_CashFlowUn CF ON R.Port = CF.Port AND R.Mob= CF.Mob   Where R.Port = '$Port' )AA
            WHERE row > $start AND row <= $pageend  )bb order by row ";

        return $this->db->query($query)->result();
    }

//    function exportbyid_cash($start, $pageend, $Port)
//    {
//        $query = "SELECT * from(SELECT * FROM(
//            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbIRR Where Port = '$Port' and Type = 'Collection' )AA
//            WHERE row > $start AND row <= $pageend  )bb order by row ";
//
//        return $this->db->query($query)->result();
//    }
    //tab search
//    function port()
//    {
//        $query = "SELECT * FROM tbl_PortUn  ORDER BY Port";
//
//        return $this->db->query($query)->result();
//    }

    function port() {
        $query = "SELECT * FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn]   ORDER BY Port";

        return $this->db->query($query)->result();
    }

    //tab search
//    function port_cash()
//    {
//        $query = "SELECT distinct Port from tbl_CashFlowUn Order By Port";
//
//        return $this->db->query($query)->result();
//    }
    function port_cash() {
        $query = "SELECT distinct Port from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] Order By Port";

        return $this->db->query($query)->result();
    }

    //tab search
//    function company()
//    {
//        $query = "SELECT Distinct Company FROM tbl_PortUn ORDER BY Company desc";
//
//        return $this->db->query($query)->result();
//    }
    function company() {
        $query = "SELECT Distinct Company FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] ORDER BY Company desc";

        return $this->db->query($query)->result();
    }

    //tab search
//    function port_jmt($company)
//    {
//        $query = "SELECT Port from tbl_PortUn where Port like '%%' $company order by Port ";
//        return $this->db->query($query)->result();
//    }
    function port_jmt($company) {
        $query = "SELECT Port from [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn]  where Port like '%%' $company order by Port ";
        return $this->db->query($query)->result();
    }

    function loginauth($id, $pass) {
        $query = "SELECT COUNT(*) as Emp FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[TbEmployee] 
            Where IDEmp = '$id' AND Password = '$pass'";
        return $this->db->query($query)->result();
    }

    function loginauth1($id, $pass) {
        $query = "SELECT *  FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[TbEmployee] 
            Where IDEmp = '$id' AND Password = '$pass'";
        return $this->db->query($query)->result();
    }

    //เดือน พร้อมชื่อ เดือน
    function month() {
        $query = "SELECT DATENAME(mm,MONTH_YEAR) as Month from EASYBUY.dbo.tbIRR  Group by
        DATENAME(mm,MONTH_YEAR),Month(MONTH_YEAR) order by Month(MONTH_YEAR)";
        return $this->db->query($query)->result();
    }

    //จำนวนปีทั้งหมด
    function year() {
        $query = "SELECT Distinct convert(nvarchar(4),MONTH_YEAR) as Year 
        from tbIRR order by Year";
        return $this->db->query($query)->result();
    }

    // ผลรวมตามเดือน ของหน้า Sum per year
//    function summonth($textva) {
//        $query = "SELECT        
//        DATENAME(mm,MONTH_YEAR) as Month,
//        $textva
//        convert(nvarchar(4),MONTH_YEAR)+' ' as Year ,Type
//        FROM [JMTLOAN_PROD].[dbo].[tbl_CashFlowUn]
//        where Type = 'Collection' 
//        Group By MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR),Type order by MONTH_YEAR";
//        return $this->db->query($query)->result();
//    }
     // ผลรวมตามเดือน ของหน้า Sum per year
    function summonth($textva) {
        $query = "SELECT        
        DATENAME(mm,MONTH_YEAR) as Month,
        $textva convert(nvarchar(4),MONTH_YEAR)+' ' as Year FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn]
        Group By MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR) order by MONTH_YEAR";
        return $this->db->query($query)->result();
    }

    // ผลรวมตามPort ของหน้า Sum per year
//    function sumport($textva) {
//        $query = "SELECT
//        $textva
//        ' ' as YearMonth
//        ,Type
//        from tbl_CashFlowUn
//        where Type = 'Collection'
//        Group by Type
//        ";
//
//        return $this->db->query($query)->result();
//    }
    function sumport($textva) {
        $query = "SELECT
        $textva
        ' ' as YearMonth
        from tbl_CashFlowUn";

        return $this->db->query($query)->result();
    }

    // ผลรวมตามปี ของหน้า Sum per year
//    function sumyear($dataPort) {
//        $query = "SELECT 
//        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
//        $dataPort
//        '' as YearMonth,
//        Type
//        from 
//        tbl_CashFlowUn 
//        where Type = 'Collection' 
//        group by 
//        convert(nvarchar(4),MONTH_YEAR),Type
//        order by  
//        convert(nvarchar(4),MONTH_YEAR)";
//        return $this->db->query($query)->result();
//    }
     function sumyear($dataPort) {
        $query = "SELECT 
        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
        $dataPort
        '' as YearMonth FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] 
        group by convert(nvarchar(4),MONTH_YEAR) order by convert(nvarchar(4),MONTH_YEAR)";
        return $this->db->query($query)->result();
    }

    //ผลรวมของ OS
    function sumos($textvaos) {
        $query = "SELECT
        $textvaos
        '' as OS,
        '' as OS1
         FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn]";
        return $this->db->query($query)->result();
    }

    //ผลรวมของ Account
    function sumacct($textvaact) {
        $query = "SELECT
        $textvaact
        '' as OS,
        '' as OS1
         FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_PortUn] ";
       
        return $this->db->query($query)->result();
    }

    // ผลรวมตามเดือน ของหน้า Sum per year
//    function summonth1($textva) {
//        $query = "SELECT        
//        DATENAME(mm,MONTH_YEAR) as Month,
//        $textva
//        convert(nvarchar(4),MONTH_YEAR)+' ' as Year
//        ,Type
//        from
//        tbl_CashFlowUn
//        where Type = 'Revenue'
//        Group By 
//        MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR),Type
//        order by
//         MONTH_YEAR";
//        return $this->db->query($query)->result();
//    }
    function summonth1($textva) {
        $query = "SELECT        
        DATENAME(mm,MONTH_YEAR) as Month,
        $textva
        convert(nvarchar(4),MONTH_YEAR)+' ' as Year
        FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn]
        Group By MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR) order by MONTH_YEAR";
        return $this->db->query($query)->result();
    }

    // ผลรวมตามPort ของหน้า Sum per year
//    function sumport1($textva) {
//        $query = "SELECT
//        $textva
//        ' ' as YearMonth
//        ,Type
//        from
//        tbl_CashFlowUn
//        where Type = 'Revenue'
//        Group by Type
//        ";
//
//        return $this->db->query($query)->result();
//    }
     function sumport1($textva) {
        $query = "SELECT
        $textva
        ' ' as YearMonth
         FROM [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn]";
      
        return $this->db->query($query)->result();
    }
    
    
    // ผลรวมตามปี ของหน้า Sum per year
//    function sumyear1($dataPort) {
//        $query = "SELECT 
//        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
//        $dataPort
//        '' as YearMonth,
//        Type
//        from 
//        tbl_CashFlowUn 
//        where Type = 'Revenue' 
//        group by 
//        convert(nvarchar(4),MONTH_YEAR),Type
//        order by  
//        convert(nvarchar(4),MONTH_YEAR)";
//        return $this->db->query($query)->result();
//    }
        function sumyear1($dataPort) {
        $query = "SELECT 
        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
        $dataPort
        '' as YearMonth
        FROM  [191.191.190.18].[JMTLOAN_PROD].[dbo].[tbl_CashFlowUn] group by convert(nvarchar(4),MONTH_YEAR) order by  convert(nvarchar(4),MONTH_YEAR)";
        return $this->db->query($query)->result();
    }

}
