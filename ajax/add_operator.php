<?php 
include '../includes/files.php';
$sql_operator_list="
    SELECT
        *
    FROM operator 
    WHERE
        1=1
        AND status = 1
";
$arr_operators = db_all($sql_operator_list);

?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Operator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="result_msg"></div>
            <form action="#">
                <input type="hidden" name="mode" value=2>
                <div class="col-m-12 row form-group">
                    <div class="col-md-5">
                        <label for="op_name" class="control-label req-label">Operator Name </label>
                        <input type="text" name="op_name" class="form-control op_name validate-text">
                    </div>
                    <div class="col-md-5">
                        <label for="desc" class="control-label req-label">description </label>
                        <input type="text" name="desc" class="form-control desc validate-text">
                    </div>
                    <div class="col-md-1 right">
                        <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        <button type="button" class="btn btn-primary add_operator">Save</button>
                    </div>
                </div>
            </form>
            <!-- Display the existing vendor list-->
            <div class="col-m-12 form-group">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Operator Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; $str = '';
                        foreach ($arr_operators as $operator) {
                            $str.='
                            <tr>
                                <td>'.$i++.'</td>
                                <td>'.$operator['operator_name'].'</td>
                                <td>'.$operator['description'].'</td>
                                <td>
                                    <button data-attr_id="'.$operator['id'].'" class="btn btn-danger btn-sm btn_del_operator"><i class="fa fa-times"></i></button>
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
