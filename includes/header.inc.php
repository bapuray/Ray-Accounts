<?php 
    $home_link = '#';
    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
        $home_link = 'dashboard_admin.php';
    }else{
        $home_link = 'data_entry.php';
    }
?>

<nav class="navbar navbar-inverse navbar-default1">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $home_link; ?>">Raycharge <span class="sr-only">(current)</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="">
                <a class="nav-link" href="ajax/add_vendor.php" data-target="#ajax" data-toggle="ajax_modal"> <i class="fa fa-plus-circle"></i> Add Vendor</a>
            </li>
            <li class="">
                 <a class="nav-link" href="ajax/add_operator.php" data-target="#ajax" data-toggle="ajax_modal"><i class="fa fa-plus-circle"></i> Add Operator</a>
            </li>
            <li class="">
                 <a class="nav-link" href="ajax/map_lapu_number.php" data-target="#ajax" data-toggle="ajax_modal"><i class="fa fa-map"></i> Map Lapu Number</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-file-pdf"></i> Reports <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="acc_report.php">Accounts</a>
                    </li>
                </ul>
            </li>
        </ul>
     
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
