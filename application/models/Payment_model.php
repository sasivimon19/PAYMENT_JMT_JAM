<?php

class Payment_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
	}

	public function can_login($username,$password)
	{
		$query = "SELECT C.username,C.company,A.Subject_Right,B.Subject FROM [JAM_Restore].[dbo].[TBL_Right]A 
		INNER JOIN [JAM_Restore].[dbo].[TBL_Menu]B ON 	A.Right_Level = B.Rights
		INNER JOIN [JAM_Restore].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'

		union all  	

		SELECT C.username,C.company,A.Subject_Right,B.Subject FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_Right]A 
		INNER JOIN [JMTLOAN_PROD-Restore].[dbo].[TBL_Menu]B ON 	A.Right_Level = B.Rights
		INNER JOIN [JMTLOAN_PROD-Restore].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'";	
            
//                $query = "SELECT C.username,C.company,C.password  FROM 	[JAM_Restore].[dbo].[user_log]C
//		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'
//
//		union all  	
//
//		SELECT C.username,C.company,C.password FROM  [JMTLOAN_PROD-Restore].[dbo].[user_log]C 
//		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'";

                    return $this->db->query($query)->result();

                    if ($query->num_rows() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

    public function username($username)
	{
		$query = "SELECT * FROM [JAM_Restore].[dbo].[TBL_Right]A
		INNER JOIN [JAM_Restore].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username'

		union all  	

		SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[TBL_Right]A
		INNER JOIN [JMTLOAN_PROD-Restore].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username'";
		return $this->db->query($query)->result();
	}

	public function username_menu($username,$T)
	{
		$query = "SELECT * FROM [$T].[dbo].[user_log]A
		INNER JOIN [$T].[dbo].[TBL_User_menu]B  ON A.id_run = B.id_run
		INNER JOIN [$T].[dbo].[TBL_Menu]C ON B.id_menu = C.ID
		WHERE A.username ='$username' Order By num ASC";
		return $this->db->query($query)->result();
	}

	public function username_menu_ID($id,$T)
	{
		$query = "SELECT * FROM [$T].[dbo].[TBL_Right]A
		INNER JOIN [$T].[dbo].[TBL_Menu]B ON 	A.Right_Level = B.Rights
		INNER JOIN [$T].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.id_run ='$id' Order By num ASC";
		return $this->db->query($query)->result();
	}

	public function getall_customer($contract,$com,$T)
	{
		$query = "SELECT A.id_no, A.cus_name, A.lot_no, A.product, A.address1, A.address2, A.province,A.postal,
		A.b_balance,A.e_balance,B.operator_name, B.operator_value,A.status,A.company,B.company
		FROM [$T].[dbo].[customer]A
		INNER JOIN [$T].[dbo].[operator]B
		ON A.operator_id = B.operator_id 
		WHERE  A.contract_no = '$contract' AND B.company = '$com'		
		";
		return $this->db->query($query)->result();
	}
        
        
        
//        public function Select_Check_Discount($contract, $com, $T) {
//        $query = "SELECT * FROM(
//            select Code,IDEmp,password,NameEmp,'AEON_DEBTSALE' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.21].[AEON_DEBTSALE].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0'  $statusonweb
//            union all 
//            select Code,IDEmp,password,NameEmp,'AEON' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.21].[AEON].[dbo].[TbEmployee]
//             where Code = '$user' and Password=HASHBYTES('SHA1', convert(nvarchar(50),'$pass')) and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0'   $statusonweb
//            union all 
//             select Code,IDEmp,password,NameEmp,'LEGAL' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.26].[LEGAL].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0' $statusonweb
//            union all 
//            select Code,IDEmp,password,NameEmp,'EASYBUY' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.26].[EASYBUY].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0'  $statusonweb
//            union all  
//            select Code,IDEmp,password,NameEmp,'COK_NONACTIVE' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.27].[COK_NONACTIVE].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0' $statusonweb
//            union all  
//             select Code,IDEmp,password,NameEmp,'HOUSING' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.23].[HOUSING].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0' $statusonweb  
//            union all   
//             select Code,IDEmp,password,NameEmp,'HSCB' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.23].[HSCB].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR')and Status = '0' $statusonweb  
//            union all   
//             select Code,IDEmp,password,NameEmp,'Collection' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.23].[Collection].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0' $statusonweb 
//               union all   
//             select Code,IDEmp,password,NameEmp,'UOB' AS DB,StatusOnWeb,LTrim(RTrim(LevelEmp)) AS LevelEmp,DateStart,DateEnd,StatusOnWebAccess
//             from [191.191.190.42].[UOB].[dbo].[TbEmployee]
//             where Code = '$user' and password = '$pass' and (LevelEmp = 'collector' or LevelEmp='ADMINIS' or LevelEmp='SUPERVISOR') and Status = '0' $statusonweb  
//
//             )Emp WHERE  DB ='$db' $wheredate'		
//		";
//        return $this->db->query($query)->result();
//    }

//	public function get_customer($contract,$com,$T)
//	{
//		$query = " SELECT * FROM [$T].[dbo].[customer]A
//		INNER JOIN [$T].[dbo].[operator]B
//		ON A.operator_id = B.operator_id 
//		WHERE  (A.contract_no = '$contract' OR A.id_no = '$contract') AND A.company = '$com'";
//		return $this->db->query($query)->result();
//	}
        
        
        public function get_customer($T, $wherecustomer, $start, $pageend) {
            $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY lot_no DESC) 
                    AS row,A.contract_no,A.id_no, A.cus_name, A.lot_no, A.product, A.address1,
                    A.address2, A.province,A.postal, A.b_balance,A.e_balance,B.operator_name,
                    B.operator_value,A.status,B.company FROM [$T].[dbo].[customer]A 
                    INNER JOIN [$T].[dbo].[operator]B ON A.operator_id = B.operator_id 
                    $wherecustomer )CC
                    WHERE CC.row > $start And CC.row <= $pageend";
        return $this->db->query($query)->result();
    }
    
        public function get_Countcustomer($T, $wherecustomer) {
        $query = " SELECT COUNT(A.id_no)AS Count FROM [$T].[dbo].[customer]A 
                    INNER JOIN [$T].[dbo].[operator]B ON A.operator_id = B.operator_id 
                    $wherecustomer";
        return $this->db->query($query)->result();
    }

    public function receive($contract, $company, $T) {
        $query = " SELECT sum(case chennel WHEN  'REFUND' THEN -Amount ELSE Amount END)amount
		,sum(vatamount)vatamount
		FROM [$T].[dbo].[receive]
		where contract_no ='$contract' AND company = '$company' group by contract_no ";
        return $this->db->query($query)->result();
    }

    public function receiveTB($contract, $company, $T) {
        $query = "SELECT * FROM (
		SELECT ROW_NUMBER() OVER (Order by contract_no)
		As No,r_index,Rec_date
		AS DateReceive,Chennel,Refno1,Refno2,Amount,Vatamount,Invoiceno,State
		,Keytype,SaveEmpBy,DateSave,ApproveEmpBy,DateApprove,Remark,Company
		FROM [$T].[dbo].[receive]	
		Where contract_no = '$contract' AND company = '$company'
		)A  ORDER BY A.DateReceive DESC";
        return $this->db->query($query)->result();
    }

    public function company($com) {
        $query = "SELECT * FROM [JMTLOAN_PROD-Restore].[dbo].[jmtdata] Where code ='$com'

		union all

		SELECT * FROM [JAM_Restore].[dbo].[jamdata] Where code ='$com'";

        return $this->db->query($query)->result();
    }

    public function update_company($id, $name, $address, $taxno, $taxrate, $code, $T, $tb) {
        $query = "UPDATE [$T].[dbo].[$tb] SET 
		name='$name',
		address='$address',
		taxno='$taxno',
		taxrate='$taxrate',
		code='$code' 
		WHERE comid = '$id'";
        return $this->db->query($query);
    }
    
    
    //insent Tmp upload file bank
    public function loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T) {
        $sql = "INSERT INTO[$T].[dbo].[TBL_Payment_Simulate] (Date1,Agreement,IDCard,Channel,
                    Ref1,Ref2,Amount,Lot,Remark,Masterkey)
		VALUES ('$Date',LTRIM(RTRIM('$Agreement')),LTRIM(RTRIM('$IDCard')),'$Channel','$Ref1','$Ref2','$Amount','$Lot','$Remark','$username')";
        return $this->db->query($sql);
    }

    public function loadpayment_insert_FN($Date1,$Agreement,$IDCard,$Channel,$operator_name,$Ref2,$Amount,$Lot,$Remark,$username,$dateSv,$operator_name,$VAT,$company,$T)
	{
		$sql = "INSERT INTO [$T].[dbo].[receive] (rec_date,contract_no,chennel,refno1,refno2,amount,SaveEmpBy,vatamount,invoiceno,state,keytype,DateSave,id_no,company)
		VALUES ('$Date1', RTRIM(LTRIM('$Agreement')),'$Channel','$operator_name','$Ref2','$Amount','$username','$VAT','0','0','1','$dateSv', RTRIM(LTRIM('$IDCard')),'$company')";
		return $this->db->query($sql);
	}

	public function delete_simulate($username,$T)
	{
		$query = "DELETE FROM [$T].[dbo].[TBL_Payment_Simulate] WHERE Masterkey = '$username'";
		return $this->db->query($query);
	}

	public function simulate_view($username)
	{
		$query = "SELECT * FROM [JAM_Restore].[dbo].[TBL_Payment_Simulate] Where Masterkey ='$username'";
		return $this->db->query($query)->result();
	}

	public function search_loadpayment($username, $T, $DC) {
        $query = " SELECT * FROM (
		(SELECT ROW_NUMBER () OVER(ORDER BY A.Agreement DESC) AS row, B.Refferent1,B.Refferent2, A.Date1,
                A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,D.Lot,A.Remark, B.OSbalance,C.code
		,'0' AS Discount_not FROM [$T].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent2 = A.IDCard AND B.Refferent1 = A.Agreement 
		LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel 
		LEFT JOIN [EASYBUY].[dbo].[TbCompany]D ON D.Code = B.ComCode 
		Where B.Refferent1 is not null AND C.code is not null AND B.Refferent2 is not null AND A.Masterkey = '$username' 
		AND (A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
		AND YEAR(A.Date1) <= YEAR(GETDATE ())))) AA 
		WHERE AA.Discount_not <> '' ";
        return $this->db->query($query)->result();
    }

    public function search_loadpayment_not($username, $T, $DC) {
       $query = "SELECT * FROM (
                (SELECT ROW_NUMBER () OVER(ORDER BY A.Agreement DESC) AS row,
		A.ID,B.Refferent1,B.Refferent2, A.Date1,A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,A.Lot,A.Remark,C.code 
		,(CASE WHEN ( B.Refferent1 = A.Agreement or A.IDCard = B.Refferent2) THEN '' ELSE  '0' END) AS ContractNo_not
		,(CASE WHEN (A.Channel = C.code) THEN '' ELSE  '0' END) AS Channel_not
		,(CASE WHEN ((month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
		AND YEAR(A.Date1) <= YEAR(GETDATE ()))) THEN '' ELSE  '0' END) AS Date_not
		,(CASE WHEN A.Channel = 'DISCOUNT' 
                AND (R.AccNo = B.Refferent1 AND R.IDCard = B.Refferent2  AND R.remark = 'DISCOUNT' ) THEN '0' ELSE  '' END) AS Discount_not 
		FROM [$T].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.Agreement AND A.IDCard = B.Refferent2
		LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel
                LEFT JOIN [EASYBUY].[dbo].[Tbpayment] R ON R.IDCard = A.IDCard AND R.AccNo = A.Agreement
		Where A.Masterkey = '$username'))AA 
		WHERE (AA.ContractNo_not = '0' or AA.Channel_not = '0' or AA.Date_not = '0' or AA.Discount_not = '0') ";
        return $this->db->query($query)->result();
    }

