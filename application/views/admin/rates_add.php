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
    <div class="col-md-6">

        <!--<link rel="stylesheet" href="<?php // echo base_url()      ?>assets/daterangepicker/daterangepicker-bs3.css">-->
        <link href="<?php echo base_url() ?>datepicker/jquery.datepick.css" rel="stylesheet">
        <script src="<?php echo base_url() ?>datepicker/jquery.plugin.js"></script>
        <script src="<?php echo base_url() ?>datepicker/jquery.datepick.js"></script>
        <script>
            $(function () {
                $('#popupDatepicker').datepick({
                   dateFormat: 'dd-mm-yyyy'
                });
                $('#date2').datepick();
                
            })
        </script>
    </div>
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
                 
                            <form action="<?php echo site_url('admin/rates_create/add'); ?>" role="form" method="post" id="adminform"  class="form-horizontal">
                                <div class="form-group">
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Date</label>

                                    <div class="col-sm-3">
                                        <input type="text" name="date" id="popupDatepicker" class="form-control datepicker">       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="col-sm-3 control-label">Malaysia</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="malaysia" id="malaysia" value="1.00" readonly>
                                        <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="col-sm-3 control-label">Bangladesh</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="bangladesh" id="bangladesh" placeholder="0.00">
                                        <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="col-sm-3 control-label">Indonesia</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="indonesia" id="indonesia" placeholder="0.00">
                                        <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="col-sm-3 control-label">Nepal</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="nepal" id="nepal" placeholder="0.00">
                                        <span id="pin_error" style="color:red; display:none;">PIN Can't be empty!!</span>                                 
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit"  class="btn btn-default">Submit</button>
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

<!--                        <div class="col-md-4">
                            <div class="row">
                                <br>
                                <br>
                                <div id='gcw_mainFwO91PGH7' class='gcw_mainFwO91PGH7'></div>

                                <script>function reloadFwO91PGH7() {
                                        var sc = document.getElementById('scFwO91PGH7');
                                        if (sc)
                                            sc.parentNode.removeChild(sc);
                                        sc = document.createElement('script');
                                        sc.type = 'text/javascript';
                                        sc.charset = 'UTF-8';
                                        sc.async = true;
                                        sc.id = 'scFwO91PGH7';
                                        sc.src = 'http://freecurrencyrates.com/en/widget-vertical?iso=MYRBDTIDRNPR&df=2&p=FwO91PGH7&v=fits&source=fcr&width=245&width_title=0&firstrowvalue=1&thm=A6C9E2,FCFDFD,4297D7,e84c3d,FFFFFF,C5DBEC,FCFDFD,2E6E9E,000000&title=Currency%20Converter&tzo=-360';
                                        var div = document.getElementById('gcw_mainFwO91PGH7');
                                        div.parentNode.insertBefore(sc, div);
                                    }
                                    reloadFwO91PGH7();</script>

                            </div>
                        </div>-->
      
            </div>
        </section>     


        <?php $this->load->view('admin/footer'); ?> 

</body>
</html>

