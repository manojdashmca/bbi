<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add New Member</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Member</a></li>
                            <li class="breadcrumb-item active">Add Member</li>
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
                        <h4 class="card-title">Member Registration Form</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <form name="useradd" id="useradd" method="post" enctype="multipart/form-data">
                            <div>
                                <h5 class="font-size-14 mb-3">Module Information</h5>
                                <div class="row">                                
                                    <div class="col-lg-3 col-md-6">
                                        <div class="row">  
                                            <div class="col-lg-8 col-md-8 col-sm-6">
                                                <div class=" form-group mb-3">
                                                    <label class="form-label">Module Id</label>
                                                    <input type="text" class="form-control" id="moduleid" name="moduleid">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 mt-4">
                                                <button type="button" class="btn btn-primary" id="getModuleDetail" onclick="return CheckModuleDetail();">Get Detail</button>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">Module Name</label>
                                            <input type="hidden" name="hidmodule" id="hidmodule" value=""/>
                                            <input readonly="" type="text" class="form-control" id="modulename" id="modulename">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">Zone Name</label>                                            
                                            <input readonly="" type="text" class="form-control" id="zonename" id="zonename">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">Country Name</label>                                            
                                            <input readonly="" type="text" class="form-control" id="countryname" id="countryname">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">State Name</label>                                            
                                            <input readonly="" type="text" class="form-control" id="statename" id="statename">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">City Name</label>                                            
                                            <input readonly="" type="text" class="form-control" id="cityname" id="cityname">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">Module Director</label>                                            
                                            <input readonly="" type="text" class="form-control" id="moduledirector" id="moduledirector">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-size-14 mb-3">Sponsorship Information</h5>
                                <div class="row">                                
                                    <div class="col-lg-3 col-md-6">
                                        <div class="row">  
                                            <div class="col-lg-8 col-md-8 col-sm-7">
                                                <div class=" form-group mb-3">
                                                    <label class="form-label">Sponsor Id</label>
                                                    <input type="text" class="form-control" id="sponsorid" name="sponsorid">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-5 mt-4">
                                                <button type="button" class="btn btn-primary" id="getDetail" onclick="return CheckSponsor();">Get Detail</button>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-6">                                    
                                        <div class="form-group mb-3">
                                            <label class="form-label">Sponsor Name</label>
                                            <input type="hidden" name="hidval" id="hidval" value=""/>
                                            <input readonly="" type="text" class="form-control" id="sponsorname" id="sponsorname">
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div>
                                <h5 class="font-size-14 mb-3">Personal Information</h5>
                                <div class="row">                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Member Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>                                     
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Date Of Birth</label>
                                            <input type="text" class="form-control flatpickr-input" id="dob" name="dob" placeholder="dd-mm-yyyy">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xl-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Gender</label>
                                            <div>
                                                <input type="radio" name="gender" value="Male" class="form-check-input"> Male  
                                                <input type="radio" name="gender" value="Female" class="form-check-input"> Female  
                                                <input type="radio" name="gender" value="Trans" class="form-check-input"> Trans Gender 

                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xl-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Marital Status</label>
                                            <div>
                                                <input type="radio" name="maritalstatus" value="Single" class="form-check-input"> Single  
                                                <input type="radio" name="maritalstatus" value="Married" class="form-check-input"> Married  
                                                <input type="radio" name="maritalstatus" value="Widow" class="form-check-input"> Widow  
                                                <input type="radio" name="maritalstatus" value="Divorcee" class="form-check-input"> Divorcee  
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Educational Qualification</label>
                                            <input type="text" class="form-control" id="eduqual" name="eduqual">
                                        </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Professional Certification</label>
                                            <input type="text" class="form-control" id="profcert" name="profcert">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Blood group</label>
                                            <select name="bloodgroup" id="bloodgroup" class="form-select">
                                                <option value="">Select Blood Group</option>
                                                <option value="O -Ve">O -Ve</option>
                                                <option value="O +Ve">O +Ve</option>
                                                <option value="A -Ve">A -Ve</option>
                                                <option value="A +Ve">A +Ve</option>
                                                <option value="B -Ve">B -Ve</option>
                                                <option value="B +Ve">B +Ve</option>
                                                <option value="AB -Ve">AB -Ve</option>
                                                <option value="AB +Ve">AB +Ve</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">If you are connected with NGOs, Political parties, Ex-Army Man ? please specify the</label>
                                            <div>
                                                <input type="radio" name="glink" value="Yes" class="form-check-input"> Yes  
                                                <input type="radio" name="glink" value="No" class="form-check-input"> No  

                                            </div>
                                            <div class="mt-2">
                                                <input type="text" class="form-control" id="nameofgroup" name="nameofgroup" placeholder="Name Of organization"> 

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end row -->
                            </div>
                            <div>
                                <h5 class="font-size-14 mb-3">Communication Detail</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Pin-code</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" onblur="return getAddress()">
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
                                            <input type="text" class="form-control" id="city" name="city">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">District</label>
                                            <input type="text" class="form-control" id="district" name="district" readonly="">
                                        </div>                                    
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" name="state" readonly="">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" readonly="">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Whatsapp No</label>
                                            <input type="text" class="form-control" id="whatsappno" name="whatsappno">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Email Id</label>
                                            <input type="text" class="form-control" id="emailid" name="emailid">
                                        </div>                                    
                                    </div>
                                </div>

                                <!-- end row -->
                            </div>
                            
                            <div>
                                <h5 class="font-size-14 mb-3">Personal Banking Detail</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Ac No</label>
                                            <input type="text" class="form-control" id="bankacno" name="bankacno">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">IFS Code</label>
                                            <input type="text" class="form-control" id="bankifsc" name="bankifsc" onblur="return getBankDetail();">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bankname" name="bankname" readonly="">
                                        </div>                                    
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Branch Name</label>
                                            <input type="text" class="form-control" id="bankbranch" name="bankbranch" readonly="">
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">PAN No</label>
                                            <input type="text" class="form-control" id="panno" name="panno">
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-size-14 mb-3">KYC Detail</h5>
                                <div class="row">    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Cancel Cheque</label>
                                            <input type="file" class="form-control" name="cancelcheque" id="cancelcheque">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Address Proof</label>
                                            <input type="file" class="form-control" name="addressproof" id="addressproff">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">PAN Copy</label>
                                            <input type="file" class="form-control" name="pancopy" id="pancopy">
                                        </div>                                    
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>                                    
                                    </div>

                                </div>

                                <!-- end row -->
                            </div>
                            <!-- end row -->
                            <div class="text-center mt-4">
                                <input type="hidden" name="utr" id="utr" value="<?= time() . rand(1000, 9999) ?>"/>    
                                <input type="reset" class="btn btn-primary waves-effect waves-light" value="Cancel"/>
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Cretae Member"/>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->       

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->