//	public function search_loadpayment_F($username,$T,$DC,$dateSv)
//	{
//		$query = " SELECT * FROM (
//		SELECT B.Refferent1,B.Refferent2, A.Date1,A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,D.Lot,A.Remark, B.OSbalance,C.code
//		,CASE WHEN A.Channel = 'DISCOUNT' AND [dbo].[Check_Discount](B.Refferent1,B.Refferent2,'$DC') = '1' THEN '0'  ELSE '' END AS Discount_not
//		FROM [$T].[dbo].[TBL_Payment_Simulate]A 
//		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent2 = A.IDCard AND B.Refferent1 = A.Agreement 
//		LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel 
//		LEFT JOIN [EASYBUY].[dbo].[TbCompany]D ON D.Code = B.ComCode 
//		Where B.Refferent1 is not null AND C.code is not null AND B.Refferent2 is not null AND A.Masterkey = '$username' 
//		AND (month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
//		AND YEAR(A.Date1) <= YEAR(GETDATE ())))AA 
//		WHERE AA.Discount_not <> '0'";
//		return $this->db->query($query)->result();
//	}
        
   public function search_loadpayment_F($username, $T, $DC, $dateSv) {
        $query = "SELECT * FROM ( SELECT B.Refferent1,B.Refferent2, A.Date1,A.Agreement,
	 A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,D.Lot,A.Remark, B.OSbalance,C.code 
       ,(CASE WHEN A.Channel = 'DISCOUNT' 
        AND (R.AccNo = B.Refferent1 AND R.IDCard = B.Refferent2 AND R.remark = 'DISCOUNT' )  THEN '' ELSE  '0' END) AS Discount_not 
        FROM [$T].[dbo].[TBL_Payment_Simulate] A
        LEFT JOIN  [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent2 = A.IDCard AND B.Refferent1 = A.Agreement
        LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel 
        LEFT JOIN [EASYBUY].[dbo].[TbCompany]D ON D.Code = B.ComCode
        LEFT JOIN [EASYBUY].[dbo].[Tbpayment] R ON R.IDCard = A.IDCard
        Where B.Refferent1 is not null AND C.code is not null AND B.Refferent2 is not null
        AND A.Masterkey = '$username' 
        AND (month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
        AND YEAR(A.Date1) <= YEAR(GETDATE ())))AA WHERE AA.Discount_not <> '0'";
        return $this->db->query($query)->result();
    }

