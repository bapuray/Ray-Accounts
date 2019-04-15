<?php 
include '../includes/files.php';

$mode = $_GET['mode'];

if($mode==1){
	$operator_id = $_GET['op_id'];
	
	$sql_laps="
		SELECT
			xvm.lapu_number
			,xvm.lapu_number
		FROM xref_vol_mapping xvm
		WHERE
			1=1
			AND xvm.status = 1
			AND xvm.operator_id = ".$operator_id."
	";
	echo '<option value="">Select</option>';
	echo sel_options(db_assoc($sql_laps));

}elseif($mode==2){

	$acc_date = $_GET['acc_date'];
	$operator_id = $_GET['operator_id'];
	$lapu_no = $_GET['lapu_no'];
	$cur_date = date('Y-m-d');
	

	$where = '';

	if($acc_date!=''){
		$where.=" AND ad.acc_date = '".to_db_date($acc_date)."'";
	}

	if($operator_id!=''){
		$where.=' AND ad.operator_id='.$operator_id;
	}

	if($lapu_no!=''){
		$where.=" AND ad.lapu_no='".$lapu_no."'";
	}

	$sql_data="
	SELECT
		ad.*
		,op.operator_name
		,v.vendor_name
	FROM account_data ad
	INNER JOIN operator op ON op.id = ad.operator_id
	INNER JOIN xref_vol_mapping xvm ON xvm.lapu_number = ad.lapu_no
	INNER JOIN vendor v ON v.id = xvm.vendor_id
	WHERE
		1=1
		AND ad.status=1
		AND op.status = 1
		".$where."
	ORDER BY ad.acc_date DESC
	";
	$arr_data = db_all($sql_data);

	?> 
	<table class="table table-hover table-sm table-bordered table-advance">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Vendor</th>
				<th>Operator</th>
				<th>Lapu No</th>
				<th>Open Bal</th>
				<th>Prch amg</th>
				<th>Total</th>
				<th>Close Bal</th>
				<th>Rchg amt</th>
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

				$disable = '';
				if($row['acc_date'] != $cur_date){
					$disable = 'disabled';
				}
				if($_SESSION['is_admin']==1){
					$disable = '';
				}

				$str.='
				<tr>
					<td>'.$i++.'</td>
					<td>'.$row['acc_date'].'</td>
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
						<a href="data_entry.php?id='.$row['id'].'" class="btn btn-sm btn-success '.$disable.'" > <i class="fa fa-edit"></i> </a>
						<a href="#" data-attr_id="'.$row['id'].'" class="btn btn-sm btn-danger btn_del_acc '.$disable.'" > <i class="fa fa-times"></i> </a>
					</td>
				</tr>
				';
			}
			echo $str;
			?>
			
		</tbody>
	</table>
	<?php 

}elseif($mode==3){

	$vendor_id = $_GET['vendor_id'];

	$arr_data = [];
	$arr_data['status'] = 0;
	$where = ' id='.$vendor_id;
	db_update('vendor',$arr_data,$where);

	echo "Updated";

}elseif($mode==4){

	$operator_id = $_GET['operator_id'];

	$arr_data = [];
	$arr_data['status'] = 0;
	$where = ' id='.$operator_id;
	db_update('operator',$arr_data,$where);

	echo "Updated";

}elseif($mode==5){

	$lapu_no = $_GET['lapu_no'];

	$sql_max_date = "
		SELECT
			MAX(ad.acc_date) AS max_date
		FROM account_data ad

		WHERE
			1=1
			AND ad.status = 1
			AND ad.lapu_no = ".$lapu_no."
	";
	$arr_max_date = db_one($sql_max_date);
	
	if(!empty($arr_max_date)){
		$sql_get = "
			SELECT
				ad.closing_bal
			FROM account_data ad

			WHERE
				1=1
				AND ad.status = 1
				AND ad.lapu_no = ".$lapu_no."
				AND ad.acc_date = '".$arr_max_date['max_date']."'
		";
		$arr_cl_bal = db_one($sql_get);

		$cl_bal = 0;
		if(empty($arr_cl_bal)){
			$cl_bal = 0;
		}else{
			$cl_bal = $arr_cl_bal['closing_bal'];
		}
	}else{
		$cl_bal = 0;
	}
	

	echo $cl_bal;

}elseif($mode==6){

	$vendor_id = $_GET['v_id'];
	$op_id = $_GET['op_id'];
	$where = '';
	if($op_id){
		$where.=' AND operator_id='.$op_id;
	}
	if($vendor_id){
		$where.=' AND vendor_id='.$vendor_id;
	}

	$sql_lapu_numbers="
	    SELECT
	        xvm.id
	        ,v.vendor_name
	        ,op.operator_name
	        ,xvm.lapu_number
	    FROM xref_vol_mapping xvm
	    INNER JOIN vendor v ON v.id = xvm.vendor_id
	    INNER JOIN operator op ON op.id = xvm.operator_id

	    WHERE
	        1=1
	        AND xvm.status=1
	        AND v.status=1
	        AND op.status=1
	        ".$where."
	";
	$arr_lapu_numbers = db_all($sql_lapu_numbers); 


	$i=1; $str = '';
	$str.='<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>operator Name</th>
                    <th>Lapu Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
                
                foreach ($arr_lapu_numbers as $lapu) {
                    $str.='
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$lapu['vendor_name'].'</td>
                        <td>'.$lapu['operator_name'].'</td>
                        <td>'.$lapu['lapu_number'].'</td>
                        <td>
                            <button data-attr_id="'.$lapu['id'].'" class="btn btn-danger btn-sm btn_del_lapu"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    ';
                }
                                
           $str.='</tbody>
        </table>';

        echo $str;

}elseif($mode==7){

	$lap_sno = $_GET['lap_sno'];

	$arr_data = [];
	$arr_data['status'] = 0;
	$where = ' id='.$lap_sno;
	db_update('xref_vol_mapping',$arr_data,$where);

	echo "Deleted";

}else{
	echo "No Mode has sent to the page!";
	return false;	
}