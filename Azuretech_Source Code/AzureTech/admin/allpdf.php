<?php
	function generateRow(){
		$contents = '';
		$fdate = $_GET['fdate'];
		$tdate = $_GET['tdate'];	
		include_once('includes/dbconnection.php');
		$sql="select * from tblorderaddresses where date(OrderTime) between '$fdate' and '$tdate'";
 		 $cnt=1;
		 $query = mysqli_query($con, $sql);
		 while($row = mysqli_fetch_assoc($query)){

		 	$contents .= "
		 	<tr>
				<td>".$cnt."</td>
				<td>".$row['Ordernumber']."</td>
				<td>".$row['OrderTime']."</td>
				<td >P ".$row['Total'].".00</td>
				
			</tr>
			";
	 	$cnt++;
		 }
		
 	
		return $contents;
	}
	 
	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("All Orders Report");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 12);  
    $pdf->AddPage();  
 		$fdate = $_GET['fdate'];
		$tdate = $_GET['tdate'];
		$ftotal = $_GET['total'];
		$year1=strtotime($fdate);
		$year2=strtotime($tdate);
		$d1=date("d",$year1);
		$d2=date("d",$year2);
		$m1=date("F",$year1);
		$m2=date("F",$year2);
		$y1=date("Y",$year1);
		$y2=date("Y",$year2);

		$html = <<<EOD
			<h3 align="center">Water Refilling Station</h3><h3 align="center">All Orders Report</h3> <p align="center">Report from $m1-$d1-$y1 to  $m2-$d1-$y2</p><p></p>
			EOD;

		$total = <<<EOD
		<p align="left">Total number of orders:  $ftotal</p>
		EOD;
		

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
    $content = ''; 
    $content .= '
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
             <th width="5%"></th>
			 <th width="30%">Order Number</th>
			 <th width="35%">Order Date</th>
			 <th width="35%">Total</th>
			
           </tr>  
      ';  
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content);
    $pdf->writeHTMLCell(0, 0, '', '', $total, 0, 1, 0, true, '', true);  
    $pdf->Output('All Orders Report.pdf', 'I');
 
 


?>