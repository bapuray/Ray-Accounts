
$(document).on('click', '[data-toggle=ajax_modal]', function(){
	$this = $(this);
	url = $this.attr('href');
	$modal = $($this.attr('data-target'));
	//remove_extra_classes();
	$modal.html('').load(url, { "_": $.now() }, function(){
		$modal.modal({'keyboard':false,backdrop: 'static'});
		//apply_extra_classes();
	});
	return false;
});

$(document).on('click','.add_vendor',function(e){
	e.preventDefault();
	$this = $(this);
	if($('.vendor_name').val()==''){
		alert('Please enter Vendor Name');
		return false;
	}
	if($('.v_mobile').val()==''){
		alert('Please enter Mobile Number');
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

			$('.result_msg').html(msg);

		},
		cache:false,
		contentType:false,
		processData:false
	});

});

$(document).on('click','.add_operator',function(e){
	e.preventDefault();
	$this = $(this);
	if($('.op_name').val()==''){
		alert('Please enter Operator Name');
		return false;
	}
	if($('.desc').val()==''){
		alert('Please enter description');
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

			$('.result_msg').html(msg);

		},
		cache:false,
		contentType:false,
		processData:false
	});

});

$(document).on('click','.save_lapu_no',function(e){
	e.preventDefault();
	$this = $(this);

	if($('.sel_vendor').text()==''){
		alert('Please select vendor');
		return false;
	}
	if($('.sel_operator').text()==''){
		alert('Please select operator');
		return false;
	}
	if($('.lapu_numbers').val()==''){
		alert('Please enter atlease one lapu number');
		return false;
	}

	var fd = new FormData($this.parents('form')[0]);
	$.ajax({
		url:"ajax/save_data.php",
		type:'POST',
		data:fd,
		async: false,
		success: function(ret_data){
			alert(ret_data);

		},
		cache:false,
		contentType:false,
		processData:false
	});

});

$(document).on('click','.btn_del_vendor',function(){
	$this = $(this);
	let vendor_id=$this.attr('data-attr_id');
	let url = 'ajax/common_ajax.php';
	bootbox.confirm('are you sure ? ',function(res){
		if(res){
			$.get(
				url,{'vendor_id':vendor_id,'mode':3},function(ret_data){
					$this.parents('tr').remove();
					console.log(ret_data);
				}	
			);
		}
	});
	
});
$(document).on('click','.btn_del_operator',function(){
	$this = $(this);
	let operator_id=$this.attr('data-attr_id');
	let url = 'ajax/common_ajax.php';
	bootbox.confirm('are you sure ? ',function(res){
		if(res){
			$.get(
				url,{'operator_id':operator_id,'mode':4},function(ret_data){
					$this.parents('tr').remove();
					console.log(ret_data);
				}	
			);
		}
	});
	
});

$(document).on('keypress','.validate-mobile',function(){
	$this = $(this);
	if($this.val().length > 9){
		event.preventDefault();
		return false;
	}
});

$(document).on('keypress','.lapu_numbers',function(e){
	
	var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    a.push(44);
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
});

$(document).on('keypress','.validate-text',function(e){
//$('input').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

$(document).on('change','.mln_op_id,.sel_vendor',function(){
	let op_id = $('.mln_op_id').val();
	let v_id = $('.sel_vendor').val();
	let url = 'ajax/common_ajax.php';
	$.get(url,{'op_id':op_id,'v_id':v_id,'mode':6},function(res){
		$('.mapped_lapu_nos').html(res);
	});

});

$(document).on('click','.btn_del_lapu',function(){
	$this = $(this);
	let lap_sno = $this.attr('data-attr_id');
	let url = 'ajax/common_ajax.php';
	bootbox.confirm('are you sure ? ',function(res){
		if(res){
			$.get(
				url,{'lap_sno':lap_sno,'mode':7},function(ret_data){
					$this.parents('tr').remove();
					console.log(ret_data);
				}	
			);
		}
	});
});


$(document).on('click', '.export_data', function(){
	var $this = $(this);
	// var title = $this.parents('div.export_div').prevAll('.caption').text();
	var title = $this.parents('div.export_div').prevAll('.panel-heading').text();
	var $table = $this.parents('div.export_div').parent().next('.exportable').find('table').clone();
	$table.find('.no_exp').remove();
	var body = $table.html();
	// console.log(body);return false;
	if(!body){
		bootbox.alert('No data to export');
		return false;
	}
	var $frm = $this.parents('ul').next('form.export');
	var i_d = $this.attr('data-i_d');
	$frm.attr('action', $this.attr('href'));
	$frm.find('[name=header]').val(title);
	$frm.find('[name=body]').val(body);
	$frm.find('[name=i_d]').val(i_d);
	$frm.trigger('submit')
	return false;
});

 