//	public function search_loadpayment_not_F($username,$T,$DC,$dateSv)
//	{
//		$query = " SELECT * FROM (
//		SELECT A.ID,B.Refferent1,B.Refferent2, A.Date1,A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,A.Lot,A.Remark,C.code 
//		,(CASE WHEN ( B.Refferent1 = A.Agreement or A.IDCard = B.Refferent2) THEN '' ELSE  '0' END) AS ContractNo_not
//		,(CASE WHEN (A.Channel = C.code) THEN '' ELSE  '0' END) AS Channel_not
//		,(CASE WHEN ((month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
//		AND YEAR(A.Date1) <= YEAR(GETDATE ()))) THEN '' ELSE  '0' END) AS Date_not
//		,(CASE WHEN A.Channel = 'DISCOUNT' AND [dbo].[Check_Discount](B.Refferent1,B.Refferent2,'$DC') = '1' THEN '0'  ELSE '' END) AS Discount_not
//		FROM [$T].[dbo].[TBL_Payment_Simulate]A 
//		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.Agreement AND A.IDCard = B.Refferent2
//		LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel
//		Where A.Masterkey = '$username')AA 
//		WHERE (AA.ContractNo_not = '0' or AA.Channel_not = '0' or AA.Date_not = '0' or AA.Discount_not = '0') ";
//		return $this->db->query($query)->result();
//	}
        
        
       public function search_loadpayment_not_F($username, $T) {
        $query = "    SELECT * FROM (
		SELECT A.ID,B.Refferent1,B.Refferent2, A.Date1,A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,A.Lot,A.Remark,C.code 
		,(CASE WHEN ( B.Refferent1 = A.Agreement or A.IDCard = B.Refferent2) THEN '' ELSE  '0' END) AS ContractNo_not
		,(CASE WHEN (A.Channel = C.code) THEN '' ELSE  '0' END) AS Channel_not
		,(CASE WHEN ((month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE () OR MONTH(A.Date1) <= MONTH(GETDATE ())+1 
		AND YEAR(A.Date1) <= YEAR(GETDATE ()))) THEN '' ELSE  '0' END) AS Date_not
		,(CASE WHEN A.Channel = 'DISCOUNT' 
                AND (R.AccNo = B.Refferent1 AND R.IDCard = B.Refferent2  AND R.remark = 'DISCOUNT' ) THEN '0' ELSE  '' END) AS Discount_not 
		FROM [$T].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.Agreement AND A.IDCard = B.Refferent2
		LEFT JOIN [$T].[dbo].[chennel]C ON C.code = A.Channel
                LEFT JOIN [EASYBUY].[dbo].[Tbpayment] R ON R.IDCard = A.IDCard AND R.AccNo = A.Agreement
		Where A.Masterkey = '$username')AA 
		WHERE (AA.ContractNo_not = '0' or AA.Channel_not = '0' or AA.Date_not = '0' or AA.Discount_not = '0') ";
        return $this->db->query($query)->result();
    }

    public function get_insert_loadpayment($username)
	{
		$query = "SELECT B.AccNo, A.Date1,A.Agreement,A.IDCard,A.Channel,A.Ref1,A.Ref2,A.Amount,A.Lot,A.Remark, B.OSbalance,C.code 
		FROM [JAM_Restore].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.IDCard = A.IDCard AND B.AccNo = A.Agreement 
		LEFT JOIN [JAM_Restore].[dbo].[chennel]C ON C.code = A.Channel 
		Where B.AccNo is not null AND A.Masterkey = '$username'";
		return $this->db->query($query)->result();
	}

	public function Remark($username)
	{
		$query = "SELECT (CASE WHEN (A.Agreement = B.Refferent1) THEN '1' ELSE  '0' END) AS ContractNo
		,(CASE WHEN (A.Channel = C.code) THEN '1' ELSE  '0' END) AS Channel
		,(CASE WHEN (A.Date1 <= GETDATE ()) THEN '1' ELSE  '0' END) AS Date
		,(CASE WHEN ( B.Refferent2 = A.IDCard) THEN '1' ELSE  '0' END) AS IDCard
		,A.ID

		FROM [JAM_Restore].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON  A.Agreement = B.Refferent1 
		LEFT JOIN [JAM_Restore].[dbo].[chennel]C ON C.code = A.Channel
		Where (B.Refferent1 is null OR B.Refferent2 is null OR C.code is null) AND A.Masterkey = '$username' ";
		return $this->db->query($query);
	}

	public function get_Date_F($username)
	{
		$query = "	SELECT * FROM [JAM_Restore].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent2 = A.IDCard AND B.Refferent1 = A.Agreement AND month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE ()
		Where B.AccNo is null AND A.Masterkey = '$username'";
		return $this->db->query($query)->result();
	}

	public function dateserver(){
		$query = "SELECT GETDATE ()AS Currentdate";
		return $this->db->query($query)->result();
	}

	public function payment_channel($T){
		$query = "SELECT * FROM [$T].[dbo].[chennel] ORDER BY date_insert DESC";
		return $this->db->query($query)->result();
	}

	public function insert_channel($code,$detail,$dateSv,$T,$status){
		$query = " INSERT INTO [$T].[dbo].[chennel] 
		(code,chennel,date_insert,status)
		VALUES ('$code','$detail','$dateSv','$status') ";
		return $this->db->query($query);
	}

	public function status_channel($id,$T) {
		$query = "SELECT * FROM [$T].[dbo].[chennel] where IDChennel = '$id'";
		return $this->db->query($query)->result();
	}

	public function status_update_channel($id, $new_status,$T) {
		$query = " UPDATE [$T].[dbo].[chennel]
		SET status='$new_status' WHERE IDChennel = '$id'";
		return $this->db->query($query);
	}

	public function delete_channel($ID,$T){
		$query = " DELETE FROM [$T].[dbo].[chennel] WHERE IDChennel = '$ID'";
		return $this->db->query($query);
	}

	public function Pic_update($Photo,$id,$T){
		$query = "UPDATE  [$T].[dbo].[jmtdata] SET 
		pic = '$Photo' 
		WHERE comid = '$id';";
		return $this->db->query($query);
	}

	public function Pic_delete($id,$T){
		$query = "UPDATE [$T].[dbo].[jmtdata] SET 
		pic = NULL 
		WHERE comid = '$id';";
		return $this->db->query($query);
	}

	public function user_setting($T){
		$query = "SELECT * FROM [$T].[dbo].[user_log]C
		INNER JOIN [$T].[dbo].[TBL_Right]A ON A.Right_Level = C.user_level
		ORDER BY C.name DESC";
		return $this->db->query($query)->result();
	}

	public function get_user_setting($id,$T){
		$query = "SELECT * FROM [$T].[dbo].[user_log]C
		INNER JOIN [$T].[dbo].[TBL_Right]A ON A.Right_Level = C.user_level
		WHERE id_run = '$id'";
		return $this->db->query($query)->result();
	}

	public function setting_insert($name,$Username,$Password,$user_status,$company,$Rights,$T){
		$sql = "INSERT INTO [$T].[dbo].[user_log] 
		(name,username,password,user_status,user_level,company,chkPeriod,permission)
		VALUES ('$name','$Username','$Password','$user_status','$Rights','$company','1','1')";
		return $this->db->query($sql);
	}

	public function setting_update($id,$name,$Username,$Password,$company,$Rights,$num,$chkPeriod,$T){
		$sql = "UPDATE [$T].[dbo].[user_log] 
		SET name = '$name', username = '$Username',password = '$Password',company = '$company',user_level = '$Rights',menu = '$num',chkPeriod = '$chkPeriod'
		WHERE id_run = '$id';";
		return $this->db->query($sql);
	}

	public function setting_menu($id,$key,$T){
		$sql = "INSERT INTO [$T].[dbo].[TBL_User_menu] 
		(id_run,id_menu)
		VALUES ('$id','$key')";
		return $this->db->query($sql);
	}

	public function setting_menu_view($id,$T){
		$query = "SELECT * FROM [$T].[dbo].[TBL_User_menu] WHERE id_run = '$id'";
		return $this->db->query($query)->result();
	}

	public function setting_delete($id,$T){
		$sql = "DELETE [$T].[dbo].[TBL_User_menu] 
		WHERE id_run = '$id'";
		return $this->db->query($sql);
	}

	public function setting_status($id,$T) {
		$query = "SELECT *  FROM [$T].[dbo].[user_log] where id_run = '$id'";
		return $this->db->query($query)->result();
	}

	public function setting_status_update($id, $new_status,$T) {
		$query = " UPDATE [$T].[dbo].[user_log]
		SET user_status='$new_status' WHERE id_run = '$id'";
		return $this->db->query($query);
	}

	public function rights($T) {
		$query = "SELECT *  FROM [$T].[dbo].[TBL_Right] ORDER BY Right_Level ASC";
		return $this->db->query($query)->result();
	}

	public function rights_ID($num,$T) {
		$query = "SELECT *  FROM [$T].[dbo].[TBL_Right] WHERE Right_Level = '$num'";
		return $this->db->query($query)->result();
	}

	public function operator($T) {
		$query = "SELECT operator_name FROM [$T].[dbo].[operator] GROUP BY operator_name";
		return $this->db->query($query)->result();
	}

	public function operator_product($T) {
		$query = "SELECT * FROM [$T].[dbo].[operator]  ORDER BY operator_name ASC";
		return $this->db->query($query)->result();
	}
        
       public function search_appvrove($username, $status, $Operator, $idcustomer, $datestart, $dateend,$T) {
        $query = "SELECT A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,A.vatamount,
                A.state,A.keytype,A.id_no,C.lot_no,A.invoiceno,A.id_no
                FROM [$T].[dbo].[receive] A
                INNER JOIN [EASYBUY].[dbo].[TbCurrent] B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no    
                INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
                WHERE $status  AND A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%'
                AND A.refno1 LIKE '%$Operator%' AND A.DateSave BETWEEN '$datestart' AND '$dateend' ORDER BY A.DateSave";
        return $this->db->query($query)->result();
    }

