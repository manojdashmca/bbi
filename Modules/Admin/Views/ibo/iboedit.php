<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">IBO Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">IBO</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm order-2 order-sm-1">
                                <div class="d-flex align-items-start mt-3 mt-sm-0">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xl me-3">
                                            <?php
                                            if (empty($userdetail->kyc_image)) {
                                                $image = "/uploads/images/default.jpg";
                                            } else {
                                                $image = "/uploads/images/kyc/" . $userdetail->kyc_image;
                                            }
                                            ?>
                                            <img src="<?= $image ?>" alt="" class="img-fluid rounded-circle d-block">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-16 mb-1"><?= $userdetail->user_title . ' ' . $userdetail->user_name ?></h5>
                                            <p class="text-muted font-size-13"></p>

                                            <!--                                            <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Development</div>
                                                                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>phyllisgatlin@minia.com</div>
                                                                                        </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link px-3 active" data-bs-toggle="tab" href="#personal" role="tab">Personal Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" data-bs-toggle="tab" href="#contact" role="tab">Contact Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" data-bs-toggle="tab" href="#banking" role="tab">Banking Info</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link px-3" data-bs-toggle="tab" href="#kyc" role="tab">KYC Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" data-bs-toggle="tab" href="#password" role="tab">Login Info</a>
                            </li>

                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="tab-content">
                    <div class="tab-pane active" id="personal" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Personal Detail</h5>
                            </div>
                            <div class="card-body">
                                <div>  
                                    <form name="personaldetail" id="personaldetail" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Title</label>
                                                    <div>
                                                        <input type="radio" name="title" value="Sri" class="form-check-input" <?= ($userdetail->user_title == 'Sri') ? 'checked="checked"' : '' ?>/> Sri  
                                                        <input type="radio" name="title" value="Mr" class="form-check-input" <?= ($userdetail->user_title == 'Mr') ? 'checked="checked"' : '' ?>/> Mr  
                                                        <input type="radio" name="title" value="Mrs" class="form-check-input" <?= ($userdetail->user_title == 'Mrs') ? 'checked="checked"' : '' ?>/> Mrs  
                                                        <input type="radio" name="title" value="Miss" class="form-check-input" <?= ($userdetail->user_title == 'Miss') ? 'checked="checked"' : '' ?>/> Miss  
                                                        <input type="radio" name="title" value="Dr" class="form-check-input" <?= ($userdetail->user_title == 'Dr') ? 'checked="checked"' : '' ?> /> Dr  
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">User Code</label>
                                                    <input type="text" class="form-control" id="code" name="code" value="<?= $userdetail->user_code ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $userdetail->user_name ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Father/Husband Name</label>
                                                    <input type="text" class="form-control" id="fatherhusband" name="fatherhusband" value="<?= $userdetail->user_father_husband ?>">
                                                </div>                                    
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Date Of Birth</label>
                                                    <input type="text" class="form-control flatpickr-input" id="dob" name="dob" placeholder="dd-mm-yyyy" value="<?= makeDate($userdetail->user_dob, 'd-m-Y') ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-xl-3">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Gender</label>
                                                    <div>
                                                        <input type="radio" name="gender" value="Male" class="form-check-input" <?= ($userdetail->user_gender == 'Male') ? 'checked="checked"' : '' ?>/> Male  
                                                        <input type="radio" name="gender" value="Female" class="form-check-input" <?= ($userdetail->user_gender == 'Female') ? 'checked="checked"' : '' ?>/> Female  
                                                        <input type="radio" name="gender" value="Trans" class="form-check-input" <?= ($userdetail->user_gender == 'Trans') ? 'checked="checked"' : '' ?>/> Trans Gender 

                                                    </div>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-xl-3">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Marital Status</label>
                                                    <div>
                                                        <input type="radio" name="maritalstatus" value="Single" class="form-check-input" <?= ($userdetail->user_marital_status == 'Single') ? 'checked="checked"' : '' ?>/> Single  
                                                        <input type="radio" name="maritalstatus" value="Married" class="form-check-input" <?= ($userdetail->user_marital_status == 'Married') ? 'checked="checked"' : '' ?>/> Married  
                                                        <input type="radio" name="maritalstatus" value="Widow" class="form-check-input" <?= ($userdetail->user_marital_status == 'Widow') ? 'checked="checked"' : '' ?>/> Widow  
                                                        <input type="radio" name="maritalstatus" value="Divorcee" class="form-check-input" <?= ($userdetail->user_marital_status == 'Divorcee') ? 'checked="checked"' : '' ?>/> Divorcee  
                                                    </div>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Education Qualification</label>
                                                    <input type="text" class="form-control" id="eduqual" name="eduqual" value="<?= $userdetail->user_education ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Professional Certification</label>
                                                    <input type="text" class="form-control" id="profcert" name="profcert" value="<?= $userdetail->user_profession_certification ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Blood Group</label>
                                                    <select name="bloodgroup" id="bloodgroup" class="form-select">
                                                        <option value="">Select Blood Group</option>
                                                        <option value="O -Ve" <?= ($userdetail->user_blood_group == 'O -Ve') ? 'selected="selected"' : '' ?>>O -Ve</option>
                                                        <option value="O +Ve" <?= ($userdetail->user_blood_group == 'O +Ve') ? 'selected="selected"' : '' ?>>O +Ve</option>
                                                        <option value="A -Ve" <?= ($userdetail->user_blood_group == 'A -Ve') ? 'selected="selected"' : '' ?>>A -Ve</option>
                                                        <option value="A +Ve" <?= ($userdetail->user_blood_group == 'A +Ve') ? 'selected="selected"' : '' ?>>A +Ve</option>
                                                        <option value="B -Ve" <?= ($userdetail->user_blood_group == 'B -Ve') ? 'selected="selected"' : '' ?>>B -Ve</option>
                                                        <option value="B +Ve" <?= ($userdetail->user_blood_group == 'B +Ve') ? 'selected="selected"' : '' ?>>B +Ve</option>
                                                        <option value="AB -Ve" <?= ($userdetail->user_blood_group == 'AB -Ve') ? 'selected="selected"' : '' ?>>AB -Ve</option>
                                                        <option value="AB +Ve" <?= ($userdetail->user_blood_group == 'AB +Ve') ? 'selected="selected"' : '' ?>>AB +Ve</option>
                                                    </select>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">If you are connected with NGOs, Political parties, Ex-Army Man ? please specify the</label>
                                                    <div>
                                                        <input type="radio" name="glink" value="Yes" class="form-check-input" <?= ($userdetail->user_group_link == 'Yes') ? 'checked="checked"' : '' ?>> Yes  
                                                        <input type="radio" name="glink" value="No" class="form-check-input" <?= ($userdetail->user_group_link == 'No') ? 'checked="checked"' : '' ?>> No  

                                                    </div>
                                                    <div class="mt-2">
                                                        <input type="text" class="form-control" id="nameofgroup" name="nameofgroup" placeholder="Name Of organization" value="<?= $userdetail->user_group_link_org ?>"> 

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <!-- end row -->
                                        <div class="text-center mt-4">
                                            <input type="hidden" name="pinfoencuserid" id="pinfoencuserid" value="<?= $encuserid ?>"/>                                        
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Update"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="contact" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Communication Detail</h5>
                            </div>
                            <div class="card-body">
                                <div>  
                                    <form name="contactdetail" id="contactdetail" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="<?= $userdetail->user_address ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Pin-code</label>
                                                    <input type="text" class="form-control" id="pincode" name="pincode" onblur="return getAddress()" value="<?= $userdetail->user_pincode ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Post Office</label>
                                                    <select class="form-control" id="postoffice" name="postoffice">
                                                        <option value="">Select Post Office</option>
                                                    </select>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" value="<?= $userdetail->user_city ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">District</label>
                                                    <input type="text" class="form-control" id="district" name="district" readonly="" value="<?= $userdetail->user_district ?>">
                                                </div>                                    
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" id="state" name="state" readonly="" value="<?= $userdetail->user_state ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country" readonly="" value="<?= $userdetail->user_country ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Mobile</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $userdetail->user_mobile ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Whatsapp No</label>
                                                    <input type="text" class="form-control" id="whatsappno" name="whatsappno" value="<?= $userdetail->user_whatsappno ?>">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Email Id</label>
                                                    <input type="text" class="form-control" id="emailid" name="emailid" value="<?= $userdetail->user_email ?>">
                                                </div>                                    
                                            </div>
                                        </div>

                                        <!-- end row -->
                                        <div class="text-center mt-4">
                                            <input type="hidden" name="cinfoencuserid" id="cinfoencuserid" value="<?= $encuserid ?>"/>                                        
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Update"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="banking" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Post</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form name="bankingdetail" id="bankingdetail" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Ac No</label>
                                                    <input type="text" class="form-control" id="bankacno" name="bankacno" value="<?= $userdetail->user_bank_ac_no ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">IFS Code</label>
                                                    <input type="text" class="form-control" id="bankifsc" name="bankifsc" value="<?= $userdetail->user_bank_ifsc ?>" onblur="return getBankDetail();">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bankname" name="bankname" value="<?= $userdetail->user_bank_name ?>" readonly="">
                                                </div>                                    
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Branch Name</label>
                                                    <input type="text" class="form-control" id="bankbranch" name="bankbranch" value="<?= $userdetail->user_bank_branch ?>" readonly="">
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">PAN No</label>
                                                    <input type="text" class="form-control" id="panno" name="panno" value="<?= $userdetail->user_pan ?>">
                                                </div>                                    
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="hidden" name="binfoencuserid" id="binfoencuserid" value="<?= $encuserid ?>"/>                                        
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Update"/>
                                        </div>
                                    </form>

                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end tab pane -->

                    

                    <div class="tab-pane" id="kyc" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">KYC Detail</h5>
                            </div>
                            <div class="card-body">
                                <div>  
                                    <form name="kycdetail" id="kycdetail" method="post">
                                        <div class="row">                                        
                                            <div class="col-lg-6">
                                                <div class="row">                                        
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">Address Proof</label>
                                                            <input type="file" class="form-control" name="addressproof" id="addressproff" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php if (!empty($userdetail->kyc_address)) { ?>
                                                            <a href="/uploads/images/kyc/<?= $userdetail->kyc_address ?>" class="image-popup" data-title="KYC" data-description="User Addressproof KYC Document">
                                                                <img src="/uploads/images/kyc/<?= $userdetail->kyc_address ?>"  alt="Kyc-Address" height="100" width="250">
                                                            </a>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">                                        
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">PAN Copy</label>
                                                            <input type="file" class="form-control" name="pancopy" id="pancopy">
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php if (!empty($userdetail->kyc_pan)) { ?>
                                                            <a href="/uploads/images/kyc/<?= $userdetail->kyc_pan ?>" class="image-popup" data-title="KYC" data-description="User PAN KYC Document">
                                                                <img src="/uploads/images/kyc/<?= $userdetail->kyc_pan ?>"  alt="Kyc-PAN" height="100" width="250">
                                                            </a>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="row">                                        
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" class="form-control" name="userimage" id="userimage">
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php if (!empty($userdetail->kyc_image)) { ?>
                                                            <a href="/uploads/images/kyc/<?= $userdetail->kyc_image ?>" class="image-popup" data-title="KYC" data-description="User Image KYC Document">
                                                                <img src="/uploads/images/kyc/<?= $userdetail->kyc_image ?>"  alt="Kyc-Image" height="100" width="250">
                                                            </a>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">                                        
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">Cancel Cheque</label>
                                                            <input type="file" class="form-control" name="cancelcheque" id="cancelcheque">
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php if (!empty($userdetail->kyc_cancel_cheque)) { ?>
                                                            <a href="/uploads/images/kyc/<?= $userdetail->kyc_cancel_cheque ?>" class="image-popup" data-title="KYC" data-description="User Cancel Cheque KYC Document">
                                                                <img src="/uploads/images/kyc/<?= $userdetail->kyc_cancel_cheque ?>"  alt="Kyc-cheque" height="100" width="250">
                                                            </a>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="hidden" id="usercode" name="usercode" value="<?= $userdetail->user_code ?>">
                                            <input type="hidden" name="kinfoencuserid" id="kinfoencuserid" value="<?= $encuserid ?>"/>                                        
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Update"/>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recover Password</h5>
                            </div>
                            <div class="card-body">
                                <div>         
                                    <form name="logincredential" id="logincredential" method="post">
                                        <div class="row">                                    
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">User Password</label>
                                                    <input type="text" class="form-control" id="currentpassword" name="currentpassword" value="<?= $password ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">User Login Name</label>
                                                    <input type="hidden" id="hiddenusername" name="hiddenusername" value="<?= $userdetail->user_login_name ?>">
                                                    <input type="text" class="form-control" id="loginname" name="loginnanem" value="<?= $userdetail->user_login_name ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">New Password</label>
                                                    <input type="text" class="form-control" id="newpassword" name="newpassword">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="hidden" name="linfoencuserid" id="linfoencuserid" value="<?= $encuserid ?>"/>                                        
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Update"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Joining Info</h5>

                        <div class="d-flex flex-wrap gap-2 font-size-16">
                            <a href="#" class="badge badge-soft-primary">Joining Date- <?= $userdetail->user_create_date ?></a>
                            <a href="#" class="badge badge-soft-primary">Activation Date- <?= $userdetail->user_activation_date ?></a>
                            <a href="#" class="badge badge-soft-primary">Sponsor- <?= $userdetail->sponsor ?></a>
                            <a href="#" class="badge badge-soft-primary">KYC Compliance - <?= $userdetail->kyc ?></a>
                            <a href="#" class="badge badge-soft-primary">KYC Date- <?= $userdetail->kyc_date ?></a>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Item 2</h5>

                        <!--                        <div>
                                                    <ul class="list-unstyled mb-0">
                                                        <li>
                                                            <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-web text-primary me-1"></i> Website</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-note-text-outline text-primary me-1"></i> Blog</a>
                                                        </li>
                                                    </ul>
                                                </div>-->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Item 3</h5>

                        <!--                        <div class="list-group list-group-flush">
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm flex-shrink-0 me-3">
                                                                <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">James Nix</h5>
                                                                    <p class="font-size-13 text-muted mb-0">Full Stack Developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm flex-shrink-0 me-3">
                                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="img-thumbnail rounded-circle">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">Darlene Smith</h5>
                                                                    <p class="font-size-13 text-muted mb-0">UI/UX Designer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm flex-shrink-0 me-3">
                                                                <div class="avatar-title bg-soft-light text-light rounded-circle font-size-22">
                                                                    <i class="bx bxs-user-circle"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">William Swift</h5>
                                                                    <p class="font-size-13 text-muted mb-0">Backend Developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>-->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->