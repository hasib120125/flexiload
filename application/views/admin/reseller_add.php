<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="Zaman-IT.com">
        <meta name="author" content="Dhaka Pharma">
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- header -->
        <?php $this->load->view('admin/header'); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="front no-trans">

        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

            <?php $this->load->view('admin/menu'); ?> 

            <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="#">Home</a></li>
                                <li class="active">Add Reseller</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">
<?php 
                        $message = $this->session->userdata('Exist');
                        if(isset($message)||!empty($message)):
                        ?>
                        <div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-check"></i> <?php echo $message; ?>
                        </div>            
                        <?php $this->session->unset_userdata('Exist'); endif; ?>
                        <form action="<?php echo site_url('admin/reseller_create/add'); ?>" role="form" method="post" id="adminform"  class="form-horizontal" enctype="multipart/form-data">
			
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Type Your Name">
                                    <span id="name_error" style="color:red;display:none;">Name Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Phone</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone NO">
                                    <span id="phone_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                    <span id="length_error" style="color:red;display:none;">Phone length min 11 character</span>
                                </div>
                            </div>
                            <?php
                            $plan_list = $this->Common_model->get_data_list('plan');
                           // dumpVar($plan_list);
                            ?>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Choose Plan</label>                                
                                <div class="col-sm-5">

                                    <select class="form-control" name="plan_id" id="plan_id">
                                        <option selected="selected">Select</option>
                                        <?php foreach ($plan_list as $plan_info) {
                                            ?>
                                                                                        <option value="<?php echo $plan_info['plan_id'] ?>" <?php if($plan_info['plan_id']==1): ?>selected="selected"<?php endif; ?>>
                                                <?php echo $plan_info['plan_title'] ?>
                                            </option>
                                        <?php }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Address</label>                                
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="address" id="address" placeholder="Type Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">PIN</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="pin" id="pin" placeholder="Type Your PIN">
                                    <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Type Your Email">
                                    <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
                                    <span id="email_error2" style="color:red;display:none;">Please type valid email address!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="12"  maxlength="6" name="password" class="form-control generate_password" id="password" placeholder="Type Password">
                                    <span id="password_error" style="color:red;display:none;">Password Can't be empty!!</span>
                                    <span id="pw_length_error" style="color:red;display:none;">Password length min 6 character</span>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="generatepassword">Generate Password</button>
                                </div>                                
                            </div>
<script type="text/javascript"> 
$(document).ready(function(){  
    $('#generatepassword').click(function(){	
        $.ajax({
            type: 'POST', 
            url: '<?php echo site_url('user/generate_password'); ?>', 
            success: function(result){ 
                $('.generate_password').val(result); 
            } 
        });
    });	
});
</script>                         
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Upload (Ex. Photo, Passport)</label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="photo" placeholder="Upload Here">
                                </div>
                            </div>                              
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="button" onclick="fomvalidation();"  class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>   
                        <script>
                            function isNumber(evt) {
                                evt = (evt) ? evt : window.event;
                                var charCode = (evt.which) ? evt.which : evt.keyCode;
                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                    return false;
                                }
                                return true;
                            }
                        </script>
                        <script>
                            function fomvalidation() {
                                //alert('ok');
                                var patern = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);

                                var name = $("#name").val();
                                var email = $("#email").val();
                                var phone = $("#phone").val();
                                var phone_length = $("#phone").val().length;
                                var password = $("#password").val();


                                var name_conf = '';
                                var valid_email_conf = '';
                                var phone_conf = '';
                                var phone_length_conf = '';
                                var password_conf = '';

                                if (name == '') {
                                    $("#name_error").show();
                                    var name_conf = false;
                                } else {
                                    $("#name_error").hide();
                                    var name_conf = true;
                                }

                                if (phone == '') {
                                    $("#phone_error").show();
                                    var phone_conf = false;
                                } else {
                                    $("#phone_error").hide();
                                    var phone_conf = true;
                                }

                                if (phone != '' && phone_length < 11) {
                                    $("#length_error").show();
                                    var phone_length_conf = false;
                                } else {
                                    $("#length_error").hide();
                                    var phone_length_conf = true;
                                }

                                if (email !== '') {
                                    $("#email_error").hide();
                                }
                                if (patern.test(email)) {
                                    $("#email_error").hide();
                                    $("#email_error2").hide();
                                    var valid_email_conf = true;
                                } else {
                                    $("#email_error2").show();
                                    var valid_email_conf = false;
                                }

                                if (password == '') {
                                    $("#password_error").show();
                                    var password = false;
                                } else {
                                    $("#password_error").hide();
                                    var password = true;
                                }
                                if (password != '' && phone_length < 6) {
                                    $("#pw_length_error").show();
                                    var password_length_conf = false;
                                } else {
                                    $("#pw_length_error").hide();
                                    var password_length_conf = true;
                                }

                                if (name_conf == true && phone_conf == true && phone_length_conf == true && valid_email_conf == true && password == true) {
                                    $("#adminform").submit();
                                } else {
                                    return false;
                                }

                            }
                        </script>

                    </div>
                </div>
            </section>            

            <?php $this->load->view('admin/footer'); ?> 

    </body>
</html>

