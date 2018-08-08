<section>
            
            <div class="panel panel-signup">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo base_url();?>/assets/images/codeigniter_logo.png" alt="CI Logo" height="40" width="130">
                    </div>
                    <br />
                    <h4 class="text-center mb5">Upload Images</h4>
                    <?php $submit_path='home_cont/upload_to_db/'.$user_id;?>
                    <?php echo form_open_multipart($submit_path);?>
                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_1">
                            <input id="upload_image_1" type="file" name="image_1" style="display:none;" onchange="$('#upload-file-info1').html($(this).val());">
                            Image 1
                            </label>
                            <span class='label label-info' id="upload-file-info1"></span>
                        </div>

                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_2">
                            <input id="upload_image_2" type="file" name="image_2" style="display:none;" onchange="$('#upload-file-info2').html($(this).val());">
                            Image 2
                            </label>
                            <span class='label label-info' id="upload-file-info2"></span>
                        </div>


                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_3">
                            <input id="upload_image_3" type="file" name="image_3" style="display:none;" onchange="$('#upload-file-info3').html($(this).val());">
                            Image 3
                            </label>
                            <span class='label label-info' id="upload-file-info3"></span>
                        </div>


                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_4">
                            <input id="upload_image_4" type="file" name="image_4" style="display:none;" onchange="$('#upload-file-info4').html($(this).val());">
                            Image 4
                            </label>
                            <span class='label label-info' id="upload-file-info4"></span>
                        </div>


                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_5">
                            <input id="upload_image_5" type="file" name="image_5" style="display:none;" onchange="$('#upload-file-info5').html($(this).val());">
                            Image 5
                            </label>
                            <span class='label label-info' id="upload-file-info5"></span>
                        </div>


                        <div class="form-group">
                            <label class="btn btn-primary" for="upload_image_6">
                            <input id="upload_image_6" type="file" name="image_6" style="display:none;" onchange="$('#upload-file-info6').html($(this).val());">
                            Image 6
                            </label>
                            <span class='label label-info' id="upload-file-info6"></span>
                        </div>
                         
                    <?php form_close();?>
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <?php
                        $attr=array(
                        'class'=>'btn btn-success btn-block',
                        'type'=> 'submit'
                        );
                        echo form_button($attr,'<span class="glyphicon glyphicon-upload"></span> Upload');
                    ?>
                    <!-- <a href="<?php //echo base_url();?>home_cont/upload" class="btn btn-success btn-block"><i class="glyphicon glyphicon-upload"></i> Upload</a> -->

                    <?php
                        if (isset($msg)) {
                            echo $msg;
                            foreach ($upload_data as $key => $value) {
                                echo "$key -> $value";
                            }
                        }
                        if (isset($error)) {
                            echo $error;
                        }
                    ?>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>