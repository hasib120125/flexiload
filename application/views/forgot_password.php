<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>eclicksasia.com</title>
        <meta name="description" content="Zaman-IT.com">
        <meta name="author" content="Dhaka Pharma">
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- header -->
        <?php $this->load->view('header'); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="front no-trans">

        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

            <?php $this->load->view('menu'); ?> 

            <section class="main-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <?php if (!empty($_SESSION['email_empty_message'])): ?>
                                <div class="alert alert-warning">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Warning!</strong> This email can't exits in our database.
                                </div>

                                <?php
                            endif;
                            unset($_SESSION['email_empty_message']);
                            ?>
                            <?php if (!empty($_SESSION['email_comfirm_message'])): ?>
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>success!</strong> You will receive an email with instructions on how to reset your password in a few minutes.
                                </div>
                            
                                <?php
                            endif;
                            unset($_SESSION['email_comfirm_message']);
                            ?>

                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="row">
                        <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                            <div class="form-block center-block form-horizontal">
                                <h2 class="title">Type Email Address</h2>
                                <hr>
                                
                                <span id="result"></span>
                                <!--<form action="#" class="form-horizontal" method="POST" role="form" id="loginform">-->
                                    <div class="form-group has-feedback">
                                        <label for="inputUserName" class="col-sm-3 control-label">Email </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control email" name="email" id="email" placeholder="Type Email" >
                                            <i class="fa fa-user form-control-feedback"></i>
                                            <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" onclick="forgot_password_email()" class="btn btn-group btn-default btn-sm" onclick="check_validation()">Submit</button>                              
                                        </div>
                                    </div>
                                <!--</form>-->
                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
    });  
    
    function forgot_password_email() { 
        var email = $('.email').val();        
        $.ajax({
            type: 'POST',
            data: {email:email},
            url: '<?php echo site_url('forgot_password_email'); ?>',
            success: function (result) {
                $('#result').html(result);
            }
        });
    }   
    
    function check_validation() {

        var email = $("#email").val();
        var password = $("#password").val();

        if (email == '') {
            $("#email_error").show();
            var email_conf = false;
        } else {
            $("#email_error").hide();
            var email_conf = true;
        }
        if (email_conf == true) {
            $("#loginform").submit();
        } else {                                           
            return false;
        }

    }
</script>	
                            </div>               
                        </div>
                    </div>
                </div>
            </section>           
            <br><br><br><br>   
            <?php $this->load->view('footer'); ?> 
            </body>
            </html>

