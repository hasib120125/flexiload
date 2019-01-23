<header class="header fixed clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="header-left clearfix">
                    <div class="logo">
                        <a href="<?php echo site_url('user')?>"><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo"></a>
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
                                        <li class=" active">
                                            <a href="<?php echo site_url('user')?>">Home</a>   
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('about_us')?>">about us</a>                                            
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('service')?>">services</a>                                            
                                        </li>	
                                        <li>
                                            <a href="<?php echo site_url('contact')?>">contact us</a>                                            
                                        </li>	
                                        <li style="background: #f1f1f1">
                                            <a href="<?php echo site_url('login')?>">Login</a>                                           
                                        </li>
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