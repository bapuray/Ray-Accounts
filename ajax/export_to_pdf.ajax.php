<?php
	require_once('../includes/files.php');
	$id = $_POST['i_d'];
	$clg=($_SESSION['campus_id']==5)?'CMRIT':'CMRU';
	$heading =  '<h1 align="center">'.$_POST['header'].'</h1>';
	$html = '<html><body>'.$heading.'<table width="100%" class="" border=1 cellpadding=8 cellspacing=0> '.$_POST['body'].' </table></body></html>';
	// $html = $heading.'<table class="mws-table">'.$table_content.'</table>';
	$html = strip_tags($html, '<table>,<thead>,<tbody>,<tfoot>,<tr>,<th>,<td>,<span>,<h1>,<br>,<div>,<strong>,<img>,<h3>,<h4><pagebreak/><u>');
	$mode = 'c';
	$page_size = isset($_POST['pl']) ? $_POST['pl'] : 'A4';
	$font_size = 9;
	$font = '';
	$margin_lr = 16;
	$margin_tb = 16;
	$header_font_size = 10;
	$header_l = $clg.', Bangalore';
	$header_c = '';
	$header_r = $_POST['header'];
	$footer_l = 'Exported from educ8 ERP: {DATE d M Y \a\t H:i}';
	$footer_c = '';
	$footer_r = '{PAGENO}/{nb}';
	
	$file_name = trim($_POST['header']).'.pdf';
	$output_mode = $id; // I = Show inline, D = Download
	
	require_once("../includes/pdf/mpdf.php");
	$mpdf = new mPDF($mode, $page_size, $font_size, $font, $margin_lr, $margin_lr, $margin_tb, $margin_tb); 
	
	$mpdf->simpleTables = true;
	$mpdf->useOddEven = false;
	$mpdf->defaultheaderfontsize = $header_font_size;	/* in pts */
	// $mpdf->use_kwt = true;

	$arr_css = array(
		 // '../../assets/css/custom.css'
		//  '../../assets/plugins/bootstrap/css/bootstrap.css',
		);
		
	foreach($arr_css as $css){
		$mpdf->WriteHTML(file_get_contents($css),1);	// The parameter 1 tells that this is css/style only and no body/html/text
	}

	$mpdf->SetHeader($header_l.'|'.$header_c.'|'.$header_r);
	$mpdf->SetFooter($footer_l.'|'.$footer_c.'|'.$footer_r);

	$mpdf->WriteHTML($html, 2);

	$mpdf->Output($file_name, $output_mode);
?>