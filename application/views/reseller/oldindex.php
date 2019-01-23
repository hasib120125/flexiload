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
            <div class="row" style="background: #cf2e16;">  
                <br>
                <div class="col-md-9">
                    <p style="color:white; text-decoration: none;  ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username: 
                        <a href="<?php echo site_url('reseller/profile') ?>" style="text-decoration: none; color: white;"> <?php
                            $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                            echo $reseller->name;
                            echo "<br>";
                            ?>

                        </a>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> User ID:</span>
                        <a href="<?php echo site_url('reseller/profile') ?>" style="text-decoration: none; color: white;"> <?php
                            $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                            echo $reseller->phone;
                            ?>

                        </a>
                    </p>
                </div>

                <div class="col-md-3">
                    <a style=" color:white; text-decoration: none;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Points:                        
                        <?php
                        $admin_id = $this->session->userdata('admin_id');
                        $in = $this->meclicksasia->transaction_in($admin_id);
                        $out = $this->meclicksasia->transaction_out($admin_id);
                        $commission = $this->meclicksasia->transaction_commissions($admin_id);
                        $charge = $this->meclicksasia->transaction_charge($admin_id);
                        $balance = $in + $commission - $out - $charge;
                        echo number_format((float) $balance, 2, '.', '');
                        ?>                       
                    </a>
                </div>
            </div>
            <section class="main-container" style="background:#f1f1f1">

                <div class="main">

                    <div class="container">

                        <div class="col-md-12">

                            <h2 class="text-center title">Services</h2>
                            <div class="separator"></div>

                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <a style="text-decoration: none;" href="<?php echo site_url('reseller/topup') ?>"">
                                        <div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="0">                              
                                            <img src="<?php echo base_url() ?>assets/images/bd.svg">      
                                            <h3 style="font-size: 13px;">Bangladesh Topup</h3> 
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a style="text-decoration: none;" href="<?php echo site_url('reseller/topup') ?>"">
                                        <div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">
                                            <img src="<?php echo base_url() ?>assets/images/my.svg">
                                            <h3 style="font-size: 13px;">Malaysia Topup</h3>   
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a style="text-decoration: none;" href="<?php echo site_url('reseller/topup') ?>"">
                                        <div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="400">
                                            <img src="<?php echo base_url() ?>assets/images/id.svg">                            
                                            <h3 style="font-size: 13px;">Indonesia Topup</h3>                  
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a style="text-decoration: none;" href="<?php echo site_url('reseller/topup') ?>"">
                                        <div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">
                                            <img src="<?php echo base_url() ?>assets/images/np.svg">
                                            <h3 style="font-size: 13px;">Nepal Topup</h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a style="text-decoration: none;" href="<?php echo site_url('reseller/topup') ?>"">
                                        <div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">
                                            <img src="<?php echo base_url() ?>assets/images/eem.png">
                                            <h3 style="font-size: 13px; ">e-Wallet</h3>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>                       

        </div>
        <br>


        <?php $this->load->view('reseller/footer'); ?> 

    </body>
</html>

