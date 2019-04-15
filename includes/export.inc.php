<div class="btn-group export_div pull-right" role="group" aria-label="...">
  	<div class="btn-group" role="group">
    	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Export <span class="caret"></span></button>
    	<ul class="dropdown-menu">
      		<?php 
				$is_pdf=isset($is_pdf)?$is_pdf:1;
				$is_excel=isset($is_excel)?$is_excel:1;
				$is_csv=isset($is_csv)?$is_csv:0;
			
				$li_str='';
				if($is_pdf==1){
					//$li_str.='<li><a href="ajax/export_to_pdf.ajax.php" data-i_d="I" class="export_data">Print PDF</a></li>';
				}
				if($is_excel==1){
					$li_str.='<li><a href="ajax/export_to_xlsx.ajax.php" data-i_d="D" class="export_data">Get Excel</a></li>';
				}
				if($is_csv==1){
					//$li_str.='<li><a href="ajax/export_to_csv.ajax.php" data-i_d="D" class="export_data"> CSV</a></li>';
				}
				echo $li_str;
			?>
    	</ul>

    	<form action="" method="post" target="_blank" class="export">
			<input type="hidden" name="header"/>
			<input type="hidden" name="body"/>
			<input type="hidden" name="i_d"/>
			<input type="hidden" name="pl" value="<?php echo isset($portrait_landscape) ? ($portrait_landscape == 'L' ? 'A4-L': 'A4') : 'A4'?>"/>
			<input type="hidden" name="rt" value="<?php echo isset($report_type) ? ($report_type) : '0'?>"/>
			<input type="hidden" name="id" value="<?php echo isset($id) ? ($id) : '0'?>"/>
		</form>
  	</div>
</div>
