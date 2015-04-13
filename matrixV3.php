<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
	
	$fgmembersite->RedirectToURL("login.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	<script language="javascript" type="text/javascript" src="./scripts/actb.js"></script><!-- External script -->
	<script language="javascript" type="text/javascript" src="./scripts/tablefilter.js"></script>
	<link rel="stylesheet" type="text/css" href="./style/matrix.css">
	<link rel="stylesheet" type="text/css" href="./style/filtergrid.css">
	<script type='text/javascript'>
document.redirect.submit();
</script>
</head>
<body>
</body>
</html>

<?php
	include('./include/config.php');
	$tbl_name="table_matrix";
	$sql = "SELECT * FROM $tbl_name";
	$result = mysql_query($sql); 
	$completeTable =  '<table id = "table6" class="mytable" border="1">';

	//echo'<table id = "Stable" class="TFtable" border="1">';
	$arrayTitles = array("Edit","Sl.No", "Project Name", "SBU", "Team Member","IT", "IT Member", "Speciality", "Type of product", "Specification", "Project Status", "Client TAT", "Company", "Region", "PMT","Job Code","Quotation No","Quotation Date","Quotation Amount","PO NO","PO Date","MHS Amount","Payment Status");
	$tableTitles = "<tr>";
	

	foreach ($arrayTitles as $key => $value) {
		$tableTitles = $tableTitles."<th>".'ColumnNo.'.$key.'</br>'.$value."</th>";
	}
	$tableTitles = $tableTitles."</tr>";
	//echo $tableTitles;
	$completeTable = $completeTable.$tableTitles;

		while($row = mysql_fetch_array($result))
		{
	
		// Your while loop here
			//echo $row["id"];
			//echo json_encode($row)."</br>";
			$col = 22;
			// echo'<tr>';

			 $completeTable = $completeTable.'<tr>';
$completeTable = $completeTable. "<td ><form name='redirect' action='edit.php' method='POST'>
<input type='hidden' name='data' value='".$row[0]."'><input type='submit' value='edit'></form></td>";
    for( $j = 0; $j < $col; $j++ ) {
      //  if( ! empty( $row[$j] ) ) {
      	
	//	echo '<td >'.$row[$j].'</td>';
    	$RowTitle = $row[$j];

    	switch ($j) {
    		case '2':
    		if (true == $fgmembersite->GetTeamName($RowTitle)) {}
    			break;

    		case '3':
    		if (true == $fgmembersite->GetTeamMemberName($RowTitle)) {}
    			break;

    		case '4':
    		$RowTitle = ($RowTitle == 1) ?"Y":"N";
    			break;

    		case '5':
    		if (true == $fgmembersite->GetTeamMemberName($RowTitle)) {}
    			break;

    		case '6':
    		if (true == $fgmembersite->GetSpecialityName($RowTitle)) {}
    			break;
    		
    		case '7':
    		if (true == $fgmembersite->GetProductName($RowTitle)) {}
    			break;

    		case '9':
    		if (true == $fgmembersite->GetStatusName($RowTitle)) {}
    			break;

    		case '11':
    		if (true == $fgmembersite->GetCompanyName($RowTitle)) {}
    			break;

    		case '12':
    		if (true == $fgmembersite->GetRegionName($RowTitle)) {}
    			break;

    		default:
    			# code...
    			break;
    	}
    		$completeTable = $completeTable.'<td >'.$RowTitle.'</td>';
		
//            echo '<td contenteditable='."'true'".'>'.$row[$j].'</td>';
     //   }
    }
  //  echo'</tr>';
    $completeTable = $completeTable.'</tr>';
		}
		$completeTable = $completeTable.'</table>
        <script language="javascript" type="text/javascript">
//<![CDATA[
	var table6_Props = 	{
							paging: true,
							paging_length: 10,
							rows_counter: true,
							rows_counter_text: "Displayed Records:",
							 display_all_text: " [ Show all ] ",
							btn_reset: true,
							loader: true,
							col_0: "none",
							col_3: "select",
							col_4: "select",
							col_5: "select",
							col_6: "select",
							col_7: "select",
							col_8: "select",
							col_9: "select",
							col_10: "select",
							col_12: "select",
							col_13: "select",
							col_22: "select",
							
							loader_text: "Filtering data..."
						};
	var tf6 = setFilterGrid( "table6",table6_Props );
//]]>
</script>';
		echo $completeTable;
		//echo'</table>';

	?>