//	public function search_appvrove($username,$status,$Operator,$idcustomer,$datestart,$dateend) {
//		$query = "SELECT A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,A.vatamount,A.state,A.keytype,A.id_no,C.lot_no,A.invoiceno FROM [JAM_Restore].[dbo].[receive]A
//		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
//		INNER JOIN [JAM_Restore].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
//		WHERE $status AND A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%' 
//		AND A.refno1 LIKE '%$Operator%' AND A.DateSave BETWEEN '$datestart' AND '$dateend' ORDER BY A.DateSave";
//		return $this->db->query($query)->result();
//	}

	public function search_sum_appvrove($username,$status,$Operator,$idcustomer,$datestart,$dateend,$T) {
		$query = "SELECT SUM(A.amount)as amount,SUM(A.vatamount)as vat FROM [$T].[dbo].[receive]A 
		INNER JOIN [$T].[dbo].[customer]B ON B.id_no = A.id_no AND B.contract_no = A.contract_no
		WHERE $status AND A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%'
                AND A.DateSave BETWEEN '$datestart' AND '$dateend' ";
		return $this->db->query($query)->result();
	}

	public function sum_appvrove($status_0,$Operator,$idcustomer,$datestart,$dateend) {
		$query = "SELECT SUM(amount)as amount,COUNT(r_index)as countsum FROM [JAM_Restore].[dbo].[receive] 
		WHERE state = '$status_0' AND contract_no LIKE '%$idcustomer%' AND refno1 LIKE '%$Operator%' AND DateSave BETWEEN '$datestart' AND '$dateend' ";
		return $this->db->query($query)->result();
	}

	public function sum_appvrove1($status_1,$Operator,$idcustomer,$datestart,$dateend) {
		$query = "SELECT SUM(amount)as amount,COUNT(r_index)as countsum FROM [JAM_Restore].[dbo].[receive] 
		WHERE state = '$status_1' AND contract_no LIKE '%$idcustomer%' AND refno1 LIKE '%$Operator%' AND DateSave BETWEEN '$datestart' AND '$dateend' ";
		return $this->db->query($query)->result();
	}

	public function id_customer($IDCard,$Agreement,$T) {
		$query = "SELECT B.operator_name,B.operator_value FROM [$T].[dbo].[customer]A	
		INNER JOIN [$T].[dbo].[operator]B
		ON A.operator_id = B.operator_id 
		WHERE A.id_no = '$IDCard' AND A.contract_no = '$Agreement'";
		return $this->db->query($query)->result();
	}

	public function get_current($contract_no,$IDCard) {
		$query = "SELECT * FROM [EASYBUY].[dbo].[TbCurrent] 
		WHERE Refferent2 = '$IDCard' AND Refferent1 = '$contract_no'";
		return $this->db->query($query)->result();
	}

	public function update_current($OSbalance,$contract_no,$IDCard) {
		$query = "UPDATE [EASYBUY].[dbo].[TbCurrent] 
		SET OSbalance = '$OSbalance' WHERE Refferent2 = '$IDCard' AND Refferent1 = '$contract_no'";
		return $this->db->query($query);
	}

	public function get_receive($T,$contract_no,$IDCard) {
		$query = "SELECT * FROM [JAM_Restore].[dbo].[receive] 
		WHERE contract_no = '$contract_no' AND id_no = '$IDCard' AND chennel = 'DISCOUNT' AND state = 1";
		return $this->db->query($query)->result();
	}

	public function update_receive($contract_no,$IDCard,$dateSv,$T) {
		$query = "UPDATE [$T].[dbo].[receive]
		SET state = '1',DateSave = '$dateSv' WHERE id_no = '$IDCard' AND contract_no = '$contract_no'";
		return $this->db->query($query);
	}

	public function update_receive_discount($T,$contract_no,$IDCard,$dateSv,$r_index) {
		$query = "UPDATE [$T].[dbo].[receive]
		SET state = '3',DateSave = '$dateSv' WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND r_index = '$r_index'";
		return $this->db->query($query);
	}

	public function update_r_index($T,$c,$IC,$r_index,$dateSv) {
		$query = "UPDATE [$T].[dbo].[receive]
		SET state = '1',refno1 = '$r_index',DateSave = '$dateSv' WHERE id_no = '$IC' AND contract_no = '$c' AND chennel = 'ADJUST'";
		return $this->db->query($query);
	}

	public function approve_New_Receive($T,$New_Receive) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $New_Receive";
		return $this->db->query($query)->result();
	}

	public function approve_CN($T,$CN) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $CN";
		return $this->db->query($query)->result();
	}

	public function approve_DISCOUNT($T,$DISCOUNT) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $DISCOUNT";
		return $this->db->query($query)->result();
	}

	public function approve_ADJUST($T,$ADJUST) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $ADJUST";
		return $this->db->query($query)->result();
	}

	public function approve_REVOKE($T,$REVOKE) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $REVOKE";
		return $this->db->query($query)->result();
	}

	public function approve_REFUND($T,$REFUND) {
		$query = "SELECT *  FROM [$T].[dbo].[receive] 
		WHERE state = '0' $REFUND";
		return $this->db->query($query)->result();
	}

	public function approve_New_Receive_view($T,$New_Receive,$com) {
		$query = "SELECT A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,A.vatamount,
                A.state,A.keytype,A.id_no,C.lot_no,A.invoiceno FROM [$T].[dbo].[receive]A
		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
		INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
		WHERE A.company = '$com' AND $New_Receive ORDER BY A.DateSave";                                                      
		return $this->db->query($query)->result();
	}

	public function sum_appvrove_1($status_0) {
		$query = "SELECT SUM(amount)as amount,COUNT(r_index)as countsum FROM [JAM_Restore].[dbo].[receive] 
		WHERE $status_0 ";
		return $this->db->query($query)->result();
	}

	public function sum_appvrove_2($status_1) {
		$query = "SELECT SUM(amount)as amount,COUNT(r_index)as countsum FROM [JAM_Restore].[dbo].[receive] 
		WHERE $status_1 ";
		return $this->db->query($query)->result();
	}

	public function search_sum_appvrove1($status,$com) {
		$query = "SELECT SUM(A.amount)as amount,SUM(A.vatamount)as vat FROM [JAM_Restore].[dbo].[receive]A 
		INNER JOIN [JAM_Restore].[dbo].[customer]B ON B.id_no = A.id_no AND B.contract_no = A.contract_no
		WHERE A.company = '$com' AND $status ";
		return $this->db->query($query)->result();
	}

