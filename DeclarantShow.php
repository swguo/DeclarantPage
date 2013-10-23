<?php require_once('../../Connections/CaseMeg.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>投稿系統</title>
</head>
<style type="text/css">
body{
	font-family: "標楷體", "DFKai-sb", serif;
	
	
}
body div form table tr td {
	font-size: 16px;
	color: #333;
	line-height:30px;
	font-family: "微軟正黑體", "Microsoft JhengHei", "新細明體", "PMingLiU", "細明體", "MingLiU", "標楷體", "DFKai-sb", serif;
	
}
</style>

<?php
		$num = $_GET['IDD'];
	//	echo $num;	

			mysql_select_db($database_CaseMeg, $CaseMeg);
			$query_RecordsetContact = "select * from declarant where IDD ='".$num."'";
			

			$RecordsetAll = mysql_query($query_RecordsetContact, $CaseMeg) or die(mysql_error());
			$row_RecordsetAll = mysql_fetch_assoc($RecordsetAll);
			$totalRows_RecordsetAll = mysql_num_rows($RecordsetAll);
			
			
			$query_CountryCode = "select * from country";
			$CountryCodeAll = mysql_query($query_CountryCode, $CaseMeg) or die(mysql_error());
	

?>

<body>
    <form action="DeclarantVeiw.php" method="post"  style="width:auto" name="form2" enctype="multipart/form-data" >
    <table width="986" border="0">
    <tr>
      <td width="225"><?php echo date('Y年 m月 d日'); 
	  $weekarray=array("日","一","二","三","四","五","六");
	  
	  echo $date."  (星期".$weekarray[date("w")].")";?></td>
    <tr>
    	<td colspan="5"> <p>1. 輸入基本資料</p></td>
        <td>&nbsp;</td>
        
    </tr>
    </table>
    <div id="main">
    <table width="850" border="0">
      <tr>
        <td><p>*編號: </p></td>
        <td colspan="2"><label type="text" name="IDD" id="IDD" 
        maxlength="200"><?php if(isset($num)){echo $row_RecordsetAll['IDD'];}else{echo $cfeIdname;} ?></label> 
        </td>
      </tr>
      <tr>
         <td> <p>*姓名</p></td>
        <td><label type="text" name="Name" id="Name" maxlength="200"><?php echo $row_RecordsetAll['Name']; ?></label></td>
      </tr>
      <tr>
         <td>*姓名(英): </td>
        <td colspan="2"><label type="text" name="Ename" id="Ename" maxlength="200"><?php echo $row_RecordsetAll['Ename']; ?></label>
        </td>
      </tr>
      <tr>
         <td>*暱稱 : </td>
        <td colspan="2"><label type="text" name="NickName" id="NickName"  maxlength="200"><?php echo $row_RecordsetAll['NickName']; ?></label> 
        </td>
      </tr>
       <tr>
         <td>*ID: </td>
        <td colspan="2"><label type="text" name="DID" id="DID" maxlength="200"><?php echo $row_RecordsetAll['DID']; ?></label></td>
      </tr>
       <tr>
         <td>*國籍: </td>
        <td colspan="2"><label type="text" name="Country" id="Country" maxlength="200"><?php echo $row_RecordsetAll['Country']; ?></label>
       </td>
      </tr>
      <tr>
     <td>*出生日期: </td>
    <td colspan="2"><label type="text" name="Birthday" id="Birthday" maxlength="200"><?php echo $row_RecordsetAll['Birthday']; ?></label></td>
  	</tr>
      <tr>
         <td>*電話: </td>
        <td colspan="2"><label type="text" name="Telephone" id="Telephone" maxlength="200"><?php echo $row_RecordsetAll['Telephone']; ?></label></td>
      </tr>  
       <tr>
         <td>*E_Mail: </td>
        <td colspan="2"><label type="text" name="E_Mail" id="E_Mail" maxlength="200"><?php echo $row_RecordsetAll['E_Mail']; ?></label></td>
      </tr>
      <tr>
        <td><strong>2.輸入聯絡資料</strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>*國家</td>
        <td>
          <label type="text" name="Country" id="Country" maxlength="200"><?php echo $row_RecordsetAll['Country']; ?></label>
          </td>
      </tr>
      <tr>
        <td>*地址</td>
        <td colspan="2"><label type="text" name="Address" id="Address" maxlength="200" ><?php echo $row_RecordsetAll['Address']; ?></label></td>
      </tr>
      <tr>
         <td>*地址(英)</td>
        <td colspan="2"><label type="text" name="EAddress" id="EAddress" maxlength="200"><?php echo $row_RecordsetAll['EAddress']; ?></label></td>
      </tr>
      <tr>
        <td>*代表人</td>
        <td colspan="2"><label type="text" name="RepresenterName" id="RepresenterName" maxlength="200"><?php echo $row_RecordsetAll['RepresenterName']; ?></label></td>
      </tr>
      <tr>
        <td>*代表人(英)</td>
        <td colspan="2"><label type="text" name="RepresenterEName" id="RepresenterEName" maxlength="200"><?php echo $row_RecordsetAll['RepresenterEName']; ?></label></td>
      </tr>
      <tr>
        <td>*代表人ID</td>
        <td colspan="2"><label type="text" name="RID" id="RID" maxlength="200"><?php echo $row_RecordsetAll['RID']; ?></label></td>
      </tr>
      <tr>
        <td>*客戶</td>
        <td colspan="2"><label type="text" name="RID" id="RID" maxlength="200"><?php echo $row_RecordsetAll['CustomerName']; ?></label></td>
      </tr>
       <br />
      <tr>
         <td></td>
        <td colspan="2"><input type="submit" name="UpSubmit" id="UpSubmit"  value="上一頁"></td>
      </tr>
    </table>
    </div>
    </form>
</div>
</body>
</html>
