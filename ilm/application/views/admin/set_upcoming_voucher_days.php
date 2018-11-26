<div class="panel panel-midnightblue">
    <div class="panel-body">
        <h4> Set Upcoming Voucher Days</h4>
        <form action="<?php echo base_url().'admin/'.$formSubmitMethod;?>" method="post">

            <div class="col-sm-2">
                <label for="" class="control-label">Days: </label>
                <input type="number" name="days" class="form-control" value="<?php echo $days;?>" required="required">
            </div>

            <div class="col-sm-2">

                <br>

                <input type="submit" class="btn btn-info" value="<?php echo $submitButtonTitle;?>" style="margin-top: 10px;">
            </div>


        </form>
    </div>
</div>