//	public function get_invoice($Lot,$Operator,$idcustomer,$datestart,$dateend,$username,$status,$Invoice,$T) {
//		$query = " SELECT A.r_index,A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,
//                A.vatamount,A.state,A.keytype,A.id_no,E.Lot,A.invoiceno ,D.operator_name
//		FROM [$T].[dbo].[receive]A
//		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
//		INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
//		INNER JOIN [$T].[dbo].[operator]D ON C.operator_id = D.operator_id
//		INNER JOIN [EASYBUY].[dbo].[TbCompany]E ON E.Code = B.ComCode 
//		WHERE $status $Invoice A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%'
//                AND A.state = '1' AND C.lot_no = '$Lot' AND D.operator_name = '$Operator' AND A.DateSave 
//                BETWEEN '$datestart' AND '$dateend' ORDER BY A.DateSave";
//		
//		return $this->db->query($query)->result();
//	}
//        
        public function get_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T) {
        $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY  A.r_index DESC) AS row,
	        A.r_index,A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,A.vatamount,
		A.state,A.keytype,A.id_no,E.Lot,A.invoiceno ,D.operator_name
		FROM [$T].[dbo].[receive]A
		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
		INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
		INNER JOIN [$T].[dbo].[operator]D ON C.operator_id = D.operator_id
		INNER JOIN [EASYBUY].[dbo].[TbCompany]E ON E.Code = B.ComCode 
		WHERE $status $Invoice A.SaveEmpBy = '$username'
		AND A.contract_no LIKE '%$idcustomer%' AND A.state = '1' 
		AND C.lot_no = '$Lot' AND D.operator_name = '$Operator'
		 AND A.DateSave BETWEEN '$datestart' AND '$dateend')AA  ORDER BY DateSave ";

        return $this->db->query($query)->result();
    }

