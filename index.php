<?php 

	include 'includes/db_config.php';
	include 'includes/functions.php';

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
		
		<style>
			.card-login {
			    max-width: 25rem;
			}
		</style>

    </head>
    <body class="bg-dark1">
        
        

        <div class="container">
        	<div class="card card-login mx-auto mt-5">
		        <div class="card-header">Login</div>
		        <div class="card-body">
		          <form id="login_form" class="login-form" action="ajax/process_login.php" method="post">
		            <div class="form-group">
		              <div class="form-label-group">
		                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="form-label-group">
		                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
		              </div>
		            </div>
		            <button type="submit" class="btn btn-primary btn-block form-group">Login</button>
		            <div class="clearfix"></div>
		            <div class="col-md-12 form-group"><?php echo nbsp(41); ?><a href="terms_and_conditions.php" data-target="#ajax" data-toggle="ajax_modal" class="pull-right"> Terms & Conditions</a></div>
		          </form>
		          	<div class="text-center">
		          		
		            	<!-- <a class="d-block small mt-3" href="register.html">Register an Account</a> -->
		            	<!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
		          	</div>
		        </div>
		    </div>
        </div>


        <?php include_once('includes/ajax_modals.php'); ?>
        <script type="text/javascript" src="assets/jquery.js"></script>
        <script type="text/javascript" src="assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/custom.js"></script>
	
		<script>
			$(document).ready(function(){
				$(document).on('submit','#login_form',function(e){
					e.preventDefault();
					let $this = $(this);
					$.getJSON(
						$this.attr('action')+'?'+$this.serialize(),
						function(ret_data){
							console.log(ret_data);
							if(ret_data.status != 1){
								alert(ret_data.msg);
								$('#username').focus();
								$('#password').val('');
							}else{
								location.href = ret_data.path;
							}
						}
					);

				});
			});
		</script>

  </body>
</html>
