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
        <?php $this->load->view('reseller/header'); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="front no-trans">

        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

            <?php $this->load->view('reseller/menu'); ?> 

            <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('reseller/index')?>">Home</a></li>
                                <li class="active">Register</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">

                        <form action="<?php echo site_url('reseller/register/add'); ?>" role="form" method="post" id="regiform"  class="form-horizontal">
                            <div class="form-group">

                            </div>			
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Type Your Name">
                                    <span id="name_error" style="color:red; display:none;">Name Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone NO">
                                    <span id="phone_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Type Your Email">
                                    <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Type Password">
                                    <span id="password_error" style="color:red;display:none;">Password Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="button" onclick="formvalidation()" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>                   
                        <script>
                            function formvalidation() {
                                var name = $("#name").val();
                                var phone = $("#phone").val();
                                var email = $("#email").val();
                                var password = $("#password").val();

                                var name_conf = '';
                                var phone_conf = '';
                                var email_conf = '';
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
                                if (email == '') {
                                    $("#email_error").show();
                                    var email_conf = false;
                                } else {
                                    $("#email_error").hide();
                                    var email_conf = true;
                                }
                                if (password == '') {
                                    $("#password_error").show();
                                    var password_conf = false;
                                } else {
                                    $("#password_error").hide();
                                    var password_conf = true;
                                }

                                if (name_conf == true && phone_conf == true && email_conf == true && password_conf == true) {
                                    $("#regiform").submit();
                                } else {
                                    return false;
                                }

                            }
                        </script>
                    </div>
                </div>
            </section>            

            <?php $this->load->view('reseller/footer'); ?> 

    </body>
</html>

