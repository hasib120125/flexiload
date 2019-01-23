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
                                <li class="active">Reseller</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <?php
                        $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                        // dumpVar($reseller);
//                        echo "<pre>";
//                        print_r($reseller);die;
                        ?>
                        <form action="<?php echo site_url('admin/reseller_update/edit/' . $admin_id); ?>" role="form" method="post" id="adminform"  class="form-horizontal" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Type Your Name" value="<?php echo $reseller->name; ?>">
                                    <span id="name_error" style="color:red;display:none;">Name Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone NO" value="<?php echo $reseller->phone; ?>">
                                    <span id="phone_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                </div>
                            </div>
                            <?php
                            $test = $this->uri->segment(3);

//                           / dumpVar($test);
                            // $plan_list = $this->Common_model->get_data_list_by_single_column('plan', 'plan_id', $test);
                            // dumpVar($plan_list);
//                            $trId = $plan_list['plan_id'];
                            //dumpVar($trId);
                            $plan_list = $this->Common_model->get_data_list('plan');
                            ?>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Choose Plan</label>                                
                                <div class="col-sm-5">
                                    <select class="form-control" name="plan_id" id="plan_id"> 
                                        <option value="">select</option>
                                        <?php foreach ($plan_list as $plan_info) { ?>
                                            <option  value="<?php echo $plan_info['plan_id'] ?>"
                                            <?php
                                            if ($reseller->plan_id == $plan_info['plan_id']) {
                                                echo "selected";
                                            }
                                            ?>>
                                                <?php echo $plan_info['plan_title'] ?></option><?php } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Type Your Email" value="<?php echo $reseller->email; ?>">
                                    <span id="email_error" style="color:red;display:none;">Email Can't be empty!!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Address</label>                                
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="address" id="address" placeholder="Type Address" value=""><?php echo $reseller->address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Upload (Ex. Photo, Passport)</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control" name="photo" placeholder="Upload Here">
                                </div>
                                <div class="col-sm-2">
                                    <img class="img-responsive" src="<?php
                                    if (file_exists('assets/reseller/' . $reseller->photo)):
                                        echo base_url() . 'assets/reseller/' . $reseller->photo;
                                    endif;
                                    ?>" width="80">
                                </div>
                            </div>  
                            <!--                            <div class="form-group">
                                                            <label for="field-3" class="col-sm-3 control-label">Status</label>
                                                            <div class="col-sm-5">
                                                                <select class="form-control" name="status">
                                                                    <option value="Active" <?php // if($reseller->status=='Active'):         ?>selected="selected"<?php // endif;         ?>>Active</option>
                                                                    <option value="Inactive" <?php // if($reseller->status=='Inactive'):         ?>selected="selected"<?php // endif;         ?>>Inactive</option>
                                                                </select>                                 
                                                            </div>
                                                        </div>                            -->
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

