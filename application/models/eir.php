<?php

class eir extends CI_Model
{



    
 //ข้อมูลของหน้าแรก
    function all_eir($start, $pageend, $search)
    {

        $query = "SELECT * from(
            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row, IR.*, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
              FROM [tbl_PortUn] PU 
              INNER JOIN tbIRR IR ON PU.Port = IR.Port
              WHERE PU.Port Like '%%' and Type = 'Collection' $search 
              group by PU.Port,IR.[Port]
                  ,IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
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
                  ,IR.Type
              ,PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
            )AA
            where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }
    //นับจำนวน ข้อมูลของหน้าแรก
    function count_all_eir($search)
    {
        $query = "SELECT COUNT(*) as Count from(
            SELECT ROW_NUMBER()OVER ( ORDER By PU.Port )as row, IR.*, PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
              FROM [tbl_PortUn] PU 
              INNER JOIN tbIRR IR ON PU.Port = IR.Port
              WHERE PU.Port Like '%%' and Type = 'Collection' $search 
              group by PU.Port,IR.[Port]
                  ,IR.[Mob]
                  ,IR.[MONTH_YEAR]
                  ,IR.[TransferFee] 
                  ,IR.[CourtFee]
                  ,IR.[RevokeCustomer]
                  ,IR.[OS_Before_Provision]
                  ,IR.[ProvisonOnMonth]
                  ,IR.[OS_NetProvision]
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
                  ,IR.Type
              ,PU.Bcost,PU.Company,PU.DateStart,PU.EIR,PU.TypePort
            )AA";
        return $this->db->query($query)->result();
    }

    // function delete_eir($Number)
    // {
    //     $query = "DELETE FROM EIR_Jmt WHERE Number ='$Number'";
    //     return $this->db->query($query);
    // }

    function exportbyid_eir($start, $pageend, $port)
    {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbl_PortUn where Port = '$port')AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }

    function exportbyid1_eir($start, $pageend, $search)
    {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbl_PortUn Where Port LIKE '%%'  $search)AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }

    function exportbyid2_eir($start, $pageend, $search)
    {
        $query = "SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbl_PortUn Where Port LIKE '%%'and Port = '$search')AA
            WHERE row > $start AND row <= $pageend  order by row   ";

        return $this->db->query($query)->result();
    }


    //ข้อมูลของหน้า Cashflow หรือ หน้า Detail
    function cash_flow($search)
    {

        $query = "SELECT [Port],[Mob]
         ,[MONTH_YEAR] 
         ,[TransferFee],[CourtFee],[OS_Before_Provision]
         ,[ProvisonOnMonth]
         ,[OS_NetProvision]
         ,[CashReceive]
         ,[Receive]
         ,[Cash_Balance]
         ,[Interest]
         ,[RevokeCustomer]
         ,[Cumulative_Interest]
         ,[Cut_InterestOnMonth]
         ,[Interest_BalanceOnMonth]
         ,[Cut_OSDebt]
         ,case when [Rec100] < 0 then 0 else [Rec100] end as [Rec100]
         ,[OS_BalanceNPV]
         ,[OS_BalanceInterestLast]
         ,[NPV]
         ,[PV_BalanceOnMonth]
         ,[PV_NetMonth]
         ,[ProvisionCumulative]
         ,case  convert(nvarchar,year([MONTH_YEAR]))+'-'+convert(nvarchar,month([MONTH_YEAR]))
         when convert(nvarchar,year(GETDATE()))+'-'+convert(nvarchar,month(GETDATE()))
         then  '1'
         else '0'
         end as Today
        FROM tbIRR Where Port is NOT NULL and Type = 'Collection' $search order by Mob";

        return $this->db->query($query)->result();
    }
    //คำนวณ ผลรวมของหน้า Detail
    function cal_cash($search)
    {
        $query = "SELECT sum(CashReceive) as CashFlow From tbIRR Where Port is NOT NULL and Type = 'Collection' $search";

        return $this->db->query($query)->result();
    }
    //นับจำนวนข้อมูลของหน้า Detail
    function count_cash_flow($search)
    {

        $query = "SELECT COUNT(*)AS Count FROM(
            select ROW_NUMBER()OVER (ORDER BY Port)as row ,* from tbIRR Where Port LIKE '%%' and Type = 'Collection' $search)AA";

        return $this->db->query($query)->result();
    }

    function exportbyid_cash($start, $pageend, $Port)
    {
        $query = "SELECT * from(SELECT * FROM(
            select ROW_NUMBER()OVER ( ORDER By Port )as row ,* from tbIRR Where Port = '$Port' and Type = 'Collection' )AA
            WHERE row > $start AND row <= $pageend  )bb order by row ";

        return $this->db->query($query)->result();
    }

    //tab search
    function port()
    {
        $query = "SELECT * FROM tbl_PortUn  ORDER BY Port";

        return $this->db->query($query)->result();
    }

    //tab search
    function port_cash()
    {
        $query = "SELECT distinct Port from tbl_CashFlowUn Order By Port";

        return $this->db->query($query)->result();
    }

    //tab search
    function company()
    {
        $query = "SELECT Distinct Company FROM tbl_PortUn ORDER BY Company desc";

        return $this->db->query($query)->result();
    }

    //tab search
    function port_jmt($company)
    {
        $query = "SELECT Port from tbl_PortUn where Port like '%%' $company order by Port ";
        return $this->db->query($query)->result();
    }

    //เดือน พร้อมชื่อ เดือน
    function month()
    {
        $query = "SELECT DATENAME(mm,MONTH_YEAR) as Month from EASYBUY.dbo.tbIRR  Group by
        DATENAME(mm,MONTH_YEAR),Month(MONTH_YEAR) order by Month(MONTH_YEAR)";
        return $this->db->query($query)->result();
    }

    //จำนวนปีทั้งหมด
    function year()
    {
        $query = "SELECT Distinct convert(nvarchar(4),MONTH_YEAR) as Year 
        from tbIRR order by Year";
        return $this->db->query($query)->result();
    }

    // ผลรวมตามเดือน ของหน้า Sum per year
    function summonth($textva)
    {
        $query = "SELECT        
        DATENAME(mm,MONTH_YEAR) as Month,
        $textva
        convert(nvarchar(4),MONTH_YEAR)+' ' as Year
        ,Type
        from
        tbl_CashFlowUn
        where Type = 'Collection' 
        Group By 
        MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR),Type
        order by
         MONTH_YEAR";
        return $this->db->query($query)->result();
    }
    // ผลรวมตามPort ของหน้า Sum per year
    function sumport($textva)
    {
        $query = "SELECT
        $textva
        ' ' as YearMonth
        ,Type
        from
        tbl_CashFlowUn
        where Type = 'Collection'
        Group by Type
        ";
        
        return $this->db->query($query)->result();
    }
    // ผลรวมตามปี ของหน้า Sum per year
    function sumyear($dataPort)
    {
        $query = "SELECT 
        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
        $dataPort
        '' as YearMonth,
        Type
        from 
        tbl_CashFlowUn 
        where Type = 'Collection' 
        group by 
        convert(nvarchar(4),MONTH_YEAR),Type
        order by  
        convert(nvarchar(4),MONTH_YEAR)";
        return $this->db->query($query)->result();
    }
    //ผลรวมของ OS
    function sumos($textvaos)
    {
        $query = "SELECT
        $textvaos
        '' as OS,
        '' as OS1
        from
        tbl_PortUn
        
        ";
        return $this->db->query($query)->result();
    }
    //ผลรวมของ Account
    function sumacct($textvaact)
    {
        $query ="SELECT
        $textvaact
        '' as OS,
        '' as OS1
        from
        tbl_PortUn
        
        ";
        return $this->db->query($query)->result();
        
    }

    // ผลรวมตามเดือน ของหน้า Sum per year
    function summonth1($textva)
    {
        $query = "SELECT        
        DATENAME(mm,MONTH_YEAR) as Month,
        $textva
        convert(nvarchar(4),MONTH_YEAR)+' ' as Year
        ,Type
        from
        tbl_CashFlowUn
        where Type = 'Revenue'
        Group By 
        MONTH_YEAR,convert(nvarchar(4),MONTH_YEAR),Type
        order by
         MONTH_YEAR";
        return $this->db->query($query)->result();
    }

    // ผลรวมตามPort ของหน้า Sum per year
    function sumport1($textva)
    {
        $query = "SELECT
        $textva
        ' ' as YearMonth
        ,Type
        from
        tbl_CashFlowUn
        where Type = 'Revenue'
        Group by Type
        ";
        
        return $this->db->query($query)->result();
    }

    // ผลรวมตามปี ของหน้า Sum per year
    function sumyear1($dataPort)
    {
        $query = "SELECT 
        convert(nvarchar(4),MONTH_YEAR)+' 'as Year ,
        $dataPort
        '' as YearMonth,
        Type
        from 
        tbl_CashFlowUn 
        where Type = 'Revenue' 
        group by 
        convert(nvarchar(4),MONTH_YEAR),Type
        order by  
        convert(nvarchar(4),MONTH_YEAR)";
        return $this->db->query($query)->result();
    }

    
}
