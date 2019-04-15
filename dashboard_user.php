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
		,DATE_FORMAT(ad.acc_date,'%d-%m-%Y') AS entry_date
	FROM account_data ad
	INNER JOIN operator op ON op.id = ad.operator_id
	
	WHERE
		1=1
		AND ad.status=1
		AND op.status = 1
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
        <title>Template</title>

        <!-- Bootstrap -->
        <!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="container" >
        				
			<form action="#">
			<div class="col-md-12 row">
				<div class="result_msg_ac col-md-12"></div>
				<input type="hidden" name="mode" value="4">
				<div class="col-md-3 req-validate"> 
					<label class="control-label req-label"> Date </label>
					<div class="input-group input-medium date date-picker ">
						<input name="acc_date" type="text" class="form-control acc_date req-field" readonly required value="">
						<span class="input-group-btn">
							<button class="btn default"  type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Select Operator </label>
				    <select name="operator_id" class="form-control operator_id">
				        <option value="">Select</option>
				        <?php echo sel_options(db_assoc($sql_operator_list)) ?>
				    </select>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Select Lapu No. </label>
				    <select name="lapu_no" class="form-control lapu_no">
				        <option value="">Select</option>
				        
				    </select>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Opening Balance </label>
				    <input type="text" name="opening_bal" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Purchase Amount </label>
				    <input type="text" name="purchase_amt" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Total </label>
				    <input type="text" name="total_bal" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Closing Balance </label>
				    <input type="text" name="closing_bal" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Recharge Amount </label>
				    <input type="text" name="recharge_amt" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Add Amount </label>
				    <input type="text" name="added_amt" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Deduct Amount </label>
				    <input type="text" name="deduct_amt" class="form-control">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Excess Add </label>
				    <input type="text" name="excess_add" class="form-control">
				</div>
				<div class="col-md-3 form-group">
				    <label class="control-label req-label">Excess Deduct </label>
				    <input type="text" name="excess_deduct" class="form-control">
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12 text-right form-group">
				    <button class="btn btn-primary save_account_data"> <i class="fa fa-save"></i> Submit</button>
				</div>
			</div>
			</form>

		</div>
		<div class="container-fluid">
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
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
								<td>
									<a href="#" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
									<a href="#" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
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

        

        <script type="text/javascript" src="assets/jquery.js"></script>
        <script type="text/javascript" src="assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/custom.js"></script>
	
		<script>
			$(document).ready(function(){

				$('.date-picker').datepicker({
					format:'dd-mm-yyyy',
					autoclose: true,
					todayHighlight: true,
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

				$(document).on('click','.save_account_data',function(e){
					e.preventDefault();
					$this = $(this);

					var fd = new FormData($this.parents('form')[0]);
					$.ajax({
						url:"ajax/save_data.php",
						type:'POST',
						data:fd,
						async: false,
						success: function(ret_data){
							let msg = '<div class="alert alert-success" role="alert">'+ret_data+'</div>';

							$('.result_msg_ac').html(msg);
							location.reload();
						},
						cache:false,
						contentType:false,
						processData:false
					});

				});


			});
		</script>

  </body>
</html>
