<?php 

	include 'includes/files.php';

	$id = isset($_GET['id'])?$_GET['id']:0;

	$sql_operator_list="
	    SELECT
	        id,operator_name
	    FROM operator 
	    WHERE
	        1=1
	        AND status = 1
	";
	
	$sql_account = "
		SELECT
			ad.*
			,DATE_FORMAT(ad.acc_date,'%d-%m-%Y') AS entry_date
		FROM account_data ad
		WHERE
			1=1
			AND ad.status = 1
			AND ad.id = ".$id."
	";
	$arr_account = db_one($sql_account);
	
	$acc_date = '';
	if(empty($arr_account)){
		$acc_date = date('d-m-Y');
	}else{
		$acc_date = $arr_account['entry_date'];
	}
	// echo $acc_date;
	
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Data Entry</title>

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
        <div class="container" >
        				
			<form action="#">
			<div class="col-md-12 row">
				<div class="result_msg_ac col-md-12"></div>
				<input type="hidden" name="mode" value="4">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="col-md-3 req-validate"> 
					<label class="control-label req-label"> Date </label>
					<div class="input-group input-medium date date-picker ">
						<input name="acc_date" type="text" class="form-control acc_date req-field" readonly required value="<?php echo $acc_date; ?>" data-date-end-date="0d">
						<span class="input-group-btn">
							<button class="btn default"  type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Select Operator </label>
				    <select name="operator_id" class="form-control operator_id">
				        <option value="">Select</option>
				        <?php echo sel_options(db_assoc($sql_operator_list),$arr_account['operator_id']) ?>
				    </select>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Select Lapu No. </label>
				    <select name="lapu_no" class="form-control lapu_no">
				        <option value="">Select</option>
				        <?php 
				        if($id){
				        	 $sql_laps="
								SELECT
									xvm.lapu_number
									,xvm.lapu_number
								FROM xref_vol_mapping xvm
								WHERE
									1=1
									AND xvm.status = 1
									AND xvm.operator_id = ".$arr_account['operator_id']."
							";
							echo sel_options(db_assoc($sql_laps),$arr_account['lapu_no']);
				        }
				       
				        ?>
				    </select>
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Opening Balance </label>
				    <input type="number" name="opening_bal" class="form-control opening_bal auto_calc" value="<?php echo isset($arr_account['opening_bal'])?$arr_account['opening_bal']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Purchase Amount </label>
				    <input type="number" name="purchase_amt" class="form-control purchase_amt auto_calc" value="<?php echo isset($arr_account['purchase_amt'])?$arr_account['purchase_amt']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Total </label>
				    <input type="number" name="total_bal" class="form-control total_bal auto_calc" value="<?php echo isset($arr_account['total_bal'])?$arr_account['total_bal']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Closing Balance </label>
				    <input type="number" name="closing_bal" class="form-control closing_bal auto_calc" value="<?php echo isset($arr_account['closing_bal'])?$arr_account['closing_bal']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Recharge Amount </label>
				    <input type="number" name="recharge_amt" class="form-control recharge_amt auto_calc" value="<?php echo isset($arr_account['recharge_amt'])?$arr_account['recharge_amt']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Add Amount </label>
				    <input type="number" name="added_amt" class="form-control added_amt auto_calc" value="<?php echo isset($arr_account['added_amt'])?$arr_account['added_amt']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Deduct Amount </label>
				    <input type="number" name="deduct_amt" class="form-control deduct_amt auto_calc" value="<?php echo isset($arr_account['deduct_amt'])?$arr_account['deduct_amt']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Excess Add </label>
				    <input type="number" name="excess_add" class="form-control" value="<?php echo isset($arr_account['excess_add'])?$arr_account['excess_add']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-3">
				    <label class="control-label req-label">Excess Deduct </label>
				    <input type="number" name="excess_deduct" class="form-control" value="<?php echo isset($arr_account['excess_deduct'])?$arr_account['excess_deduct']:''; ?>" autocomplete="off">
				</div>
				<div class="col-md-12 form-group">
				    <label class="control-label req-label">Remarks </label>
				    <input type="text" name="remarks" class="form-control remarks validate-text" value="<?php echo isset($arr_account['remarks'])?$arr_account['remarks']:''; ?>" autocomplete="off">
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12 text-right form-group">
				    <button class="btn btn-primary save_account_data"> <i class="fa fa-save"></i> Submit</button>
				</div>
			</div>
			</form>

		</div>

		
		<div class="container-fluid">
			<div class="col-md-12 table-responsive lapu_data">
				
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
					endDate: '+10',
					datesDisabled: '+0d',
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

				$(document).on('change','.lapu_no',function(e){
					e.preventDefault();
					let $this = $(this);
					let acc_date = $('.acc_date').val();
					let operator_id = $('.operator_id').val();
					let lapu_no = $this.val();

					let url = 'ajax/common_ajax.php'
					if(lapu_no){
						$.get(url,{'lapu_no':lapu_no,'mode':5},function(res_data){
							$('.opening_bal').val(res_data);
							$('.opening_bal').trigger('keyup');
						});

						$.get(url,{'lapu_no':lapu_no,'acc_date':acc_date,'operator_id':operator_id,'mode':2},function(res_data){
							$('.lapu_data').html(res_data);
							//console.log(res_data);
							//alert();
						});

					}

				});



				$(document).on('click','.save_account_data',function(e){
					e.preventDefault();
					$this = $(this);
					let op_id = $('.operator_id').val();
					let lap_no = $('.lapu_no').val();
					if(!op_id){
						alert('Please select operator');
						return false;
					}
					if(!lap_no){
						alert('Please select lapu number');
						return false;
					}
					var fd = new FormData($this.parents('form')[0]);
					$.ajax({
						url:"ajax/save_data.php",
						type:'POST',
						data:fd,
						async: false,
						success: function(ret_data){
							let msg = '<div class="alert alert-success" role="alert">'+ret_data+'</div>';

							bootbox.alert(msg,function(res){
								location.reload();
							});

							
						},
						cache:false,
						contentType:false,
						processData:false
					});

				});

				$(document).on('keyup','.auto_calc',function(){
					let $this = $(this);
					let open_bal = parseFloat($('.opening_bal').val()) || 0;
					let prch_amt = parseFloat($('.purchase_amt').val()) || 0;

					let tot_val = (open_bal + prch_amt).toFixed(2);
					$('.total_bal').val(tot_val);

					let total_bal = parseFloat($('.total_bal').val()) || 0;
					let closing_bal = parseFloat($('.closing_bal').val()) || 0;
					let rechrg_val = (total_bal - closing_bal).toFixed(2);
					if(!$this.hasClass('opening_bal') && !$this.hasClass('purchase_amt')){
						$('.recharge_amt').val(rechrg_val);
					}
					

					let added_amt = parseFloat($('.added_amt').val()) || 0;
					let recharge_amt = parseFloat($('.recharge_amt').val()) || 0;
					$('.recharge_amt').val((recharge_amt - added_amt).toFixed(2));

					let deduct_amt = parseFloat($('.deduct_amt').val()) || 0;
					recharge_amt = parseFloat($('.recharge_amt').val()) || 0;
					$('.recharge_amt').val((recharge_amt + deduct_amt).toFixed(2));

				});

				// $(document).on('keyup','.opening_bal,.purchase_amt',function(){
				// 	let open_bal = parseFloat($('.opening_bal').val()) || 0;
				// 	let prch_amt = parseFloat($('.purchase_amt').val()) || 0;

				// 	let total_val = open_bal + prch_amt;
				// 	$('.total_bal').val(total_val);
				// });

				// $(document).on('keyup','.closing_bal',function(){
				// 	let total_bal = parseFloat($('.total_bal').val()) || 0;
				// 	let closing_bal = parseFloat($('.closing_bal').val()) || 0;
				// 	if(closing_bal > total_bal){
				// 		bootbox.alert('Closing balance should not be greater than total');
				// 		$('.closing_bal').val('');
				// 		$('.recharge_amt').val('');
				// 		return false;
				// 	}
				// 	let reacharge_amt = total_bal - closing_bal;
				// 	$('.recharge_amt').val(reacharge_amt);
				// });

				// $(document).on('keyup','.added_amt',function(){
				// 	let added_amt = parseFloat($('.added_amt').val()) || 0;
				// 	let total_bal = parseFloat($('.total_bal').val()) || 0;
				// 	let closing_bal = parseFloat($('.closing_bal').val()) || 0;
				// 	let deduct_amt = parseFloat($('.deduct_amt').val()) || 0;
				// 	//let recharge_amt = parseFloat($('.recharge_amt').val()) || 0;

				// 	recharge_amt = (total_bal - closing_bal) - added_amt + deduct_amt;
				// 	$('.recharge_amt').val(recharge_amt);

				// 	if(!added_amt){
				// 		let total_bal = parseFloat($('.total_bal').val()) || 0;
				// 		let closing_bal = parseFloat($('.closing_bal').val()) || 0;
				// 		let my_val = parseFloat(total_bal - closing_bal);
				// 		$('.recharge_amt').val(my_val);
						
				// 	}
				// });

				// $(document).on('keyup','.deduct_amt',function(){
				// 	let deduct_amt = parseFloat($('.deduct_amt').val()) || 0;
				// 	let total_bal = parseFloat($('.total_bal').val()) || 0;
				// 	let closing_bal = parseFloat($('.closing_bal').val()) || 0;
				// 	let added_amt = parseFloat($('.added_amt').val()) || 0;

				// 	recharge_amt = ((total_bal - closing_bal) + deduct_amt) - added_amt;
				// 	$('.recharge_amt').val(recharge_amt);

				// 	if(!deduct_amt){
				// 		let total_bal = parseFloat($('.total_bal').val()) || 0;
				// 		let closing_bal = parseFloat($('.closing_bal').val()) || 0;
				// 		let added_amt = parseFloat($('.added_amt').val()) || 0;
				// 		$('.recharge_amt').val((total_bal - closing_bal) - added_amt);
				// 	}
				// });

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
				
				
			});
		</script>

  </body>
</html>
