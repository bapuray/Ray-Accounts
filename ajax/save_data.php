<?php
include '../includes/files.php';

$mode = $_POST['mode'];
if($mode==1){

	$vendor_name = $_POST['vendor_name'];
	$v_mobile = $_POST['v_mobile'];
	$v_email = $_POST['v_email'];

	$arr_insert = array();
	$arr_insert['vendor_name'] = $vendor_name;
	$arr_insert['mobile_no'] = $v_mobile;
	$arr_insert['email'] = $v_email;
	$arr_insert['status'] = 1;

	db_insert('vendor',$arr_insert);
	echo "Data Saved..!";


}elseif($mode==2){

	$op_name = $_POST['op_name'];
	$desc = $_POST['desc'];

	$arr_insert = array();
	$arr_insert['operator_name'] = $op_name;
	$arr_insert['description'] = $desc;
	$arr_insert['status'] = 1;

	db_insert('operator',$arr_insert);
	echo "Data Saved..!";

}elseif($mode==3){

	$vendor_id = $_POST['sel_vendor'];
	$op_id = $_POST['sel_operator'];
	$lapu_numbers = $_POST['lapu_numbers'];

	$lapu_nums = explode(',', $lapu_numbers);

	foreach ($lapu_nums as $key => $value) {
		$arr_insert = array();
		$arr_insert['vendor_id'] = $vendor_id;
		$arr_insert['operator_id'] = $op_id;
		$arr_insert['lapu_number'] = $value;
		$arr_insert['status'] = 1;

		db_insert('xref_vol_mapping',$arr_insert);
	}

	
	echo "Data Saved..!";

}elseif($mode==4){

	$acc_date = to_db_date($_POST['acc_date']);
	$operator_id = $_POST['operator_id'];
	$lapu_no = $_POST['lapu_no'];
	$opening_bal = $_POST['opening_bal'];
	$purchase_amt = $_POST['purchase_amt'];
	$total_bal = $_POST['total_bal'];
	$closing_bal = $_POST['closing_bal'];
	$recharge_amt = $_POST['recharge_amt'];
	$added_amt = $_POST['added_amt'];
	$deduct_amt = $_POST['deduct_amt'];
	$excess_add = $_POST['excess_add'];
	$excess_deduct = $_POST['excess_deduct'];
	$remarks = $_POST['remarks'];
	$id = $_POST['id'];

	
	$arr_insert = array();
	$arr_insert['acc_date'] = $acc_date;
	$arr_insert['operator_id'] = $operator_id;
	$arr_insert['lapu_no'] = $lapu_no;
	$arr_insert['opening_bal'] = $opening_bal;
	$arr_insert['purchase_amt'] = $purchase_amt;
	$arr_insert['total_bal'] = $total_bal;
	$arr_insert['closing_bal'] = $closing_bal;
	$arr_insert['recharge_amt'] = $recharge_amt;
	$arr_insert['added_amt'] = $added_amt;
	$arr_insert['deduct_amt'] = $deduct_amt;
	$arr_insert['excess_add'] = $excess_add;
	$arr_insert['excess_deduct'] = $excess_deduct;
	$arr_insert['remarks'] = $remarks;
	$arr_insert['status'] = 1;


	if($id){
		$where = ' id = '.$id;
		db_update('account_data',$arr_insert,$where);
		echo "Data Modified successfully..!";
	}else{

		// Check for existing entries
		$sql_check="
			SELECT
				ad.id
			FROM account_data ad
			WHERE
				1=1
				AND ad.status = 1
				AND ad.lapu_no = ".$lapu_no."
				AND ad.acc_date = '".$acc_date."'
		";
		$arr_check = db_one($sql_check);

		if(!empty($arr_check)){
			echo "<span class='alert alert-danger'>Date not Saved ..!!</span> <br /><br /> Already there is a entry in the table for this lapu number..!! ";
			return false;
		}

		db_insert('account_data',$arr_insert);
		echo "Data Saved successfully..!";
	}


}else{
	echo "No parameter sent to the action page..!!";
}