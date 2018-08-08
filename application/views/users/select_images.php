<section>
            <div class="panel panel-images">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo base_url();?>/assets/images/codeigniter_logo.png" alt="CI Logo" height="40" width="130">
                    </div>
                    <br />
                    <h4 class="text-center mb5">Select Images In Sequence</h4>
                    
                    <div class="mb30"></div>
                    <?php
                        $checkbox_id=1;
                        foreach ($user_images as $key => $value) {
                            echo "<div class=\"selectImage\">";
                                    echo "<img src=\"".$value."\" height=\"160\" width=\"160\">";
                                    echo "<input type=\"checkbox\" class=\"chkbox\" id=\"$checkbox_id\" onclick=\"getImage('".$checkbox_id."')\" value=\"".$value."\">";
                                    
                                    echo "</div>";
                            $checkbox_id++;
                        }

                    ?>
                   
                    
                </div><!-- panel-body -->

                <div class="panel-footer">
                    <a href="<?php echo base_url();?>home_cont/index" class="btn btn-primary" style="float:left;">Go Back</a>
                    <?php echo form_open('home_cont/login_verify');?>
                        <div id="imgs"></div>
                        <?php
                            $attr=[
                                'value'=>'Login',
                                'class'=>'btn btn-success',
                                'style'=>'float:right;'
                            ];
                        ?>
                        <input type="hidden" name="username" value="<?php echo $username;?>">
                        <?php echo form_submit($attr);?>
                    <?php echo form_close();?>
                    <div style="clear:both;"></div>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>
        <div class="mb30"></div>