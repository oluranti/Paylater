    <?php $this->load->module('template'); ?>
<div class="dashboard">
<?php if($this->session->userdata('usertype') == 'inactive'){ ?>
    <div class="alert alert-block">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <h4>Inactive Account!</h4>
      Your account has not been approved by an administrator. <br />
      You will get an email once an administrator approves your account.<br />
      Please, check back later.
    </div>
    <?php }else{ ?>
    <?php 
    $cook = md5('why_did_the_chicken_cross_the_road?');
    $setcook = setcookie("A_Chickens_World",$cook,0,"/",".special-brand.com"); 
    ?>
    <style>
    .main_content {
    padding: 41px 0px 0px;
    background: #fff;
    border-left: 1px solid transparent;
    margin-left: 240px;
    }
    
    footer{
        display:none;
    }
    
    html{
        overflow: hidden;
    }
    </style>
        <iframe src="http://store.special-brand.com/admin" width="100%" frameborder="0" noresize="noresize" style="width: 100%; height: auto; border: 1px #ccc solid;"></iframe>
        <script>
        $(document).ready(function(){
            var navbar = $('.navbar').height();
            var dcheight = $(window).height();
           $('.dashboard iframe').height(dcheight - navbar);
           $(window).resize(function(){
            var navbar = $('.navbar').height();
            var dcheight = $(window).height();
           $('.dashboard iframe').height(dcheight - navbar);
           });
        });
        </script>
    <?php } ?>
</div>