<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<style>
			
		</style>
	</head>
	<body>
		<div class="container">
			<br><br><br>
			
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Operator & Customer Information</div>
				  	<div class="panel-body">
				    	<ul class="nav nav-pills">
						  	<li class="active"><a href="#tab1">Mobile Operator</a></li>
						  	<li><a href="#tab2">DTH Operator</a></li>
						  	<li><a href="#tab3">DTH Customer Info</a></li>
						  	<li><a href="#tab3">DTH Customer Info</a></li>
						  	<li><a href="#tab4">Others</a></li>
						</ul>
						
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<div class="col-md-12 "> <br><br>
									<div class="col-md-8 form-group">
										<label class="control-label">Mobile Number</label>
										<input type="text" class="mobile_no form-control" name="mobile_no">
									</div>
									<div class="clearfix"></div>
									<div class="col-md-12 operator_data">
										
									</div>
									<div class="clearfix"></div>
									<div class="col-md-8 form-group">
										<button class="btn btn-success pull-right get_mobile_operator">Get Operator</button>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab2">
								Tab 2
							</div>
							<div class="tab-pane" id="tab3">
								Tab 3
							</div>
							<div class="tab-pane" id="tab4">
								Tab 4
							</div>
						</div>
				  	</div>
				</div>
				

			</div>

		</div>
		
		<script src="assets/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.nav-pills a').click(function(e){
					e.preventDefault()
  					$(this).tab('show')
				});

				$(document).on('click','.get_mobile_operator',function(e){
					let $this = $(this);
					
					let fd = new FormData($this.parents('form')[0]);

					fd.append('mode',1);
					$.ajax({
						url:'ajax/operator_api.php',
						type:'POST',
						data:fd,
						async:false,
						success:function(ret_data){
							$('.operator_data').html(ret_data);
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
