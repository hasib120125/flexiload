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
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('admin/index') ?>">Home</a></li>
                                <li class="active">Commission update</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <?php // $comission = $this->meclicksasia->table_info('plan_rate','plan_id',$plan_id); ?>
                        
                        <form action="<?php echo site_url('admin/comisssion_update/edit/' . $plan_id); ?>" role="form" method="post" id="adminform"  class="form-horizontal">

                            <div class="row">
                                <div class="col-md-3"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-4 control-label">Plan Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="plan_title" value="<?php echo $this->meclicksasia->table_info('plan','plan_id',$plan_id)->plan_title; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">                               
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Celcom IDD Indonesia</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="CI">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'CI'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Digi Wow Reload</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="DW">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'DW'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Altel</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="A">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'A'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Buzz Me</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="B">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'B'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">BestMobile</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="BM">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'BM'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Celcom</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="C">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'C'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Digi</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="D" >
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'D'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Digi Broadband</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="DBB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'DBB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Friendi</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="F">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'F'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">I Talk</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="IP">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'IP'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Maxis</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="M">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'M'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Merchant Trade</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="MC">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'MC'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">XOX Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="XB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'XB'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">MolPoints</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="MOL">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'MOL'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">OneXOX</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="OX">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'OX'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Tron</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="R">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'R'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Tune Talk</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="T">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'T'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">TMGo</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="TMG">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'TMG'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">U Mobile</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="U">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'U'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">YesPrepaid</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="YES">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'YES'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Celcom Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="CB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'CB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Digi Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="DB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'DB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Maxis Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="MB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'MB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">RedOne Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="RB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'RB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">U Mobile Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="UB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'UB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">ABNxcess</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="ABN">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'ABN'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Astro Bill</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="ASB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'ASB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Njoi Pinless </label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="N">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'N'); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Kuching Water Board</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="KWB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'KWB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Sabah Electricity</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="SESB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'SESB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Syarikat Bekalan Air Selangor</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="SYABAS">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'SYABAS'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Syarikat Air Melaka</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="SAMB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'SAMB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Syarikat Air Negeri Sembilan</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="SAINS">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'SAINS'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Syarikat Air Terengganu</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="SATU">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'SATU'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Tenaga Nasional Berhad</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="TNB">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'TNB'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Telekom Malaysia</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="TM">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'TM'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Bangladesh</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="BD">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'BD'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Indonesia</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="ID">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'ID'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">Nepal</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="NP">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'NP'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-7 control-label" style="font-size: 12px">e-Wallet</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="product[]" value="ewallet">
                                            <input type="text" class="form-control" name="comission[]" placeholder="0.00" value="<?php echo $this->meclicksasia->plan_rate_comission($plan_id,'ewallet'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit"  class="btn btn-default">Update</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>   
                    </div>
                </div>
            </section>            

            <?php $this->load->view('admin/footer'); ?> 

    </body>
</html>