//    public function get_sum_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T) {
//        $query = "SELECT SUM(A.amount)AS amount,SUM(A.vatamount)AS vat
//		FROM [$T].[dbo].[receive]A
//		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
//		INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
//		INNER JOIN [$T].[dbo].[operator]D ON C.operator_id = D.operator_id
//		WHERE $status $Invoice A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%'
//                AND A.state = '1' AND C.lot_no = '$Lot' AND C.operator_id = '$Operator' AND A.DateSave
//                 BETWEEN '$datestart' AND '$dateend' ";
//
//        return $this->db->query($query)->result();
//    }
    
        public function get_sum_invoice($Lot, $Operator, $idcustomer, $datestart, $dateend, $username, $status, $Invoice, $T) {
        $query = "SELECT SUM(A.amount)AS amount,SUM(A.vatamount)AS vat
		FROM [$T].[dbo].[receive]A
		INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
		INNER JOIN [$T].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
		INNER JOIN [$T].[dbo].[operator]D ON C.operator_id = D.operator_id
		WHERE $status $Invoice A.SaveEmpBy = '$username' AND A.contract_no LIKE '%$idcustomer%'
                AND A.state = '1' AND C.lot_no = '$Lot' AND D.operator_name = '$Operator' AND A.DateSave
                 BETWEEN '$datestart' AND '$dateend' ";

        return $this->db->query($query)->result();
    }

    public function Textbath($amount) {
		$query = " SELECT  CORESYSTEM.dbo.convert_text('$amount') AS Textbath ";
		return $this->db->query($query)->result();
	}

	public function runinvoice($Lot_No,$YearMonth,$Operator,$desc_item,$T) {
		$query = " SELECT TOP 1 * FROM [$T].[dbo].[runinvoice]
		WHERE Lot = '$Lot_No' AND desc_item = '$desc_item' AND operator = '$Operator' ORDER BY YearMonth DESC ";
		return $this->db->query($query)->result();
	}

	public function runinvoice_insert($codenum,$Lot,$desc_item,$Operator,$YearMonth,$get_RunNo,$T) {
		$query = " INSERT INTO [$T].[dbo].[runinvoice] 
		(codenum,Lot,invoice,desc_item,operator,YearMonth,RunNo)
		VALUES ('$codenum','$Lot','0','$desc_item','$Operator','$YearMonth','$get_RunNo') ";
		return $this->db->query($query);
	}

	public function runinvoice_update($codenum,$Lot,$desc_item,$Operator,$YearMonth,$get_RunNo,$T) {
		$query = " UPDATE [$T].[dbo].[runinvoice] SET 
		RunNo='$get_RunNo' 
		WHERE Lot = '$Lot' AND desc_item = '$desc_item' AND operator = '$Operator' AND YearMonth = '$YearMonth'";
		return $this->db->query($query);
	}

	public function get_operator($op,$T) {
		$query = "SELECT TOP 1 * FROM [$T].[dbo].[operator] WHERE operator_name = '$op'";
		return $this->db->query($query)->result();
	}

	public function update_runinvoice($contract_no,$state,$IDCard,$num_Invoice,$Textbath,$refno2,$amount,$r_index,$T) {
		$query = "UPDATE [$T].[dbo].[receive]
		SET invoiceno = '$num_Invoice',bathtext = '$Textbath',state = '2' 
		WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND state = '$state' AND refno2 = '$refno2' AND amount = '$amount' AND r_index = '$r_index' ";
		return $this->db->query($query);
	}

