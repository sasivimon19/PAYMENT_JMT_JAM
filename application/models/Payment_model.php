<?php

class Payment_model extends CI_MODEL
{

    public function __construct()
    {
        parent::__construct();
    }

    public function can_login($username, $password)
    {

        $query = $this->db->query("SELECT C.username,C.company,A.Subject_Right,B.Subject,D.id_run
        FROM [JAM].[dbo].[TBL_Right] A 
		INNER JOIN [JAM].[dbo].[TBL_Menu] B ON A.Right_Level = B.Rights
		INNER JOIN [JAM].[dbo].[user_log] C ON A.Right_Level = C.user_level
		INNER JOIN [JAM].[dbo].[TBL_User_menu] D ON C.id_run = D.id_run
		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'
		GROUP BY C.username,C.company,A.Subject_Right,B.Subject,D.id_run
		
		union all  	

		SELECT C.username,C.company,A.Subject_Right,B.Subject,D.id_run 
        FROM [JMTLOAN_PROD].[dbo].[TBL_Right] A 
		INNER JOIN [JMTLOAN_PROD].[dbo].[TBL_Menu] B ON 	A.Right_Level = B.Rights
		INNER JOIN [JMTLOAN_PROD].[dbo].[user_log] C ON A.Right_Level = C.user_level
	    INNER JOIN [JMTLOAN_PROD].[dbo].[TBL_User_menu] D ON C.id_run = D.id_run
		Where C.username ='$username' AND C.password ='$password' AND C.user_status = '1'
		GROUP BY C.username,C.company,A.Subject_Right,B.Subject,D.id_run");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function username($username, $companyses)
    {
        $query = "SELECT * FROM [JAM].[dbo].[TBL_Right]A
		INNER JOIN [JAM].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username' AND C.company = '$companyses'

		union all  	

		SELECT * FROM [JMTLOAN_PROD].[dbo].[TBL_Right]A
		INNER JOIN [JMTLOAN_PROD].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.username ='$username' AND C.company = '$companyses'";
        return $this->db->query($query)->result();
    }

    public function Current_date()
    {
        $query = "SELECT convert(smalldatetime,GETDATE()) AS Currentdate";
        return $this->db->query($query)->result();
    }

    public function username_menu($T, $username)
    {
        $query = "SELECT * FROM [$T].[dbo].[user_log]A
		INNER JOIN [$T].[dbo].[TBL_User_menu]B  ON A.id_run = B.id_run
		INNER JOIN [$T].[dbo].[TBL_Menu]C ON B.id_menu = C.ID
                LEFT JOIN [$T].[dbo].[TBL_Right] D ON A.user_level = D.Right_Level
		WHERE A.username ='$username' AND [Status_active] = 'Active' Order By num ASC";
        return $this->db->query($query)->result();
    }

    public function username_menu_ID($T, $id)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_Right]A
		INNER JOIN [$T].[dbo].[TBL_Menu]B ON 	A.Right_Level = B.Rights
		INNER JOIN [$T].[dbo].[user_log]C ON A.Right_Level = C.user_level
		Where C.id_run ='$id' AND [Status_active] = 'Active' Order By num ASC";
        return $this->db->query($query)->result();
    }

    public function getall_customer($T, $contract, $com)
    {
        $query = "SELECT A.id_no, A.cus_name, A.lot_no, A.product, A.address1, A.address2, A.province,A.postal,
		A.b_balance,A.e_balance,B.operator_name, B.operator_value,A.status,A.company,B.company,A.contract_no
		FROM [$T].[dbo].[customer]A
		INNER JOIN [$T].[dbo].[operator]B
		ON A.operator_id = B.operator_id 
		WHERE  A.contract_no = '$contract'
         --AND B.company = '$com'
         ";
        return $this->db->query($query)->result();
    }

    public function get_customer($T, $wherecustomer)
    {

        $query = "SELECT * FROM (SELECT ROW_NUMBER () OVER(ORDER BY lot_no DESC) 
                    AS row,A.contract_no,A.id_no, A.cus_name,A.lot_no, A.product, A.address1,
                    A.address2, A.province,A.postal, A.b_balance,A.e_balance,B.operator_name,
                    B.operator_value,A.status,B.company FROM [$T].[dbo].[customer]A 
                    INNER JOIN [$T].[dbo].[operator]B ON A.operator_id = B.operator_id 
                    $wherecustomer)CC";

