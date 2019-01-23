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
        <?php
        $query = $this->meclicksasia->last_rates();
        $query['rates_id'];
//            
//            echo "<pre>";
//            print_r($query);
//            die;

        $query = $this->db->get_where('rates', array('rates_id' => $query['rates_id']));
        $result = $query->row_array();

//            echo "<pre>";
//            print_r($result);
//            die;
        ?>
        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

            <?php $this->load->view('reseller/menu'); ?> 

            <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('reseller/index')?>">Home</a></li>
                                <li class="active">Todays Rates</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- modified by Jesan -->

                <div class="row" style="background: #cf2e16;">  
                <br>
                <div class="col-md-9">
                    <p style="color:white; text-decoration: none;  ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username: 
                        <a href="<?php echo site_url('reseller/profile') ?>" style="text-decoration: none; color: white;"> <?php

                            $admin_id = $this->session->userdata('admin_id');
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
//                        $admin_id = $this->session->userdata('admin_id');
//                        $in = $this->meclicksasia->transaction_in($admin_id);
//                        $out = $this->meclicksasia->transaction_out($admin_id);
//                        $commission = $this->meclicksasia->transaction_commissions($admin_id);
//                        $charge = $this->meclicksasia->transaction_charge($admin_id);
//                        $balance = $in + $commission - $out - $charge;
                        
                        $admin_id = $this->session->userdata('admin_id');
                            $balance = $this->meclicksasia->current_points($admin_id);
                        echo number_format((float) $balance, 4, '.', '');
                        ?>                       
                    </a>
                </div>
            </div>

            <!-- end of modification -->


            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
<h3>Product Price</h3>
                            <table class="table table-bordered datatable table-hover" id="table-1">
                                <thead>
                                <?php $admin_id = $this->session->userdata('admin_id');
                                $adminx = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                                $plan = $this->meclicksasia->table_info('plan', 'plan_id', $adminx->plan_id);
                                
                                ?>
                                    <tr>                                      
                                        <th  style="text-align: center"; colspan="3">Commission Plan (<?php echo $plan->plan_title ?>)</th>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $product = $this->meclicksasia->product_price('plan_rate', 'plan_id', $plan->plan_id);  
                                    foreach ($product as $value) {?> 
                                    <tr>                                        
                                        <td align="left"> <?php echo $value['product_name'] ?> </td>                                           
                                        <td align="center"><?php echo $value['product'] ?></td>                                           
                                        <td align="center"><?php echo $value['comission'] ?></td>

                                    </tr>    
                                    <?php } ?>                                                                                 
                                </tbody>                                  
                            </table>     
                            <br>

                            <h3>Exchange Rate</h3>
                            <table class="table table-bordered datatable table-hover" id="table-1">
                                <thead>
                                    <tr>                                                                                                              
                                        <th  style="text-align: center"; colspan="4">Rates (<?php echo date('d-m-Y', strtotime($result['date'])) ?>)</th>                                                                                                                   
                                    </tr>
                                </thead>
                                <tbody >
                                       <tr>
                                        <td colspan="4"style="font-weight: bold; text-align: center">&nbsp;Malaysia RM: 1 </td>
                                    </tr>
                                    <tr>                                        
                                        <td><img src="<?php echo base_url() ?>assets/flags/flags/16/Bangladesh.png" style="float:left;">&nbsp;&nbsp;Bangladesh</td>                                           
                                        <td style="text-align: right">BDT. <?php echo $result['bangladesh'] ?></td>

                                    </tr>                                                                                                                
                                    <tr>                                        
                                        <td><img src="<?php echo base_url() ?>assets/flags/flags/16/Indonesia.png" style="float:left;">&nbsp;&nbsp;Indonesia</td>                                           
                                        <td style="text-align: right">IDR. <?php echo $result['indonesia'] ?></td>  

                                    </tr>                                      
                                    <tr>                                        
                                        <td><img src="<?php echo base_url() ?>assets/flags/flags/16/Nepal.png" style="float:left;">&nbsp;&nbsp;Nepal</td>                                           
                                        <td style="text-align: right">NPR. <?php echo $result['nepal'] ?></td>  

                                    </tr>                                      
                                </tbody>                                  
                            </table>                          
                        <br>

<!-- modification by Jesan -->


                                <h3>Charges</h3> 
                                <table class="table table-bordered datatable" id="table-1">
                                    <thead>
                                        <tr>                                                     
                                            <th>Date</th>                                                                                                                          
                                            <th>Charge</th>                                                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->meclicksasia->charge();
                                        
//                                        echo  "<pre>";
//                                        print_r($query);
//                                        die;
                                        foreach ($query as $row):
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row['date']; ?></td>                                                                                  
                                                <td><?php echo $row['amount']; ?></td>                                             
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                           </div>     


<!-- end of modification -->

<!--                        <div class="col-md-6">
                            <div class="row">

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
                </div>
            </section>            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <?php $this->load->view('reseller/footer'); ?> 

            </body>
            </html>

