<?php 
include '../includes/files.php';
$sql_vendor_list="
    SELECT
        *
    FROM vendor 
    WHERE
        1=1
        AND status = 1
";
$arr_vendors = db_all($sql_vendor_list);

?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Vendor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="result_msg"></div>
            <form action="save_vendor.php">
                <input type="hidden" name="mode" value=1>
            <div class="col-m-12 row form-group">
                <div class="col-md-3">
                    <label for="vendor_name" class="control-label req-label">Vendor Name </label>
                    <input type="text" name="vendor_name" class="form-control vendor_name validate-text">
                </div>
                <div class="col-md-3">
                    <label for="v_mobile" class="control-label req-label">Mobile Number </label>
                    <input type="number" name="v_mobile" class="form-control v_mobile validate-mobile" maxlength="10" >
                </div>
                <div class="col-md-4">
                    <label for="v_email" class="control-label ">Email </label>
                    <input type="email" name="v_email" class="form-control v_email">
                </div>
                <div class="col-md-1 right">
                    <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                    <button type="button" class="btn btn-primary add_vendor">Save</button>
                </div>
            </div>
            </form>
            <!-- Display the existing vendor list-->
            <div class="col-m-12 form-group">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vendor Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; $str = '';
                        foreach ($arr_vendors as $vendor) {
                            $str.='
                            <tr>
                                <td>'.$i++.'</td>
                                <td>'.$vendor['vendor_name'].'</td>
                                <td>'.$vendor['mobile_no'].'</td>
                                <td>'.$vendor['email'].'</td>
                                <td>
                                    <button data-attr_id="'.$vendor['id'].'" class="btn btn-danger btn-sm btn_del_vendor"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            ';
                        }
                        echo $str;
                        ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<script type="text/javascript">
   

</script>