        return $this->db->query($query)->result();
    }

    public function get_Countcustomer($T, $wherecustomer)
    {
        $query = "SELECT COUNT(A.id_no)AS Count FROM [$T].[dbo].[customer]A 
                    INNER JOIN [$T].[dbo].[operator]B ON A.operator_id = B.operator_id 
                    $wherecustomer";
        return $this->db->query($query)->result();
    }

    public function receive($T, $contract, $com)
    {
        $query = "SELECT sum(case chennel WHEN  'REFUND' THEN -Amount ELSE Amount END)amount
		,sum(vatamount)vatamount
		FROM [$T].[dbo].[receive]
		where contract_no ='$contract' 
       -- AND company = '$com' 
        group by contract_no ";

        return $this->db->query($query)->result();
    }

    public function receiveTB($T, $contract, $com)
    {
        $query = "SELECT * FROM (
		SELECT ROW_NUMBER() OVER (Order by contract_no)
		As No,r_index,Rec_date
		AS DateReceive,Chennel,Refno1,Refno2,Amount,Vatamount,Invoiceno,State
		,Keytype,SaveEmpBy,DateSave,ApproveEmpBy,DateApprove,Remark,Company
		FROM [$T].[dbo].[receive]	
		Where contract_no = '$contract' 
        -- AND company = '$com'
		)A  ORDER BY A.DateReceive DESC";
        return $this->db->query($query)->result();
    }

    public function company($com)
    {
        $query = "SELECT * FROM [JMTLOAN_PROD].[dbo].[jmtdata] Where code ='$com'

		union all

		SELECT * FROM [JAM].[dbo].[jmtdata] Where code ='$com'";

        return $this->db->query($query)->result();
    }

    public function update_company($id, $name, $address, $taxno, $taxrate, $T, $tb)
    {
        $query = "UPDATE [$T].[dbo].[$tb] SET 
		name='$name',
		address='$address',
		taxno='$taxno',
		taxrate='$taxrate'
		WHERE comid = '$id'";
        return $this->db->query($query);
    }

    //insent Tmp upload file bank
    public function loadpayment_insert($Date, $Agreement, $IDCard, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $T)
    {
        $sql = "INSERT INTO [$T].[dbo].[TBL_Payment_Simulate] (Date1,Agreement,IDCard,Channel,
                Ref1,Ref2,Amount,Lot,Remark,Masterkey)
		VALUES ('$Date',LTRIM(RTRIM('$Agreement')),LTRIM(RTRIM('$IDCard')),'$Channel','$Ref1','$Ref2','$Amount','$Lot','$Remark','$username')";
        return $this->db->query($sql);
    }

    //insent upload file bank ไปของจริง  receive
    // public function loadpayment_insert_FN($Date1, $Contract_No, $id_no, $Channel, $Ref1, $Ref2, $Amount, $Lot, $Remark, $username, $dateSv, $operator_name, $VAT, $company, $T)
    // {
    //     $sql = "INSERT INTO [$T].[dbo].[receive] (rec_date,contract_no,chennel,refno1,refno2,amount,SaveEmpBy,vatamount,invoiceno,state,keytype,bathtext,DateSave,id_no,company)
    // 	VALUES ('$Date1', RTRIM(LTRIM('$Contract_No')),'$Channel','$Ref1','$Ref2','$Amount','$username','$VAT','none','0','1','-none-','$dateSv', RTRIM(LTRIM('$id_no')),'$company')";
    //     return $this->db->query($sql);
    // }

    //insent upload file bank ไปของจริง  receive
    public function loadpayment_insert_FN($T, $Date1, $Contract_No, $Channel, $Ref1, $Ref2, $Amount, $username, $VAT, $dateSv, $id_no, $company, $Remark)
    {

        $query = "EXEC [dbo].[SP_INSERT_PAYMENT_RECEIVE] '$T','$Date1', '$Contract_No','$Channel', '$Ref1', '$Ref2', '$Amount','$username','$VAT', '$dateSv','$id_no','$company','$Remark'";

        return $this->db->query($query)->result();
    }

    public function delete_simulate($T, $username)
    {

        $query = "DELETE FROM [$T].[dbo].[TBL_Payment_Simulate] WHERE Masterkey = '$username'";

        return $this->db->query($query);
    }

    public function simulate_view($T, $username)
    {

        $query = "SELECT * FROM [$T].[dbo].[TBL_Payment_Simulate] Where Masterkey ='$username'";

        return $this->db->query($query)->result();
    }

    //  stored select check เงื่อนไขการ upload
    public function search_loadpayment_not_F($username_ST, $username, $T, $start, $pageend, $Countcondition)
    {

        $query = "EXEC [dbo].[SP_TBL_Check_Date] '$username_ST','$username','$T','$start','$pageend','$Countcondition'";

        return $this->db->query($query)->result();
    }

    //    public function get_reindex($T, $Agreement, $IDCard) {
    //        $query = "SELECT  A.[r_index],A.chennel FROM [$T].[dbo].[receive] A 
    //        INNER JOIN [JMTLOAN_PROD_NEW].[dbo].[customer] B ON A.contract_no = B.contract_no AND A.id_no = B.id_no
    //        INNER JOIN [EASYBUY].[dbo].[TbCurrent] C ON A.contract_no = C.Refferent1 AND A.id_no = C.Refferent2
    //        where A.chennel = 'CN' AND A.contract_no = '$Agreement' AND A.id_no = '$IDCard'";
    //        return $this->db->query($query)->result();
    //    }

    public function get_Date_F($username)
    {
        $query = "SELECT * FROM [JAM_Restore].[dbo].[TBL_Payment_Simulate]A 
		LEFT JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent2 = A.IDCard AND B.Refferent1 = A.Agreement AND month(A.Date1) = month(GETDATE ()) AND A.Date1 <= GETDATE ()
		Where B.AccNo is null AND A.Masterkey = '$username'";
        return $this->db->query($query)->result();
    }

    public function dateserver()
    {
        $query = "SELECT GETDATE ()AS Currentdate";
        return $this->db->query($query)->result();
    }

    public function payment_channel($T)
    {
        $query = "SELECT * FROM [$T].[dbo].[chennel] ORDER BY date_insert DESC";

        return $this->db->query($query)->result();
    }

    public function insert_channel($code, $detail, $dateSv, $T, $status)
    {
        $query = " INSERT INTO [$T].[dbo].[chennel] 
		(code,chennel,date_insert,status)
		VALUES ('$code','$detail','$dateSv','$status') ";
        return $this->db->query($query);
    }

    public function status_channel($id, $T)
    {
        $query = "SELECT * FROM [$T].[dbo].[chennel] where IDChennel = '$id'";
        return $this->db->query($query)->result();
    }

    public function status_update_channel($id, $new_status, $T)
    {
        $query = " UPDATE [$T].[dbo].[chennel]
		SET status='$new_status' WHERE IDChennel = '$id'";
        return $this->db->query($query);
    }

    public function delete_channel($ID, $T)
    {
        $query = " DELETE FROM [$T].[dbo].[chennel] WHERE IDChennel = '$ID'";
        return $this->db->query($query);
    }

    public function Pic_update($Photo, $id, $T)
    {
        $query = "UPDATE  [$T].[dbo].[jmtdata] SET 
		pic = '$Photo' 
		WHERE comid = '$id'";
        return $this->db->query($query);
    }

    public function Pic_delete($id, $T)
    {
        $query = "UPDATE [$T].[dbo].[jmtdata] SET 
		pic = NULL 
		WHERE comid = '$id'";
        return $this->db->query($query);
    }

    public function user_setting($T)
    {
        $query = "SELECT * FROM [$T].[dbo].[user_log]C
		INNER JOIN [$T].[dbo].[TBL_Right]A ON A.Right_Level = C.user_level
		ORDER BY C.name DESC";
        return $this->db->query($query)->result();
    }

    public function get_user_setting($T, $id)
    {
        $query = "SELECT * FROM [$T].[dbo].[user_log]C
		INNER JOIN [$T].[dbo].[TBL_Right]A ON A.Right_Level = C.user_level
		WHERE id_run = '$id'";
        return $this->db->query($query)->result();
    }

    public function setting_insert($T, $name, $Username, $Password, $user_status, $company, $Rights)
    {
        $sql = "INSERT INTO [$T].[dbo].[user_log] 
		(name,username,password,user_status,user_level,company,chkPeriod,permission)
		VALUES ('$name','$Username','$Password','$user_status','$Rights','$company','1','1')";
        return $this->db->query($sql);
    }

    public function setting_update($T, $id, $name, $Username, $Password, $company, $Rights, $key, $chkPeriod)
    {
        $sql = "UPDATE [$T].[dbo].[user_log] 
                    SET name = '$name', username = '$Username',password = '$Password',
                    company = '$company',user_level = '$Rights',menu = '$key',chkPeriod = '$chkPeriod'
                    WHERE id_run = '$id'";
        return $this->db->query($sql);
    }

    public function setting_menu($T, $id, $key)
    {
        $sql = "INSERT INTO [$T].[dbo].[TBL_User_menu] 
		(id_run,id_menu)
		VALUES ('$id','$key')";
        return $this->db->query($sql);
    }

    public function setting_menu_view($T, $id)
    {
        $query = "SELECT * FROM [$T].[dbo].[TBL_User_menu] WHERE id_run = '$id'";
        return $this->db->query($query)->result();
    }

    public function setting_delete($T, $id)
    {
        $sql = "DELETE [$T].[dbo].[TBL_User_menu] 
		WHERE id_run = '$id'";
        return $this->db->query($sql);
    }

    public function setting_status($T, $id)
    {
        $query = "SELECT *  FROM [$T].[dbo].[user_log] where id_run = '$id'";
        return $this->db->query($query)->result();
    }

    public function setting_status_update($T, $id, $new_status)
    {
        $query = "UPDATE [$T].[dbo].[user_log]
		SET user_status='$new_status' WHERE id_run = '$id'";

        return $this->db->query($query);
    }

    public function rights($T)
    {
        $query = "SELECT *  FROM [$T].[dbo].[TBL_Right] ORDER BY Right_Level ASC";
        return $this->db->query($query)->result();
    }

    public function rights_ID($T, $num)
    {
        $query = "SELECT *  FROM [$T].[dbo].[TBL_Right] WHERE Right_Level = '$num'";
        return $this->db->query($query)->result();
    }

    public function operator($T)
    {
        $query = "SELECT operator_name  FROM [$T].[dbo].[operator] GROUP BY operator_name";

        return $this->db->query($query)->result();
    }

    // public function get_operator_id($T,$Operator)
    // {
    //     $query = "SELECT operator_id FROM [$T].[dbo].[operator] where operator_name = '$Operator'";

    //     return $this->db->query($query)->result();
    // }

    public function operator_product($T)
    {
        $query = "SELECT * FROM [$T].[dbo].[operator]  ORDER BY operator_name ASC";
        return $this->db->query($query)->result();
    }

    public function id_customer($IDCard, $Agreement, $T)
    {
        $query = "SELECT B.operator_name,B.operator_value FROM [$T].[dbo].[customer]A	
		INNER JOIN [$T].[dbo].[operator]B
		ON A.operator_id = B.operator_id 
		WHERE A.id_no = '$IDCard' AND A.contract_no = '$Agreement'";
        return $this->db->query($query)->result();
    }

    public function get_current($contract_no, $IDCard)
    {
        $query = "SELECT * FROM [EASYBUY].[dbo].[TbCurrent] 
		WHERE Refferent2 = '$IDCard' AND Refferent1 = '$contract_no'";
        return $this->db->query($query)->result();
    }

    public function update_current($OSbalance, $contract_no, $IDCard)
    {
        $query = "UPDATE [EASYBUY].[dbo].[TbCurrent] 
		SET OSbalance = '$OSbalance', Emp = (case when CAST(CAST ('$OSbalance' AS NUMERIC) AS INT) <= 0 Then 'CLOSE' Else Emp end) 
                WHERE Refferent2 = '$IDCard' AND Refferent1 = '$contract_no'";
        return $this->db->query($query);
    }

    public function update_customer($T, $e_balance, $contract_no, $IDCard)
    {
        $query = "UPDATE [$T].[dbo].[customer]
		SET e_balance = '$e_balance',status = (case when CAST(CAST ('$e_balance' AS NUMERIC) AS INT) <= 0 Then 'CLOSE' Else status end) 
		where contract_no = '$contract_no' And id_no = '$IDCard'";
        return $this->db->query($query);
    }

    public function get_receive($T, $contract_no, $IDCard)
    {
        $query = "SELECT * FROM [$T].[dbo].[receive] 
		WHERE contract_no = '$contract_no' AND id_no = '$IDCard' AND chennel = 'DISCOUNT' AND state = 1";
        return $this->db->query($query)->result();
    }

    public function get_r_indexreceive($T, $contract_no, $IDCard)
    {
        $query = "SELECT  A.[ID_Key]
                ,B.r_index
                ,A.[contract_no]
                ,A.[id_no]
                ,B.contract_no
                ,B.id_no
            FROM [JMTLOAN_PROD_NEW].[dbo].[customer] A 
            INNER JOIN  [JMTLOAN_PROD_NEW].[dbo].[receive] B ON A.contract_no = B.contract_no  AND A.id_no = B.id_no
            where A.contract_no = '$contract_no' AND A.id_no = '$IDCard' AND state = 1";
        return $this->db->query($query)->result();
    }

    public function update_receive($contract_no, $IDCard, $dateSv, $T, $username)
    {
        $query = "UPDATE [$T].[dbo].[receive]
		SET state = '1'
                ,[ApproveEmpBy] = '$username'
                ,[DateApprove] = '$dateSv'
                WHERE id_no = '$IDCard' AND contract_no = '$contract_no'";
        return $this->db->query($query);
    }

    public function update_receive_discount($T, $contract_no, $IDCard, $dateSv, $r_index, $username)
    {
        $query = "UPDATE [$T].[dbo].[receive]
		SET state = '1',[ApproveEmpBy] = '$username',[DateApprove] = '$dateSv'
                WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND r_index = '$r_index'";
        return $this->db->query($query);
    }

    public function update_r_index($T, $c, $IC, $r_index, $dateSv, $username)
    {
        $query = "UPDATE [$T].[dbo].[receive]
		SET state = '3',refno1 = '$r_index',[ApproveEmpBy] = '$username',[DateApprove] = '$dateSv'
                WHERE id_no = '$IC' AND contract_no = '$c' AND chennel = 'ADJUST'";
        return $this->db->query($query);
    }

    public function getupdatecustomer($T, $contract_no, $IDCard)
    {
        $query = "SELECT * FROM [$T].[dbo].[customer] 
                  where contract_no = '$contract_no' And id_no = '$IDCard'";
        return $this->db->query($query)->result();
    }

    //  show status tab รายการที่ไม่ได้ Approve  / New_Receive , รายการที่ไม่ได้ Approve  / CN , รายการที่ไม่ได้ Approve  / DISCOUNT 
    //  รายการที่ไม่ได้ Approve  / ADJUST , รายการที่ไม่ได้ Approve  / REFUND  ,รายการที่ไม่ได้ Approve  / REFUND   
    public function Count_Check_Approve($T, $com, $username, $Countcondition)
    {

        $query = "EXEC [SP_Count_Check_Approve] '$T','$com','$username','$Countcondition'";

        return $this->db->query($query)->result();
    }

    //select data ค้นหา  รายการที่ไม่ได้ Approve  / New_Receive , รายการที่ไม่ได้ Approve  / CN , รายการที่ไม่ได้ Approve  / DISCOUNT 
    //  รายการที่ไม่ได้ Approve  / ADJUST , รายการที่ไม่ได้ Approve  / REFUND  ,รายการที่ไม่ได้ Approve  / REFUND   
    public function Select_Approve($T, $username, $status, $contract_no, $Operatorname, $datestart, $dateend, $start, $pageend)
    {
        $query = "EXEC [dbo].[SP_Select_Approve] '$T','$username','$status','$contract_no','$Operatorname','$datestart','$dateend',$start, $pageend";

        return $this->db->query($query)->result();
    }

    // select data Sum ยอด ตัดยอดรับชำระ Approve / Approve,ApproveALL  / New_Receive, New_ReceiveALL / CN , CNALL / DISCOUNT 
    //  ADJUST , ADJUSTALL  / REFUND  ,REFUNDALL  / REFUND, REFUNDALL 
    public function Select_Approve_Sum($T, $username, $status, $contract_no, $Operatorname, $datestart, $dateend, $start, $pageend)
    {
        $query = "EXEC [dbo].[SP_Select_Approve_Count]'$T','$username','$status','$contract_no','$Operatorname','$datestart','$dateend',$start, $pageend";

        return $this->db->query($query)->result();
    }

    // select data Export ของหน้า  ตัดยอดรับชำระ Approve / Approve,ApproveALL  / New_Receive, New_ReceiveALL / CN , CNALL / DISCOUNT 
    //  ADJUST , ADJUSTALL  / REFUND  ,REFUNDALL  / REFUND, REFUNDALL  
    public function Export_Select_Approve($status, $username, $datestart, $dateend, $contract_no, $Operatorname, $T)
    {
        $query = "EXEC [dbo].[SP_EXPORT_PAYMENT] '$status', '$username','$datestart', '$dateend', '$contract_no','$Operatorname','$T'";

        return $this->db->query($query)->result();
    }


    //select invoice 
    // public function get_invoice($Lot, $Operator, $contract_no, $datestart, $dateend, $status, $Invoice, $T)
    // {
    //     $query = "SELECT A.r_index,A.DateSave,A.chennel,A.contract_no,A.refno1,A.refno2,A.amount,
    //     A.vatamount,A.state,A.keytype,A.id_no,E.Lot,A.invoiceno ,D.operator_name,A.rec_date,D.operator_id
    //     ,[JMTLOAN_PROD_NEW].[dbo].[convert_text](case when A.amount < 0 then -(A.amount) else amount end) AS Textbath
    // 	FROM [JMTLOAN_PROD_NEW].[dbo].[receive]A
    // 	INNER JOIN [EASYBUY].[dbo].[TbCurrent]B ON B.Refferent1 = A.contract_no AND B.Refferent2 = A.id_no
    // 	INNER JOIN [JMTLOAN_PROD_NEW].[dbo].[customer]C ON C.id_no = A.id_no AND C.contract_no = B.AccNo
    // 	INNER JOIN [JMTLOAN_PROD_NEW].[dbo].[operator]D ON C.operator_id = D.operator_id
    // 	INNER JOIN [EASYBUY].[dbo].[TbCompany]E ON E.Code = B.ComCode 
    // 	WHERE $status $Invoice  A.contract_no = '$contract_no' 
    //     AND A.state = '1' AND C.lot_no = '$Lot' AND D.operator_name = '$Operator' AND A.rec_date 
    //     BETWEEN CONVERT(date, '$datestart') AND  CONVERT(date, '$dateend')  ORDER BY A.DateSave";

    //     return $this->db->query($query)->result();
    // }

    public function get_invoice($T, $Lot, $contract_no, $Operator,  $datestart, $dateend, $status, $Invoice)
    {
        $query = "EXEC [dbo].[SP_Select_Invoice_New] '$T','$Lot','$contract_no','$Operator','$datestart','$dateend','$status', '$Invoice'";

        return $this->db->query($query)->result();
    }


    // stored ตัดยอดรับชำระ Approve ส่งตัวแปร ไป 7 ตัว 1.database 2.ชื่อผู้บันทึก/Approve 3.contract_no 4. วันที่ค้นหา(วันที่รับpay) 5.วันที่สิ้นสุดค้นหา 6.ตัวแปรการรับชำระ
    public function Approve_Pay($T, $r_index, $username)
    {

        $query = "EXEC [dbo].[SP_Approve_Pay] '$T','$r_index','$username'";

        return $this->db->query($query)->result();
    }

    //ฟังชั่นแสดงยอดเงินเป็นภาษาไทย
    public function Textbath($T, $amount)
    {
        $query = "SELECT [$T].[dbo].[convert_text]('$amount') AS Textbath ";
        return $this->db->query($query)->result();
    }

    // select top 1
    public function runinvoice($get_Lot, $YearMonth, $Operator, $desc_item, $T)
    {
        $query = "SELECT TOP 1 * FROM [$T].[dbo].[runinvoice]
		WHERE Lot = '$get_Lot' AND desc_item = '$desc_item' AND operator = '$Operator' ORDER BY YearMonth DESC ";
        return $this->db->query($query)->result();
    }

    public function runinvoice_insert($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T)
    {
        $query = "INSERT INTO [$T].[dbo].[runinvoice] 
		(codenum,Lot,invoice,desc_item,operator,YearMonth,RunNo)
		VALUES ('$codenum','$Lot','0','$desc_item','$Operator','$YearMonth','$get_RunNo')";
        return $this->db->query($query);
    }

    public function runinvoice_update($codenum, $Lot, $desc_item, $Operator, $YearMonth, $get_RunNo, $T)
    {
        $query = "UPDATE [$T].[dbo].[runinvoice] SET 
		RunNo='$get_RunNo' 
		WHERE Lot = '$Lot' AND desc_item = '$desc_item' AND operator = '$Operator' AND YearMonth = '$YearMonth'";
        return $this->db->query($query);
    }

    public function get_operator($op, $T)
    {
        $query = "SELECT TOP 1 * FROM [$T].[dbo].[operator] WHERE operator_name = '$op'";
        return $this->db->query($query)->result();
    }

    public function update_runinvoice($contract_no, $state, $IDCard, $num_Invoice, $Textbath, $refno2, $amount, $r_index, $T)
    {
        $query = "UPDATE [$T].[dbo].[receive]
		SET invoiceno = '$num_Invoice',bathtext = '$Textbath',state = '2' 
		WHERE id_no = '$IDCard' AND contract_no = '$contract_no' AND state = '$state'
         AND refno2 = '$refno2' AND amount = '$amount' AND r_index = '$r_index'";
        return $this->db->query($query);
    }

    public function daily_group($datestart, $lot, $Operator, $TT, $chennel)
    {
        $query = "SELECT  r.*,c.*,o.operator_name 
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

    public function daily_group_sum($datestart, $lot, $Operator, $TT, $chennel)
    {
        $query = "SELECT   SUM(r.amount)AS amount,SUM(r.vatamount)AS vatamount,SUM(r.amount)+SUM(r.vatamount)AS sumAV
		FROM [$TT].[dbo].[receive] r
		,[$TT].[dbo].[customer] c
		,[$TT].[dbo].[operator] o 
		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
		AND r.rec_date = convert(Date,'$datestart')  
		AND c.operator_id = o.operator_id  
		AND operator_name in('$Operator') $lot 
		AND r.chennel = '$chennel'
		";
        return $this->db->query($query)->result();
    }

    public function get_daily_group_sum($datestart, $lot, $Operator, $TT)
    {
        $query = " SELECT  SUM(r.amount)AS amount,SUM(r.vatamount)AS vatamount,SUM(r.amount)+SUM(r.vatamount)AS sumAV
		FROM [191.191.190.18].[$TT].[dbo].[receive] r
		,[191.191.190.18].[$TT].[dbo].[customer] c
		, [191.191.190.18].[$TT].[dbo].[operator] o 
		WHERE c.contract_no = r.contract_no  AND r.state <> 3 AND r.state <> 0 
		AND r.chennel NOT IN ('DISCOUNT' ,'REFUND' ,'ADJUST','REVOKE' ,'AUCTION') 
		AND r.rec_date = convert(Date,'$datestart')  
		AND c.operator_id = o.operator_id  
		AND operator_name in('$Operator') $lot ";

        return $this->db->query($query)->result();
    }

    public function get_chennel($T)
    {
        $query = " SELECT *  FROM [$T].[dbo].[chennel] ";
        return $this->db->query($query)->result();
    }

    public function Summary_receive($M, $lot, $get_Operator, $TT)
    {
        $query = "SELECT  r.r_index,r.contract_no,r.id_no,r.chennel,r.rec_date,r.refno1,r.refno2,r.remark
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
		ORDER BY r.rec_date,r.amount";
        return $this->db->query($query)->result();
    }

    public function Summary_receive_between($datestartoperator, $datestartoperator2, $lot, $get_Operator, $T)
    {
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



    public function daily($com, $lot, $Operator, $Type, $datestart)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'Daily','$com','$lot','$Operator','$Type','$datestart',NULL,NULL,'0','0'";

        return $this->db->query($query)->result();
    }

    // Summary Receive By Operator Month (JAM เลือก 1 product)
    public function Summary_receive_OperatorMonth($NameReport, $com, $lot, $Operator, $Type, $datestartoperator, $datestartoperator2)
    {

        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] '$NameReport','$com','$lot','$Operator','$Type','$datestartoperator','$datestartoperator2','NULL','0','0'";

        return $this->db->query($query)->result();
    }

    // ReceiveChanelDaily 
    public function SUM_REPROT_BY_CHENNEL($NameReport, $com, $Operator, $Type, $datestart)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] '$NameReport','$com',NULL,'$Operator','$Type','$datestart',NULL,'NULL','0','0'";

        return $this->db->query($query)->result();
    }

    public function SUM_REPROT_BY_PROCUCT($NameReport, $com, $Operator, $Type, $datestartoperator)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] '$NameReport','$com',NULL,'$Operator','$Type','$datestartoperator',NULL,'NULL',0,0";

        return $this->db->query($query)->result();
    }

    // Summary Discount Report 
    public function report_discount($com, $lot, $Operator, $Type, $date, $status)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'SummaryDiscount','$com','$lot','$Operator','$Type','$date',NULL,'$status',0,0";

        return $this->db->query($query)->result();
    }

    public function Tax_report($com, $lot, $Operator, $Type, $date, $date2)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'Tax','$com','$lot','$Operator','$Type','$date','$date2',NULL,'0','0'";

        return $this->db->query($query)->result();
    }

    public function SumTax_report($com, $lot, $Operator, $Type, $date, $dateendsumtex)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'SumTax','$com','$lot','$Operator','$Type','$date','$dateendsumtex',NULL,'0','0'";

        return $this->db->query($query)->result();
    }

    //Outstanding Report(Detail)
    public function Outstanding_Detail($com, $lot, $Operator, $Type, $date, $start, $pageend)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'Outstanding','$com','$lot','$Operator','$Type','$date',NULL,NULL,$start,$pageend";
        return $this->db->query($query)->result();
    }


    public function Count_Outstanding_Detail($com, $lot, $Operator, $Type, $date)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'CountOutstanding','$com','$lot','$Operator','$Type','$date',NULL,NULL,0,0";

        return $this->db->query($query)->result();
    }

    public function Total_Outstanding_Detail($com, $lot, $Operator, $Type, $date)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'TotalOutstanding','$com','$lot','$Operator','$Type','$date',NULL,'NULL',0,0";

        return $this->db->query($query)->result();
    }

    // Outstanding (Summary)
    public function Outstanding_SumOutstanding($com, $lot, $Operator, $Type, $date)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'SumOutstanding','$com','$lot','$Operator','$Type','$date',NULL,'NULL',0,0";

        return $this->db->query($query)->result();
    }

    public function Export_Excelt($com, $lot, $Operator, $Type, $datestart, $dateend)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] 'ExportExcel','$com','$lot','$Operator','$Type','$datestart','$dateend','NULL',0,0";

        return $this->db->query($query)->result();
    }

    // รายการปรับปรุงข้อมูลรายวัน
    public function Daily_updated($NameReport, $com, $Operator, $Type, $datestart, $dateend, $status)
    {
        $query = "EXEC [dbo].[SP_REPORT_PAYMENT_SYSTEM] '$NameReport','$com',NULL,'$Operator','$Type','$datestart','$dateend','$status',0,0";

        return $this->db->query($query)->result();
    }

    // ใบเสร็จ / ใบกำกับ
    public function EXPORT_TAX_INVOICE($Type, $lot, $Operator, $datestart, $dateend, $T)
    {
        $query = "EXEC [dbo].[SP_REPORT_TAX_INVOICE] '$Type','$lot','$Operator','$datestart','$dateend','$T'";

        return $this->db->query($query)->result();
    }


    public function Delete_scan_one($T, $whereLength, $username)
    {

        $query = "DELETE FROM [$T].[dbo].[receive]  where $whereLength
        AND [SaveEmpBy] = '$username' AND [state] = '0'";

        return $this->db->query($query);
    }
}
