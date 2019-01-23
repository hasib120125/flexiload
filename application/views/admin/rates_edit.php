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
                                <li class="active">Rate</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <?php
                        $reseller = $this->meclicksasia->table_info('rates', 'rates_id', $admin_id);
//                        echo "<pre>";
//                        print_r($reseller);die;
                        ?>
                        <form action="<?php echo site_url('admin/rates_update/edit/' . $admin_id); ?>" role="form" method="post" id="adminform"  class="form-horizontal">
                            <div class="form-group">

                            </div>	
                            <div class="form-group">
                                 <label for="field-1" class="col-sm-3 control-label">Date</label>

                                <div class="col-sm-5">
                                    <input type="text" readonly name="date" id="popupDatepicker" style="color:black" class="form-control datepicker" value="<?php echo $reseller->date; ?>">       
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="field-3" class="col-sm-3 control-label">Malaysia</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="malaysia" id="malaysia" value="1.00" readonly>
                                        <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                    </div>
                                </div>
<!--                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Date</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="date" id="date" value="<?php echo $reseller->date; ?>">
                                   
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Bangladesh</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="bangladesh" id="bangladesh" value="<?php echo $reseller->bangladesh; ?>">
                                    <span id="phone_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Indonesia</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="indonesia" id="indonesia" value="<?php echo $reseller->indonesia; ?>">
                                    <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Nepal</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nepal" id="nepal" value="<?php echo $reseller->nepal; ?>">
                                    <span id="pin_error" style="color:red;display:none;">PIN Can't be empty!!</span>                                 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit"  class="btn btn-default">Update</button>
                                </div>
                            </div>
                        </form>                      

                    </div>
                </div>
            </section>            

<?php $this->load->view('admin/footer'); ?> 

    </body>
</html>

