<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loadportmodels extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function Tmp_customer_insert($T,$insertloadport, $username)
    {
        $query = "INSERT INTO [$T].[dbo].[Tmp_customer]
        ([contract_no],[id_no],[product],[cus_name],[address1],[address2],[province],[postal],[b_balance],[e_balance]
        ,[lot_no],[operator_id],[contract_no2],[id_no2],[status],[company],[Save_Name],[Status_customer]) 
        VALUES ('$insertloadport[contract_no]','$insertloadport[id_no]', '$insertloadport[product]','$insertloadport[cus_name]',
        '$insertloadport[address1]','$insertloadport[address2]','$insertloadport[province]','$insertloadport[postal]',
        '$insertloadport[b_balance]','$insertloadport[e_balance]','$insertloadport[lot_no]','$insertloadport[operator_id]',
        '$insertloadport[contract_no2]','$insertloadport[id_no2]','$insertloadport[status]', 
        '$insertloadport[company]','$username','0')";

        return $this->db->query($query);
    }

    public function Select_Tmp_customer_FALSE($T, $username)
    {
        $query = "SELECT * FROM (SELECT  ROW_NUMBER () OVER(ORDER BY  contract_no DESC) AS row,* FROM (SELECT
                     A.[contract_no],A.[id_no],A.[product],A.[cus_name],A.[address1],A.[address2],A.[province]
                    ,A.[postal],A.[b_balance],A.[e_balance],A.[lot_no],A.[operator_id]
                    ,A.[searchNameDatabase],A.[contract_no2],A.[id_no2],A.[status]
                    ,A.[DateUpload],A.[LastDataUpdate],A.[company],A.[Save_Name],F.contract_no AS contractno,F.id_no AS idno
                    ,(CASE WHEN (F.contract_no = A.contract_no AND A.id_no = F.id_no  AND 
                    F.contract_no = A.contract_no AND F.id_no = A.id_no) THEN '' ELSE  '0' END) AS ContractNonot
                    FROM [$T].[dbo].[Tmp_customer] A
                    LEFT JOIN  [$T].[dbo].[customer] F ON F.contract_no = A.contract_no AND F.id_no = A.id_no 
                    where  A.contract_no is not null AND A.id_no  is not null AND A.Save_Name = '$username') BB
        Where BB.ContractNonot = '')AA";

        return $this->db->query($query)->result();
    }

    public function Select_Tmp_customer_True($T,$username)
    {
        $query = "SELECT * FROM (SELECT  ROW_NUMBER () OVER(ORDER BY  contract_no DESC) AS row,* FROM (SELECT
                     A.[contract_no],A.[id_no],A.[product],A.[cus_name],A.[address1],A.[address2],A.[province]
                    ,A.[postal],A.[b_balance],A.[e_balance],A.[lot_no],A.[operator_id]
                    ,A.[searchNameDatabase],A.[contract_no2],A.[id_no2],A.[status]
                    ,A.[DateUpload],A.[LastDataUpdate],A.[company],A.[Save_Name],F.contract_no AS contractno,F.id_no AS idno
                    ,(CASE WHEN (F.contract_no = A.contract_no AND A.id_no = F.id_no  AND 
                    F.contract_no = A.contract_no AND F.id_no = A.id_no) THEN '' ELSE  '0' END) AS ContractNonot
                    FROM [$T].[dbo].[Tmp_customer] A
                    LEFT JOIN  [$T].[dbo].[customer] F ON F.contract_no = A.contract_no AND F.id_no = A.id_no 
                    where  A.contract_no is not null AND A.id_no  is not null AND A.Save_Name = '$username') BB
                    Where BB.ContractNonot <> '')AA ";

        return $this->db->query($query)->result();
    }


    public function Get_operaton()
    {
        $query = "SELECT [operator_name] FROM [JMTLOAN_PROD].[dbo].[operator] group by  [operator_name]";

        return $this->db->query($query)->result();
    }


    public function Get_operator_value($T,$operatorname)
    {
        $query = "SELECT operator_value ,operator_name FROM [$T].[dbo].[operator] where  [operator_name] = '$operatorname'";

        return $this->db->query($query)->result();
    }

    public function Get_operator_id($T,$operatorname, $Product)
    {
        $query = "SELECT [operator_id]  FROM [$T].[JMTLOAN_PROD-Restore].[dbo].[operator] 
        where  [operator_name] = '$operatorname' AND operator_value = '$Product'";

        return $this->db->query($query)->result();
    }

    public function Delete_operator($T,$username)
    {
        $query = "DELETE  FROM [$T].[dbo].[Tmp_customer] where [Save_Name] = '$username'";

        return $this->db->query($query);
    }


    public function Delete_Tmp_Customer($T,$username)
    {
        $query = "DELETE  FROM [$T].[dbo].[Tmp_customer]
         where [Save_Name] = '$username' AND [Status_customer] = '0'";

        return $this->db->query($query);
    }


    // public function InsertCustomer($rescustomer)
    // {
    //     $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[customer]
    //     ([contract_no],[id_no],[product],[cus_name],[address1],[address2],[province],[postal],[b_balance],[e_balance]
    //     ,[lot_no],[operator_id],[contract_no2],[id_no2],[status],[DateUpload],[company]) 
    //     VALUES ('$rescustomer[contract_no]','$rescustomer[id_no]', '$rescustomer[product]','$rescustomer[cus_name]',
    //     '$rescustomer[address1]','$rescustomer[address2]','$rescustomer[province]','$rescustomer[postal]',
    //     '$rescustomer[b_balance]','$rescustomer[e_balance]','$rescustomer[lot_no]','$rescustomer[operator_id]',
    //     '$rescustomer[contract_no2]','$rescustomer[id_no2]','$rescustomer[status]', 
    //     '$rescustomer[DateUpload]','$rescustomer[company]')";

    //     return $this->db->query($query);
    // }


    public function InsertCustomer($username)
    {
        $query = "INSERT INTO [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[customer]
        ([contract_no],[id_no],[product],[cus_name],[address1],
        [address2],[province],[postal],[b_balance],[e_balance]
        ,[lot_no],[operator_id],[contract_no2],[id_no2],[status],
        [DateUpload],[company]) 
        SELECT   [contract_no],[id_no],[product],[cus_name],[address1],
        [address2],[province],[postal],[b_balance],[e_balance]
        ,[lot_no],[operator_id],[contract_no2] AS contractno ,[id_no2]  AS idno,[status]
        ,[DateUpload],[company] FROM (SELECT
        A.[contract_no],A.[id_no],A.[product],A.[cus_name],A.[address1],A.[address2],A.[province]
        ,A.[postal],A.[b_balance],A.[e_balance],A.[lot_no],A.[operator_id]
        ,A.[contract_no2],A.[id_no2],A.[status]
        ,A.[DateUpload],A.[company],A.[Save_Name],F.contract_no AS contractno,F.id_no AS idno
        ,(CASE WHEN (F.contract_no = A.contract_no AND A.id_no = F.id_no  AND 
        F.contract_no = A.contract_no AND F.id_no = A.id_no) THEN '' ELSE  '0' END) AS ContractNonot
        FROM [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[Tmp_customer] A
        LEFT JOIN [191.191.190.62].[JMTLOAN_PROD-Restore].[dbo].[customer] F ON F.contract_no = A.contract_no AND F.id_no = A.id_no 
        where  A.contract_no is not null AND A.id_no  is not null AND A.Save_Name = '$username') BB
        Where BB.ContractNonot <> ''";

        return $this->db->query($query);
    }

    public function UpdateCustomer($Updatecustomer, $username)
    {
        $query = "UPDATE  [JMTLOAN_PROD].[dbo].[Tmp_customer]
                 SET [product] = '$Updatecustomer[product]',[lot_no] = '$Updatecustomer[lot_no]'
                ,[operator_id] = '$Updatecustomer[operator_id]' ,[DateUpload]= '$Updatecustomer[DateUpload]'
                ,[company] = '$Updatecustomer[company]'
                WHERE  [contract_no]  = '$Updatecustomer[contract_no]'
                 AND [id_no] = '$Updatecustomer[id_no]' AND [Save_Name] = '$username'";

        return $this->db->query($query);
    }


    public function Select_customer()
    {
        $query = "SELECT [ID_Key],[contract_no],[id_no],[product]
                ,[cus_name],[address1],[address2],[province],[postal],[b_balance]
                ,[e_balance],[lot_no],[operator_id],[searchNameDatabase],[contract_no2]
                ,[id_no2],[status],[DateUpload],[LastDataUpdate] ,[company]
                FROM  [JMTLOAN_PROD-Restore].[dbo].[customer]";

        return $this->db->query($query)->result();
    }
}
