<?php $this->load->module('template'); ?>
        <div class="alerts">
        <?php if(isset($alert)){ ?>
            <div class="alert <?php if(isset($alert_type)){echo "alert-".$alert_type;}else{ echo "alert-block"; } ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $alert; ?>
            </div>
        <?php } ?>
        </div>
        <?php
        if((@$view_file != "") && (@$module != "")){
            $path = $module."/".$view_file;
            $this->load->view($path);
        }else{ ?>
            <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Error!</h4>
            Oh snap! No view file or module defined or you do not have permission to access this page.
            </div>
        <?php }    ?>