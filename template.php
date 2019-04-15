<?php 
    include 'includes/files.php';
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
    <body class="">
        <?php include_once('includes/ajax_modals.php'); ?>
        <div class="container">
            <a href="ajax/test_modal.php" data-target="#ajax" data-toggle=ajax_modal>Click me</a>
        </div>

        <script type="text/javascript" src="assets/jquery.js"></script>
        <script type="text/javascript" src="assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/custom.js"></script>
    
        <script>
            $(document).ready(function(){
                
            });
        </script>

  </body>
</html>
