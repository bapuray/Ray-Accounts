<?php 

	include 'includes/files.php';

	$sql_operator_list="
	    SELECT
	        id,operator_name
	    FROM operator 
	    WHERE
	        1=1
	        AND status = 1
	";

	$sql_data="
	SELECT
		ad.*
		,op.operator_name
		,v.vendor_name
		,DATE_FORMAT(ad.acc_date,'%d-%m-%Y') AS entry_date
	FROM account_data ad
	INNER JOIN operator op ON op.id = ad.operator_id
	INNER JOIN xref_vol_mapping xvm ON xvm.lapu_number = ad.lapu_no
	INNER JOIN vendor v ON v.id = xvm.vendor_id
	
	WHERE
		1=1
		AND ad.status=1
		AND op.status = 1
		AND ad.acc_date = CURDATE()
	ORDER BY ad.acc_date DESC
	";
	$arr_data = db_all($sql_data);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Admin | Dashboard</title>

        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="assets/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
		<style>
			.card-login {
			    max-width: 25rem;
			}
			label.req-label::after {content:"*";color:red;}
		</style>

    </head>
    <body class="">
        <?php include_once('includes/ajax_modals.php'); ?>
        <?php include_once('includes/header.inc.php');?>
			<br>
        <div class="container row" >
			</form>
			
        	<div class="col-md-3 req-validate"> 
        		<label class="control-label"> Date </label>
        		<div class="input-group input-medium date date-picker ">
        			<input name="acc_date" type="text" class="form-control acc_date req-field" readonly required value="">
        			<span class="input-group-btn">
        				<button class="btn default"  type="button"><i class="fa fa-calendar"></i></button>
        			</span>
        		</div>
        	</div>
        	<div class="col-md-3">
        	    <label class="control-label ">Select Operator </label>
        	    <select name="operator_id" class="form-control operator_id">
        	        <option value="">Select</option>
        	        <?php echo sel_options(db_assoc($sql_operator_list)) ?>
        	    </select>
        	</div>
        	<div class="col-md-3">
        	    <label class="control-label ">Select Lapu No. </label>
        	    <select name="lapu_no" class="form-control lapu_no">
        	        <option value="">Select</option>
        	        
        	    </select>
        	</div>

        	<div class="col-md-1 text-left form-group">
        		<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
        	    <button class="btn btn-primary get_account_data"> <i class="fa fa-search"></i> Search</button>
        	</div>

        	</form>

		</div>
		<br>
		<div class="container-fluid">
			
			<div class="panel panel-primary">
			   	<div class="panel-heading">
			      	<h3 class="panel-title">Accounts Report</h3>
			   	</div>
			   	<div class="actions">
			   		<?php include('includes/export.inc.php'); ?>
			   	</div>
			   	<div class="panel-body exportable">
			      	<div class="col-md-12 data_container table-responsive">
						<table class="table table-hover table-sm table-bordered table-advance">
							<thead class="thead-light">
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>Vendor</th>
									<th>Operator</th>
									<th>Lapu No</th>
									<th>Open Bal</th>
									<th>Purchg amt</th>
									<th>Total</th>
									<th>Close Bal</th>
									<th>Rchrg amt</th>
									<th>Add amt</th>
									<th>Ded amt</th>
									<th>Excs add</th>
									<th>Excs ded</th>
									<th>Remarks</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$str = '';$i=1;
								foreach ($arr_data as $row) {
									$str.='
									<tr>
										<td>'.$i++.'</td>
										<td>'.$row['entry_date'].'</td>
										<td>'.$row['vendor_name'].'</td>
										<td>'.$row['operator_name'].'</td>
										<td>'.$row['lapu_no'].'</td>
										<td>'.$row['opening_bal'].'</td>
										<td>'.$row['purchase_amt'].'</td>
										<td>'.$row['total_bal'].'</td>
										<td>'.$row['closing_bal'].'</td>
										<td>'.$row['recharge_amt'].'</td>
										<td>'.$row['added_amt'].'</td>
										<td>'.$row['deduct_amt'].'</td>
										<td>'.$row['excess_add'].'</td>
										<td>'.$row['excess_deduct'].'</td>
										<td>'.$row['remarks'].'</td>
										<td>
											<a href="data_entry.php?id='.$row['id'].'" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
											<a href="#" data-attr_id="'.$row['id'].'" class="btn btn-sm btn-danger btn_del_acc"> <i class="fa fa-times"></i> </a>
										</td>
									</tr>
									';
								}
								echo $str;
								?>
								
							</tbody>
						</table>
					</div>
			   	</div>
			</div>
			
		</div>

        

        <script type="text/javascript" src="assets/jquery.js"></script>
        <!-- <script type="text/javascript" src="assets/bootstrap-4.1.3/js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="assets/custom.js"></script>
	
		<script>
			$(document).ready(function(){

				$('.date-picker').datepicker({
					format:'dd-mm-yyyy',
					autoclose: true,
					todayHighlight: true,
				});

				$(document).on('click','.get_account_data',function(){
					let acc_date = $('.acc_date').val();
					let operator_id = $('.operator_id').val();
					let lapu_no = $('.lapu_no').val();
					let url = 'ajax/common_ajax.php';
					$.get(
						url,{'acc_date':acc_date,'operator_id':operator_id,'lapu_no':lapu_no,'mode':2},function(ret_data){
							$('.data_container').html(ret_data);
						}	
					);

				});

				$(document).on('click','.btn_del_acc',function(e){
					e.preventDefault();
					let $this = $(this);
					let id = $this.attr('data-attr_id');
					let url = 'ajax/del_account_data.php';

					bootbox.confirm('Are you sure?',function(res){
						if(res){
							$.get(url,{'id':id},function(ret_data){
								let msg = '<div class="alert alert-success" role="alert">'+ret_data+'</div>';
								bootbox.alert(msg,function(res){
									location.reload();
								});
							});
						}
					});

				});

				$(document).on('change','.operator_id',function(e){
					e.preventDefault();
					let $this = $(this);
					let op_id = $this.val();

					let url = 'ajax/common_ajax.php'
					if(op_id){
						$.get(url,{'op_id':op_id,'mode':1},function(resp){
							$('.lapu_no').html(resp);
						});
					}

				});


			});
		</script>

  </body>
</html>
