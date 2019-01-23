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
                <div class="main">
                    <div class="container">
                        <div class="row">
                            <div class="main col-md-8">
                                <h1 class="page-title">Contact Us</h1>
                                <!-- page-title end -->
                                <p>To contact us directly, Please fill in the following form and send it to us.</p>

                                <div class="contact-form">
                                    <form action="<?php echo site_url('user/contacts'); ?>" method="post" id="contactform" class="form-horizontal" role="form"> 
                                        <div class="form-group has-feedback">
                                            <label for="name">Name*</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="">
                                            <i class="fa fa-user form-control-feedback"></i>
											<span id="name_error" style="color:red;display:none;">Name Can't be empty!!</span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="email">Email*</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                                            <i class="fa fa-envelope form-control-feedback"></i>
											<span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
											<span id="email_error2" style="color:red;display:none;">Please type valid email address!!</span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="subject">Subject*</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="">
                                            <i class="fa fa-navicon form-control-feedback"></i>
											<span id="subject_error" style="color:red;display:none;">Subject Can't be empty!!</span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="message">Message*</label>
                                            <textarea class="form-control" rows="6" id="message" name="message" placeholder=""></textarea>
                                            <i class="fa fa-pencil form-control-feedback"></i>
											<span id="message_error" style="color:red;display:none;">Message Can't be empty!!</span>
                                        </div>
										
                                       <button type="button" onclick="check_validation()" value="Submit" class="submit-button btn btn-default">Submit</button>
                                    </form>
									
									<script type="text/javascript">
										function check_validation(){
											
											var patern = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);
											
											var name = $("#name").val();
											var email =  $("#email").val();
											var subject =  $("#subject").val();
											var message =  $("#message").val();
											
											
											if(name == ''){
												$("#name_error").show();
												var name_conf = false;
											}else{
												$("#name_error").hide();
												var name_conf = true;
											}
											if(email !== ''){
												$("#email_error").hide();			
											}
											if (patern.test(email)) {
												$("#email_error").hide();
												$("#email_error2").hide();
												var valid_email_conf=true;
											} else {
												$("#email_error2").show();
												var valid_email_conf=false;
											}
											if(subject == ''){
												$("#subject_error").show();
												var subject_conf = false;
											}else{
												$("#subject_error").hide();
												var subject_conf = true;
											}
											if(message == ''){
												$("#message_error").show();
												var message_conf = false;
											}else{
												$("#message_error").hide();
												var message_conf = true;
											}
											
											
											
											if(name_conf == true && valid_email_conf== true && subject_conf == true && message_conf == true){
												$("#contactform").submit();
											}else{
												return false;
											}
										}
									</script>
                                </div>
                            </div>
                            <!-- main end -->

                            <!-- sidebar start -->
                            <aside class="col-md-4">
                                <div class="sidebar">
                                    <div class="side vertical-divider-left">
                                        <h3 class="title">eClickAsia</h3>
                                        <ul class="list">
                                            <li><strong></strong></li>
                                            <li><i class="fa fa-home pr-10"></i>795 Folsom Ave, Suite 600<br><span class="pl-20">San Francisco, CA 94107</span></li>
                                            <li><i class="fa fa-phone pr-10"></i><abbr title="Phone">P:</abbr> (123) 456-7890</li>
                                            <li><i class="fa fa-mobile pr-10 pl-5"></i><abbr title="Phone">M:</abbr> (123) 456-7890</li>
                                            <li><i class="fa fa-envelope pr-10"></i><a href="mailto:info@idea.com">info@eclickasia.com</a></li>
                                        </ul>
                                        <ul class="social-links colored circle large">
                                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                            <!-- sidebar end -->

                        </div>
                    </div>
                </div>
            </section>

            <?php $this->load->view('footer'); ?> 

    </body>
</html>

