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
                        <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                            <div class="form-block center-block">
                                <h2 class="title">Login</h2>
                                <hr>
                                <form action="<?php echo site_url('user/signin') ?>" class="form-horizontal" method="POST" role="form" id="loginform">
                                   <div class="form-group has-feedback">
                                        <label for="inputUserName" class="col-sm-3 control-label">phone </label>
                                        <div class="col-sm-8">
                                           <input type="text" class="form-control" name="phone" id="phone" placeholder="Type Phone No">
                                            <i class="fa fa-user form-control-feedback"></i>
                                            <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>

                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputPassword" class="col-sm-3 control-label">Password </label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                            <i class="fa fa-lock form-control-feedback"></i>
                                            <span id="password_error" style="color:red;display:none;">Password Can't be empty!!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <!--                                            <div class="checkbox">
                                                                                            <label>
                                                                                                <input type="checkbox" required> Remember me.
                                                                                            </label>
                                                                                        </div>											-->
                                            <button type="button" class="btn btn-group btn-default btn-sm" onclick="check_validation()">Log In</button>
                                            <ul>
                                                <li>
                                                    <a  style="color: black" href="<?php echo site_url('forgot_password'); ?>">Forgot your password?</a>
                                                </li>
                                            </ul> 
                            <p style="font-size:14px">If you need any assistance please feel free to <a href="<?php echo site_url('contact')?>">Contact Us</a>.</p>
                                        </div>

                                    </div>

                                </form>
                                <script type="text/javascript">
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

                                        if (password == '') {
                                            $("#password_error").show();
                                            var password_conf = false;
                                        } else {
                                            $("#password_error").hide();
                                            var password_conf = true;
                                        }

                                        if (email_conf == true && password_conf == true) {
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