//	public function daily($datestart,$lot,$Operator,$TT) {
//		$query = " SELECT  r.*,c.*,o.operator_name 
//		FROM [191.191.190.18].[$TT].[dbo].[receive] r
//		,[191.191.190.18].[$TT].[dbo].[customer] c
//		, [191.191.190.18].[$TT].[dbo].[operator] o 
//		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
//		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
//		AND r.rec_date = convert(Date,'$datestart')  
//		AND c.operator_id = o.operator_id  
//		AND operator_name in('$Operator') $lot 
//		order by r.rec_date ";
//		return $this->db->query($query)->result();
//	}
        
        public function daily($datestart, $Operator, $l, $T, $start, $pageend,$COUNT) {

        $query = "EXEC [dbo].[SP_TBL_DailyReceiveReport] '$datestart','$Operator','$l','$T','$start','$pageend','$COUNT'";

        return $this->db->query($query)->result();
    }

    public function daily_group($datestart,$lot,$Operator,$TT,$chennel) {
		$query = " SELECT  r.*,c.*,o.operator_name 
		FROM [191.191.190.18].[$TT].[dbo].[receive] r
		,[191.191.190.18].[$TT].[dbo].[customer] c
		, [191.191.190.18].[$TT].[dbo].[operator] o 
		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
		AND r.rec_date = convert(Date,'$datestart')  
		AND c.operator_id = o.operator_id  
		AND operator_name in('$Operator') $lot 
		AND r.chennel = '$chennel'
		order by r.rec_date ";
		return $this->db->query($query)->result();
	}

	public function daily_group_sum($datestart,$lot,$Operator,$TT,$chennel) {
		$query = " SELECT   SUM(r.amount)AS amount,SUM(r.vatamount)AS vatamount,SUM(r.amount)+SUM(r.vatamount)AS sumAV
		FROM [191.191.190.18].[$TT].[dbo].[receive] r
		,[191.191.190.18].[$TT].[dbo].[customer] c
		, [191.191.190.18].[$TT].[dbo].[operator] o 
		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
		AND r.rec_date = convert(Date,'$datestart')  
		AND c.operator_id = o.operator_id  
		AND operator_name in('$Operator') $lot 
		AND r.chennel = '$chennel'
		";
		return $this->db->query($query)->result();
	}

	public function get_daily_group_sum($datestart,$lot,$Operator,$TT) {
		$query = " SELECT   SUM(r.amount)AS amount,SUM(r.vatamount)AS vatamount,SUM(r.amount)+SUM(r.vatamount)AS sumAV
		FROM [191.191.190.18].[$TT].[dbo].[receive] r
		,[191.191.190.18].[$TT].[dbo].[customer] c
		, [191.191.190.18].[$TT].[dbo].[operator] o 
		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
		AND r.rec_date = convert(Date,'$datestart')  
		AND c.operator_id = o.operator_id  
		AND operator_name in('$Operator') $lot 
		";
		return $this->db->query($query)->result();
	}

	public function get_chennel($T) {
		$query = " SELECT *  FROM [$T].[dbo].[chennel] ";
		return $this->db->query($query)->result();
	}

	public function Summary_receive($M,$lot,$get_Operator,$TT) {
		$query = " SELECT  r.r_index,r.contract_no,r.id_no,r.chennel,r.rec_date,r.refno1,r.refno2,r.remark
		,case when r.chennel = 'AUCTION' Then Round(r.amount-(r.amount*7)/107,2) Else r.amount end AS amount
		, case when (r.chennel = 'AUCTION' OR r.chennel = 'CN') AND r.state = 4  Then 0 Else r.vatamount end AS vatamount 
		,r.invoiceno,r.state,r.keytype,r.bathtext,r.pay,r.SaveEmpBy,r.DateSave,r.ApproveEmpBy,r.DateApprove,c.*
		,o.operator_name 
		FROM [191.191.190.18].[$TT].[dbo].[receive] r
		,[191.191.190.18].[$TT].[dbo].[customer] c
		, [191.191.190.18].[$TT].[dbo].[operator] o   
		WHERE c.contract_no = r.contract_no and c.id_no = r.id_no and r.chennel not in ('DISCOUNT','REVOKE') 
		$lot 
		$get_Operator
		and r.state <> 3 and MONTH(r.rec_date) = MONTH('$M')
		and c.operator_id = o.operator_id 
		ORDER BY r.rec_date,r.amount
		";
		return $this->db->query($query)->result();
	}

	public function Summary_receive_between($datestartoperator,$datestartoperator2,$lot,$get_Operator,$T) {
		$query = "SELECT  r.r_index,r.contract_no,r.id_no,r.chennel,r.rec_date,r.refno1,r.refno2,r.remark
		,case when r.chennel = 'AUCTION' Then Round(r.amount-(r.amount*7)/107,2) Else r.amount end AS amount
		, case when (r.chennel = 'AUCTION' OR r.chennel = 'CN') AND r.state = 4  Then 0 Else r.vatamount end AS vatamount 
		,r.invoiceno,r.state,r.keytype,r.bathtext,r.pay,r.SaveEmpBy,r.DateSave,r.ApproveEmpBy,r.DateApprove,c.*
		,o.operator_name 
		FROM [$T].[dbo].[receive] r
		,[$T].[dbo].[customer] c
		, [$T].[dbo].[operator] o   
		WHERE c.contract_no = r.contract_no and c.id_no = r.id_no and r.chennel not in ('DISCOUNT','REVOKE') 
		$lot 
		$get_Operator
		and r.state <> 3 and r.rec_date between '$datestartoperator' and '$datestartoperator2'
		and c.operator_id = o.operator_id 
		ORDER BY r.rec_date,r.amount";
		return $this->db->query($query)->result();
	}
        
        
         public function Summary_receive_OperatorMonth($datestartoperator, $datestartoperator2, $Operator, $lot, $T, $start, $pageend, $Countcondition) {
            
             $query = "EXEC [SP_SUM_REPROT_OPERATORMONTH] '$datestartoperator','$datestartoperator2','$Operator','$lot','$T','$start','$pageend','$Countcondition'";
        
            return $this->db->query($query)->result();
    }

