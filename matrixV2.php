<html>
<head>
	<script language="javascript" type="text/javascript" src="./scripts/actb.js"></script><!-- External script -->
	<script language="javascript" type="text/javascript" src="./scripts/tablefilter.js"></script>
	<link rel="stylesheet" type="text/css" href="./style/matrix.css">
	<link rel="stylesheet" type="text/css" href="./style/filtergrid.css">
	
	<!--<script type="text/javascript">
	var table10_Props = {
    paging: true,
    paging_length: 3,
    col_2: 'select',
    col_3: 'select',
    sort_num_asc: [2],
    sort_num_desc: [3],
    refresh_filters: true
	};

	var tf10 = setFilterGrid("table6", table10_Props);
	</script>-->
</head>
<body>
</body>
</html>
<?php
	/*
		Place code to connect to your DB here.
	*/
	include('./include/config.php');	// include your code to connect to DB.

	$tbl_name="table_matrix";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "matrix.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"> previous </a>";
		else
			$pagination.= "<span class=\"disabled\"> previous </span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next </a>";
		else
			$pagination.= "<span class=\"disabled\">next </span>";
		$pagination.= "</div>\n";		
	}
?>

	<?php
	
	$completeTable =  '<table id = "table6" class="mytable" border="1">';

	//echo'<table id = "Stable" class="TFtable" border="1">';
	$arrayTitles = array("id", "SBU", "Accountability", "Team Member", "IT Member", "Speciality", "Project Name", "Type of product", "Specification", "Scope", "IT", "Company", "Region", "PM", "Client TAT", "Project started Date", "Project Completed Date", "Nos of Days", "Current Status", "Quality", "CDR sent date", "Job Code", "Quotation No & Dated", "Quotation Amount", "Probable MHS Amount", "Po No. from Client", "Invoice No.", "Payment Status", "Cheque NO", "Invoiced Amount", "Invoice Dated", "Print/Others", "Settlement", "Service Tax/VAT", "MHS Amount", "timestamp");
	$tableTitles = "<tr>";
	

	foreach ($arrayTitles as $key => $value) {
		$tableTitles = $tableTitles."<th>".$value."</th>";
	}
	$tableTitles = $tableTitles."</tr>";
	//echo $tableTitles;
	$completeTable = $completeTable.$tableTitles;

		while($row = mysql_fetch_array($result))
		{
	
		// Your while loop here
			//echo $row["id"];
			//echo json_encode($row)."</br>";
			$col = 36;
			// echo'<tr>';
			 $completeTable = $completeTable.'<tr>';

    for( $j = 0; $j < $col; $j++ ) {
      //  if( ! empty( $row[$j] ) ) {

	//	echo '<td >'.$row[$j].'</td>';
		$completeTable = $completeTable.'<td >'.$row[$j].'</td>';
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
							rows_counter: false,
							rows_counter_text: "Rows:",
							btn_reset: true,
							loader: true,
							loader_text: "Filtering data..."
						};
	var tf6 = setFilterGrid( "table6",table6_Props );
//]]>
</script>';
		echo $completeTable;
		//echo'</table>';

	?>

<?=$pagination?>
	