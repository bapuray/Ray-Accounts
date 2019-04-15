<?php
	include 'db_config.php';
	
	function db_insert($table, $arr){
		global $conn;
		$column_names = implode(',', array_keys($arr));
		$bind_params = ':'.implode(',:', array_keys($arr));
		$sql  = 'INSERT INTO '.$table.'('.$column_names.') '.'VALUES('.$bind_params.')';
		return db_query($sql, $arr);
	}

	function db_update($table, $arr_update, $where){
		global $conn;
		$sql = 'UPDATE '.$table. ' SET ';
		foreach($arr_update as $col => $val){
			$sql .= $col.' = :'.$col.', ';
		}
		$sql = substr($sql, 0, -2);
		$sql .= ' WHERE '.$where;
		return db_query($sql, $arr_update);
	}

	function db_query($sql, $arr = array()){
		global $conn;
		try{
			$stmt = $conn->prepare($sql);
			$stmt->execute($arr);	
		}
		catch(PDOException $e){
			echo 'Error: '.$e->errorInfo[2];
			exit();
		}
		if(preg_match("/^(" . implode("|", array("select")) . ") /i", $sql)){
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		elseif(preg_match("/^(" . implode("|", array("delete", "update")) . ") /i", $sql)){
			return $stmt->rowCount();
		}
		elseif(preg_match("/^(" . implode("|", array( "insert")) . ") /i", $sql)){
			return $conn->lastInsertId();
		}
	}

	function db_one($sql, $params = array(), $fetch_type = PDO::FETCH_ASSOC){
		global $conn;
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetch($fetch_type);
	}	
	
	// fetches all rows that match the conditions
	function db_all($sql, $params = array(), $fetch_type = PDO::FETCH_ASSOC){
		global $conn;	
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll($fetch_type);
	}	
	
	// fetches an associative array with row 1 as key and row 2 as value
	function db_assoc($sql, $params = array(), $fetch_type = PDO::FETCH_NUM){
		global $conn;
		$arr = array();
		if( $sql != "" ){
			$stmt = $conn->prepare($sql);
			$stmt->execute($params);
			while( $record = $stmt->fetch($fetch_type) ){
				$arr[ $record[0] ] = $record[1];
			}
		}
		return $arr;
	}

	function sel_options($arr, $sel = ''){
		$options = '';
		$arr_sel = explode(',', $sel);
		foreach($arr as $value=>$text){
			$selected = !in_array($value, $arr_sel) ? '' : 'selected';
			$options .= '<option value="'.$value.'" '.$selected.'>'.$text.'</option>';
		}
		return $options;
	}

	function to_db_date($input_date){
		return date('Y-m-d',strtotime($input_date));
	}

	function gen_pw($plain_text){
		$blowfish_pre = '$2a$05$';
		$blowfish_end = '$';
		$allowed_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
		$chars_len = 63;
		$salt_length = 21;
		$salt = "";
		for($i=0; $i<$salt_length; $i++)
		{
			$salt .= $allowed_chars[mt_rand(0,$chars_len)];
		}
		$bcrypt_salt = $blowfish_pre . $salt . $blowfish_end;
		$hashed_password = crypt($plain_text, $bcrypt_salt);
		return array($salt, $hashed_password);
	}

	function get_accounts_data($acc_date=NULL){


		$where = '';
		if($acc_date!=NULL){
			$where = " AND ad.acc_date = '".$acc_date."'";
		}

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
				".$where."
			ORDER BY ad.acc_date DESC
		";
		return $arr_data = db_all($sql_data);

	}

	function nbsp($n){
		$str = '';
		for($i = 1;$i<=$n;$i++){
			$str.='&nbsp;';
		}
		return $str;
	}