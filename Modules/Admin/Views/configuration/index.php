<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add New Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Add Form</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">

                        <form name="configuration" id="configuration" method="post">
                            <div class="row">
                                <div class="col-md-4">                            
                                    <div class="form-group">                                
                                        <div class="mb-3">
                                            <label class="form-label">Company Name <small> </small></label>
                                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?= $text['company_name'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company Address <small> </small></label>
                                            <input type="text" class="form-control" name="company_address" id="company_address" value="<?= $text['company_address'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company State Pin <small> </small></label>
                                            <input type="text" class="form-control" name="comapny_state_pin" id="comapny_state_pin" value="<?= $text['comapny_state_pin'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company Contact Email <small> </small></label>
                                            <input type="text" class="form-control" name="company_contact_email" id="company_contact_email" value="<?= $text['company_contact_email'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company Website <small> </small></label>
                                            <input type="text" class="form-control" name="company_website" id="company_website" value="<?= $text['company_website'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company no reply Email <small> </small></label>
                                            <input type="text" class="form-control" name="company_no_replay_email" id="company_no_replay_email" value="<?= $text['company_no_replay_email'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Company Phone <small> </small></label>
                                            <input type="text" class="form-control" name="company_phone" id="company_phone" value="<?= $text['company_phone'] ?>"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">SMTP Host <small> </small></label>
                                            <input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?= $text['smtp_host'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">SMTP User <small> </small></label>
                                            <input type="text" class="form-control" name="smtp_user" id="smtp_user" value="<?= $text['smtp_user'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">SMTP Password <small> </small></label>
                                            <input type="text" class="form-control" name="smtp_password" id="smtp_password" value="<?= $text['smtp_password'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">SMTP Port <small> </small></label>
                                            <input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?= $text['smtp_port'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">SMTP Auth <small> </small></label>
                                            <input type="text" class="form-control" name="smtp_auth" id="smtp_auth" value="<?= $text['smtp_auth'] ?>"/>
                                        </div>
                                    </div>                              
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">OTP Length <small> </small></label>
                                            <input type="text" class="form-control" name="otp_length" id="otp_length" value="<?= $text['otp_length'] ?>"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">OTP Validity <small> </small></label>
                                            <input type="text" class="form-control" name="otp_validity" id="otp_validity" value="<?= $text['otp_validity'] ?>"/>
                                        </div>
                                    </div> 


                                </div>
                                <div class="col-md-4">
                                    <div class="form-group  mt-4 mt-lg-0">
                                        <label class="form-label">Use Default Password <small> </small></label>
                                        <div class="d-flex flex-wrap gap-2">                                            
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch5" name="use_default_password" switch="bool" <?php
                                                if ($radio['use_default_password'] == "on") {
                                                    echo "checked";
                                                }
                                                ?>/>
                                                <label for="square-switch5" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Default Password <small> </small></label>
                                            <input type="text" class="form-control" name="default_password" id="default_password" value="<?= $text['default_password'] ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group  mt-4 mt-lg-0">
                                        <label class="form-label">Server Status<small> </small></label>
                                        <div class="d-flex flex-wrap gap-2">                                            
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch6" name="server_status" switch="bool" <?php
                                                if ($radio['server_status'] == "on") {
                                                    echo "checked";
                                                }
                                                ?>/>
                                                <label for="square-switch6" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  mt-4 mt-lg-0">
                                        <label class="form-label">Send SMS<small> </small></label>
                                        <div class="d-flex flex-wrap gap-2">                                            
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch7" name="send_sms" switch="bool" <?php
                                                if ($radio['send_sms'] == "on") {
                                                    echo "checked";
                                                }
                                                ?>/>
                                                <label for="square-switch7" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  mt-4 mt-lg-0">
                                        <label class="form-label">Send Email<small> </small></label>
                                        <div class="d-flex flex-wrap gap-2">                                            
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch8" name="send_email" switch="bool" <?php
                                                if ($radio['send_email'] == "on") {
                                                    echo "checked";
                                                }
                                                ?>/>
                                                <label for="square-switch8" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Session Time <small> </small></label>
                                            <input type="text" class="form-control" name="session_expire_time" id="session_expire_time" value="<?= $text['session_expire_time'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Record Per Page <small> </small></label>
                                            <input type="text" class="form-control" name="record_per_page" id="record_per_page" value="<?= $text['record_per_page'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group  mt-4 mt-lg-0">
                                        <label class="form-label">Maintenance Mode<small> </small></label>
                                        <div class="d-flex flex-wrap gap-2">                                            
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch9" name="maintenance_mode" switch="bool" <?php
                                                if ($radio['maintenance_mode'] == "on") {
                                                    echo "checked";
                                                }
                                                ?>/>
                                                <label for="square-switch9" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <!-- end card body -->
                                <div class="text-center mt-4">

                                    <input type="submit" class="btn btn-success waves-effect waves-light" value="Update Configuration"/>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->       

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
