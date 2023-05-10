<div class="col-xl-12 col-lg-12 col-md-12 bg-color-6">
    <div class="form-section">
        <div class="logo">
            <a href="javascript:void()">
                <img src="<?= CUSTOMPATH ?>panelassets/images/logobbi.png" alt="" height="150">
            </a>
        </div>
        <h3>Fill The Joining Form</h3>
        <div class="login-inner-form">
            <form name="registrationform" id="registrationform" method="post" enctype="multipart/form-data">
                <div>
                    <h5 class="font-size-14 mb-3">Module Information</h5>
                    <div class="row">                                
                        <div class="col-lg-3 col-md-6">
                            <div class="row">  
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class=" form-group mb-3">
                                        <label class="form-label">Module Name/Id</label>
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
                    <h5 class="font-size-14 mb-3">Business Category Information</h5>
                    <div class="row">                                
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Segment</label>
                                <select onchange="getCategoryBySegment();" name="businesssegment" id="businesssegment" class="form-select form-control">
                                    <option value=''>Select</option>
                                    <?php for ($x = 0; $x < count($segment); $x++) { ?>
                                        <option value='<?= $segment[$x]->segment_id ?>'><?= $segment[$x]->segment_name ?></option>
                                    <?php } ?>                                              
                                </select>

                            </div>                                    
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Category</label>
                                <select onchange="getSubCategoryByCategory();" name="businesscategory" id="businesscategory" class="form-select form-control">
                                    <option value=''>Select</option>
                                    <?php for ($x = 0; $x < count($category); $x++) { ?>
                                        <option value='<?= $category[$x]->category_id ?>'><?= $category[$x]->category_name ?></option>
                                    <?php } ?> 
                                </select>

                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <input type='hidden' name='subcatvalue' id='subcatvalue' value=''/>
                                <label class="form-label">Business Sub Category</label>
                                <span>
                                    <div class="row" id="subcat">

                                    </div>


                                </span>

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
                                <label class="form-label">Email Id</label>
                                <input type="text" class="form-control" id="emailid" name="emailid">
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10">
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Date Of Birth</label>
                                <input type="text" class="form-control flatpickr-input" id="dob" name="dob" placeholder="dd-mm-yyyy">
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


                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label">If you are connected with NGOs, Political parties, Ex-Army Man ? please specify the</label>
                                <div class="row">
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="glink" value="Yes">
                                            <label class="form-radio-label" for="formCheck1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="glink" value="No">
                                            <label class="form-radio-label" for="formCheck1">No</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" id="nameofgroup" name="nameofgroup" placeholder="Name Of organization"> 

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Personal PAN No</label>
                                <input type="text" class="form-control" id="panno" name="panno">
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

                    </div>
                </div>
                <div>
                    <h5 class="font-size-14 mb-3">Referred By BBI Member</h5>
                    <div class="row">                                
                        <div class="col-lg-3 col-md-6">
                            <div class="row">  
                                <div class="col-lg-8 col-md-8 col-sm-7">
                                    <div class=" form-group mb-3">
                                        <label class="form-label">Member Id</label>
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
                                <label class="form-label">Member Name</label>
                                <input type="hidden" name="hidval" id="hidval" value=""/>
                                <input readonly="" type="text" class="form-control" id="sponsorname" id="sponsorname">
                            </div>
                        </div>                                    
                    </div>
                </div>
                <div>
                    <h5 class="font-size-14 mb-3">Business Detail</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Name</label>
                                <input type="text" class="form-control" id="businessname" name="businessname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" id="businessdesignation" name="businessdesignation" onblur="return getBusinessBankDetail();">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Address</label>
                                <input type="text" class="form-control" id="businessaddress" name="businessaddress" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business City</label>
                                <input type="text" class="form-control" id="businesscity" name="businesscity" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">GST Address</label>
                                <input type="text" class="form-control" id="gstaddress" name="gstaddress" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business PAN</label>
                                <input type="text" class="form-control" id="businesspan" name="businesspan" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Current Business</label>
                                <input type="text" class="form-control" id="currentbusiness" name="currentbusiness" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Email</label>
                                <input type="text" class="form-control" id="businessemail" name="businessemail" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Business Website</label>
                                <input type="text" class="form-control" id="businesswebsite" name="businesswebsite" >
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Overall Experience</label>
                                <input type="text" class="form-control" id="businessexp" name="businessexp">
                            </div>                                    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Social Presence</label>
                                <div class="row">

                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="social[]" value="Facebook">
                                            <label class="form-check-label" for="formCheck1">Facebook</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="social[]" value="Instagram">
                                            <label class="form-check-label" for="formCheck1">Instagram</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="social[]" value="Linkedin">
                                            <label class="form-check-label" for="formCheck1">Linkedin</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="social[]" value="Twitter">
                                            <label class="form-check-label" for="formCheck1">Twitter</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="social[]" value="Youtube">
                                            <label class="form-check-label" for="formCheck1">Youtube</label>
                                        </div>
                                    </div>

                                </div>                                
                            </div>                                    
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="font-size-14 mb-3">Business Banking Detail</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Ac No</label>
                                <input type="text" class="form-control" id="businessbankacno" name="businessbankacno">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">IFS Code</label>
                                <input type="text" class="form-control" id="businessbankifsc" name="businessbankifsc" onblur="return getBusinessBankDetail();">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="businessbankname" name="businessbankname" readonly="">
                            </div>                                    
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="businessbankbranch" name="businessbankbranch" readonly="">
                            </div>                                    
                        </div>

                    </div>
                </div>
                <div>
                    <h5 class="font-size-14 mb-3">Business Document</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Shop Act</label>
                                <div class="row">
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="shopact" value="Yes">
                                            <label class="form-radio-label" for="formCheck1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="shopact" value="No">
                                            <label class="form-radio-label" for="formCheck1">No</label>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">License No</label>
                                <input type="text" class="form-control" id="shoplicenseno" name="shoplicenseno">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">GST Registered</label>
                                <div class="row">
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="isgst" value="Yes">
                                            <label class="form-radio-label" for="formCheck1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6">
                                        <div class="form-radio mb-3">
                                            <input class="form-radio-input" type="radio" name="isgst" value="No">
                                            <label class="form-radio-label" for="formCheck1">No</label>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">GST No</label>
                                <input type="text" class="form-control" id="gstno" name="gstno">
                            </div>                                    
                        </div>

                    </div>
                </div>
                <div>
                    <h5 class="font-size-14 mb-3">Payment Detail</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Membership Fee</label>
                                <input type='hidden' name='hiddengst' id='hiddengst' value='0'/>
                                <input type='hidden' name='joiningfee' id='joiningfee' value='0'/>
                                <input readonly='true' type="text" class="form-control" id="membershipfee" name="membershipfee">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Payment Mode</label>
                                <select name="paymentmode" id="paymentmode" class="form-select form-control">
                                    <option value=''>Select</option>
                                    <option value='Cash'>Cash</option>
                                    <option value='Bank Transfer'>Bank Transfer</option>
                                    <option value='QR Scan'>QR Scan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Payment Detail</label>
                                <input type="text" class="form-control" id="paymentdetail" name="paymentdetail" >
                            </div>                                    
                        </div> 
                        <div class="mb-3 col-lg-6">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LcdR7oZAAAAAARotdOhsAkkpayHvS3uGEgzNrUi" data-callback="correctCaptcha"></div>
                                <input type="hidden" name="validcaptcha" id="validcaptcha" value=""/>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- end row -->
                <div class="text-center mt-4">
                    <input type="hidden" name="utr" id="utr" value="<?= time() . rand(1000, 9999) ?>"/>    
                    <input type="reset" class="btn btn-primary waves-effect waves-light" value="Cancel"/>
                    <input type="submit" class="btn btn-success waves-effect waves-light" value="Cretae Member"/>
                </div>
            </form>

        </div>
        <p class="text-center">Already have an account?<a href="login"> Login</a></p>
    </div>
</div>
