<?php
	function generateRow(){
		$contents = '';
		$fdate = $_GET['fdate'];
		$tdate = $_GET['tdate'];	
		include_once('includes/dbconnection.php');
		$sql="select year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses  where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (tblorderaddresses.OrderFinalStatus='Bottle Delivered') group by lyear";
 		 $cnt=1;
		 $query = mysqli_query($con, $sql);
		 while($row = mysqli_fetch_assoc($query)){

		 	$contents .= "
		 	<tr>
				<td>".$cnt."</td>
				<td>".$row['lyear']."</td>
				<td >P ".$row['totalprice'].".00</td>
				
			</tr>
			";
	 	$cnt++;
		 }
		
 	
		return $contents;
	}
	 
	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Yearly Sales Report");  
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
		<h3 align="center">Water Refilling Station</h3><h3 align="center">Yearly Sales Report</h3> <p align="center">Report from $y1 to $y2</p><p></p>
		EOD;

		$total = <<<EOD
		<p align="right">Total Sales: P $ftotal.00 </p>
		EOD;
		

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
    $content = ''; 
    $content .= '
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="10%"></th>
			 <th width="45%">Year</th>
			 <th width="45%">Sales</th>
			
           </tr>  
      ';  
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content);
    $pdf->writeHTMLCell(0, 0, '', '', $total, 0, 1, 0, true, '', true);  
    $pdf->Output('Yearly Sales report.pdf', 'I');
 
 


?>