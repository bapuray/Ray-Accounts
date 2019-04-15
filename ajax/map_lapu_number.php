<?php 
include '../includes/files.php';
$sql_operator_list="
    SELECT
        id,operator_name
    FROM operator 
    WHERE
        1=1
        AND status = 1
";
$sql_vendor_list="
    SELECT
        id,vendor_name
    FROM vendor 
    WHERE
        1=1
        AND status = 1
";


?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       
        <div class="modal-header">
            <h5 class="modal-title">Map Lapu Number</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <form action="#">
                <div class="result_msg"></div>
                <input type="hidden" name="mode" value=3>
                <div class="col-md-12 row form-group">
                    <div class="col-md-6 form-group">
                        <label for="op_name" class="control-label req-label">Select Vendor </label>
                        <select name="sel_vendor" class="form-control sel_vendor">
                            <option value="">Select</option>
                            <?php echo sel_options(db_assoc($sql_vendor_list)) ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="desc" class="control-label req-label">Select Operator </label>
                        <select name="sel_operator" class="form-control sel_operator mln_op_id">
                            <option value="">Select</option>
                            <?php echo sel_options(db_assoc($sql_operator_list)) ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="desc" class="control-label req-label">Enter Lapu Number (s) </label>
                        <textarea name="lapu_numbers" cols="105" rows="3" class="form-control lapu_numbers" placeholder="Enter comma(,) seperated values if you have more than one lapu number for this operator" pattern="^[0–9]$"></textarea>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary save_lapu_no"> <i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
                <!-- Display the existing vendor list-->
                <div class="col-m-12 form-group mapped_lapu_nos">
                    
                </div>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    $('.mln_op_id').trigger('change');
</script>