//      stored รวม 2 บริษัท jmt/jam
        public function Summary_receive_CN($datestartoperator,$datestartoperator2,$Operator,$lot,$T, $start, $pageend,$Countcondition){
		$query = "EXEC SP_SUM_REPROT_BY_CHENNEL '$datestartoperator','$datestartoperator2','%$Operator%','$lot','$T','$start','$pageend','$Countcondition'";
		return $this->db->query($query)->result();
	}

//	public function Summary_receive_CN_jam($M,$lot,$Operator){
//		$query = " exec SP_SUM_REPROT_BY_CHENNEL_JAM '$M','$lot','%$Operator%' ";
//		return $this->db->query($query)->result();
//	}

//	public function Summary_receive_CN_jmt($M,$lot,$Operator){
//		$query = " exec SP_SUM_REPROT_BY_CHENNEL_JMT '$M','$lot','%$Operator%' ";
//		return $this->db->query($query)->result();
//	}
        
        public function Summary_receive_OP($M,$lot,$Operator){
		$query = "EXEC SP_SUM_REPROT_BY_PROCUCT '$M','$lot','%$Operator%' ";
		return $this->db->query($query)->result();
	}

//	public function Summary_receive_OP_jam($M,$lot,$Operator){
//		$query = " exec SP_SUM_REPROT_BY_PROCUCT_JAM '$M','$lot','%$Operator%' ";
//		return $this->db->query($query)->result();
//	}

//	public function Summary_receive_OP_jmt($M,$lot,$Operator){
//		$query = " exec SP_SUM_REPROT_BY_PROCUCT_JMT '$M','$lot','%$Operator%' ";
//		return $this->db->query($query)->result();
//	}
        public function report_discount($status,$Operator,$lot,$date){
		$query = "EXEC SP_Discount_Report '$date','$lot','$Operator','$status' ";
		return $this->db->query($query)->result();
	}

//	public function report_discount_jam($status,$Operator,$lot,$date){
//		$query = " exec SP_Discount_Report_JAM '$date','$lot','$Operator','$status' ";
//		return $this->db->query($query)->result();
//	}

//	public function report_discount_jmt($status,$Operator,$lot,$date){
//		$query = " exec SP_Discount_Report_JMT '$date','$lot','$Operator','$status' ";
//		return $this->db->query($query)->result();
//	}

	public function Tax_jam($Operator,$lot,$date){
		$query = " exec SP_Tax_Report_JAM '$date','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Tax_jmt($Operator,$lot,$date){
		$query = " exec SP_Tax_Report_JMT '$date','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Outstanding_jam($Operator,$lot,$date){
		$query = " exec SP_Outstanding_Report_JAM '$date','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Outstanding_jmt($Operator,$lot,$date){
		$query = " exec SP_Outstanding_Report_JMT '$date','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Export_Excelt_jam($Operator,$lot,$datestart,$dateend){
		$query = " exec SP_Daily_receive_Export_JAM '$datestart','$dateend','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Export_Excelt_jmt($Operator,$lot,$datestart,$dateend){
		$query = " exec SP_Daily_receive_Export_JMT '$datestart','$dateend','$lot','$Operator' ";
		return $this->db->query($query)->result();
	}

	public function Daily_updated_jam($status,$Operator,$lot,$datestart,$dateend){
		$query = " exec SP_Daily_updated_JAM '$datestart','$dateend','$lot','$Operator','$status' ";
		return $this->db->query($query)->result();
	}

	public function Daily_updated_jmt($status,$Operator,$lot,$datestart,$dateend){
		$query = " exec SP_Daily_updated_JMT '$datestart','$dateend','$lot','$Operator','$status' ";
		return $this->db->query($query)->result();
	}

}