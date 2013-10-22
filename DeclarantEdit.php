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
 <link type="text/css" rel="stylesheet" href="../../css/bootstrap.css">
<script type="text/javascript" src="../../js/main.js"></script>
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
		//echo $num;	

			mysql_select_db($database_CaseMeg, $CaseMeg);
			$query_RecordsetContact = "select * from declarant where IDD ='".$num."'";
			$RecordsetAll = mysql_query($query_RecordsetContact, $CaseMeg) or die(mysql_error());
			$row_RecordsetAll = mysql_fetch_assoc($RecordsetAll);
			$totalRows_RecordsetAll = mysql_num_rows($RecordsetAll);
			
		
			$query_CountryCode = "select * from country";
			$CountryCodeAll = mysql_query($query_CountryCode, $CaseMeg) or die(mysql_error());

			$query_CustomerCode = "select * from customerdata";
			$CustomerCodeAll = mysql_query($query_CustomerCode, $CaseMeg) or die(mysql_error());

			$sqlc = "select count(*) from declarant";// 計算資料表 nwsuppliers 總筆數
			$rsc = mysql_query($sqlc, $CaseMeg) or die(mysql_error());
		 	list($totalNum) = mysql_fetch_row($rsc);
		 //echo $totalNum;
		 
	

?>

<body>
<h4><a href="#" >資料首頁</a> > <a href="#" >系統檔案維護</a> > <a href="DeclarantVeiw.php" >申請人/創作人/當事人/對造資料</a> > <?php  if($num){ ?> <a href="#" >資料編輯</a><?php }else{?> <a href="#" >新增資料</a><?php } ?>
    <form action="<?php if(isset($num)){?>DeclarantUpload.php?n=<?php echo $num ?><?php }else{?>DeclarantUpload.php<?php }?>" method="post"  style="width:auto" name="form2" enctype="multipart/form-data" >
    <table width="986" border="0">
    <tr>
      <td width="225"><?php echo date('Y年 m月 d日'); 
	  $weekarray=array("日","一","二","三","四","五","六");
	  
	  echo $date."  (星期".$weekarray[date("w")].")";?></td>
    </tr>
     <tr>
    	<td colspan="5"><div class="well form-search" ><strong>1. 輸入基本資料</strong></div></td>
        <td>&nbsp;</td>
    </tr>
    </table>
    <div id="main">
    <table width="850" border="0">
      <tr >
      <?php
	  $number = "DE000000";
	  $totalNum = $totalNum+1;
	   
	  ?>
        
      <tr>
        <td><p>*編號: </p></td>
        <td colspan="2"><input type="text" name="IDD" id="IDD" 
        value="<?php if(isset($num)){echo $row_RecordsetAll['IDD'];}else{echo addSlashes($number.$totalNum);} ?>"onKeyUp="check(1)" >
        </td>
         
      </tr>
      <tr>
         <td> <p>*姓名</p></td>
        <td><input type="text" name="Name" id="Name" value="<?php echo $row_RecordsetAll['Name']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
         <td>*姓名(英): </td>
        <td colspan="2"><input type="text" name="Ename" id="Ename" value="<?php echo $row_RecordsetAll['Ename']; ?>" onKeyUp="check(1)">
        </td>
      </tr>
      <tr>
         <td>*暱稱 : </td>
        <td colspan="2"><input type="text" name="NickName" id="NickName"  value="<?php echo $row_RecordsetAll['NickName']; ?>" onKeyUp="check(1)" >
        </td>
      </tr>
       <tr>
         <td>*代表人: </td>
        <td colspan="2"><input type="text" name="DID" id="DID" value="<?php echo $row_RecordsetAll['DID']; ?>" onKeyUp="check(1)"></td>
      </tr>
      <tr>
      <script>
	function getopt(){
			
		document.form2.Country.value = document.form2.CountrySelect.value;
		
	}
	function getoptCus(){
			
		document.form2.CustomerName.value = document.form2.CustomerSelect.value;
		
	}
    function compareopt(){
			
		return document.form2.Country.value;
	}
	  </script>
        <td>*國家</td>
        <td>
          <input type="text" name="Country" id="Country" value="<?php echo $row_RecordsetAll['Country']; ?>"onKeyUp="check(1)" />
          
          <select name="CountrySelect" id="CountrySelect" size="1" onChange="getopt()">
            <?php
			while($row_CountryCode = mysql_fetch_assoc($CountryCodeAll))
			{
				echo "<option ".(($row_CountryCode['IDD'] == $row_RecordsetAll['Country'])?'selected="selected"':"")."". $row_CountryCode['CountryName']." value=".$row_CountryCode['IDD'].">".$row_CountryCode['CountryName']."</option>\n";
			}
			?>
          </select>
          TW(國籍輸入或下拉式資料選擇)</td>
      </tr>
      <tr>
        <td>*電話</td>
        <td colspan="2"><input type="text" name="Telephone" id="Telephone" value="<?php echo $row_RecordsetAll['Telephone']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*E_Mail</td>
        <td colspan="2"><input type="text" name="Telephone" id="Telephone" value="<?php echo $row_RecordsetAll['Telephone']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*地址</td>
        <td colspan="2"><input type="text" name="Address" id="Address" value="<?php echo $row_RecordsetAll['Address']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
         <td>*地址(英)</td>
        <td colspan="2"><input type="text" name="EAddress" id="EAddress" value="<?php echo $row_RecordsetAll['EAddress']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*代表人</td>
        <td colspan="2"><input type="text" name="RepresenterName" id="RepresenterName" value="<?php echo $row_RecordsetAll['RepresenterName']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*代表人(英文)</td>
        <td colspan="2"><input type="text" name="RepresenterEName" id="RepresenterEName" value="<?php echo $row_RecordsetAll['RepresenterEName']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*代表人ID</td>
        <td colspan="2"><input type="text" name="RID" id="RID" value="<?php echo $row_RecordsetAll['RID']; ?>" onKeyUp="check(1)" /></td>
      </tr>
      <tr>
        <td>*客戶</td>
        
        <td>
          <input type="text" name="CustomerName" id="CustomerName" value="<?php echo $row_RecordsetAll['CustomerName']; ?>"onKeyUp="check(1)" />
          
          <select name="CustomerSelect" id="CustomerSelect" size="1" onChange="getoptCus()">
            <?php
			
			while($row_CustomerCode = mysql_fetch_assoc($CustomerCodeAll))
			{
				
				echo "<option ".(($row_CustomerCode['CustomerName'] == $row_RecordsetAll['IDD'])?'selected="selected"':"")."". $row_CustomerCode['Name']." value=".$row_CustomerCode['IDD'].">".$row_CustomerCode['Name']."</option>\n";
			}
			?>
          </select>
          </td>
      </tr>
       <br />
      <tr>
         <td></td>
        <td colspan="2"><input type="submit" name="UpdataSubmit" id="UpdataSubmit"  value="確認"></td>
      </tr>
    </table>
    </div>
    </form>
    </h4>
</div>
    <p>

</body>
</html>
