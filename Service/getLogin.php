<?php
	include("config.php");
	$user = $_GET['txtUsername'];
	$password = $_GET['txtPassword'];
    $ID="";
  	$response="";
  	$ip="";
  	$check="";
	date_default_timezone_set('Asia/Bangkok');
	$dates = date('Y-m-d H:i:s');
	$IsSignOn='1';
  
  if($user){
	 	include("config.php");
		$stmt = "select distinct AccountCode,FirstName,LastName,b.BranchGroupID,emp.BranchID,BranchNameTH,r.RoleDesc,SignOnIPAddress,
CASE WHEN IsSignOn IS NULL THEN 0  ELSE IsSignOn END as IsSignOn,
CASE WHEN '".$dates."' between EffectiveDate and ExpireDate THEN '#1' ELSE '#2' END as Checked
from ((uac_useraccount acc left join (uac_employee emp left join mas_branch b on emp.BranchID=b.BranchID)
on acc.AccountCode=emp.EmployeeCode) left join (uac_userpermission userp left join uac_programcode pgc on userp.ProgramCode=pgc.ProgramCode) 
on acc.UserAccountCode=userp.UserAccountCode
left join uac_role r on acc.RoleCode=r.RoleCode) inner join uac_rolepermission rpm on acc.RoleCode=rpm.RoleCode 
where acc.Username='".$user."' AND acc.Password='".$password."' and (AccoutType=2 OR AccoutType=1)
and ProgramName='Web_report'";
    	$query = sqlsrv_query($conn, $stmt);
		
		
		$stmt1 = "select distinct p.ProgramCode,ProgramName,ProgramDescription,MenuName,coalesce(usp.IsCreate,0) as IsCreate,
coalesce(usp.IsRead,0) as IsRead,coalesce(usp.IsUpdate,0) as IsUpdate,coalesce(usp.IsDelete,0) as IsDelete 
from (uac_useraccount acc left join
(uac_programcode p left join uac_userpermission usp on p.ProgramCode = usp.ProgramCode)
on acc.UserAccountCode=usp.UserAccountCode) inner join uac_rolepermission rpm on acc.RoleCode=rpm.RoleCode 
where acc.Username='".$user."' AND acc.Password='".$password."' and (AccoutType=2 OR AccoutType=1) and (AccoutType=2 OR AccoutType=1) and ProgramName='Web_report'";
    	$query1 = sqlsrv_query($conn, $stmt1);
		
		$object_array = array();
		$object_array1 = array();
		if($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
		{	
			$check=$result['Checked'];
			array_push($object_array,$result);
			$ip=$result['IsSignOn'];
			$ID=$result['AccountCode'];
		}
		
		if($check=="#1"){
		while($result = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)){
			array_push($object_array1,$result);
		}
		if($ID!=""){
			$sql_2 = "update uac_useraccount SET IsSignOn=?,SignOnIPAddress=? where AccountCode=?";
			$params_2 = array($IsSignOn,get_client_ip(),$ID);
       		$stmt_2 = sqlsrv_query($conn, $sql_2, $params_2);
			if( $stmt_2 === false ) {
				$response="Error";
			}
			else
			{
				//$response="�ѹ�֡��¡�����º��������";
			}
		}
		$result_data=array();
		array_push($result_data,array('Data_User'=>$object_array,'Data_Role'=>$object_array1));
		
		$json_array=json_encode($result_data);
		echo $json_array;
		}else{
			echo $check;
		}
		
  }else{
	  echo "��س���� Username ��� Password";
  }
  function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>
