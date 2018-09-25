<div class="verticalcenter">
    <a href="<?php echo base_url().'authentication';?>"><img src="<?php echo base_url();?>assets/img/logo-big.png" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Reset Password</h4>
            <form id="resetPassword" class="form-horizontal" style="margin-bottom: 0px !important;" method="post" action="<?php echo base_url();?>authentication/resetPassword">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <div class="pull-left">
                <a href="<?php echo base_url();?>authentication" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="pull-right">
                <a href="#" id="next" class="btn btn-success">Next <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>