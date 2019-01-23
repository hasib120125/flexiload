<header class="header fixed clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="header-left clearfix">
                    <div class="logo">
                        <a href="<?php echo site_url('reseller')?>"><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="header-right clearfix">
                    <div class="main-navigation animated">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class=" active"><a href="<?php echo site_url('reseller')?>">Home</a></li>
                                        <li><a href="<?php echo site_url('profile')?>">Profile</a></li>       
                                        <li><a href="<?php echo site_url('topup')?>">Top Up</a></li>       
                                        <li><a href="<?php echo site_url('report')?>">Report</a></li>       
                                        <li><a href="<?php echo site_url('rate')?>">Rates</a></li>       
                                        <!--<li><a href="<?php // echo site_url('register')?>">Register</a></li>-->
                                        <li style="background: #f1f1f1"><a href="<?php echo site_url('logout') ?>" >Logout</a></li>  
                                    </ul>
                                </div>                                
                                
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>