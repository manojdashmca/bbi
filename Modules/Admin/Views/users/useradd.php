<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add New User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin User</a></li>
                            <li class="breadcrumb-item active">Add User</li>
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
                        <h4 class="card-title">User Registration Form</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <form name="useradd" id="useradd" method="post" enctype="multipart/form-data">
                            <div>
                                <h5 class="font-size-14 mb-3">Basic Detail</h5>
                                <div class="row">
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                     
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Date Of Birth</label>
                                            <input type="text" class="form-control flatpickr-input" id="dob" name="dob" placeholder="dd-mm-yyyy">
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
                                            <label class="form-label">Email Id</label>
                                            <input type="text" class="form-control" id="emailid" name="emailid">
                                        </div>                                    
                                    </div>
                                </div>

                                <!-- end row -->
                            </div>
                            
                            <div>
                                <h5 class="font-size-14 mb-3">Banking Detail</h5>
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
                            
                            <div class="text-center mt-4">
                                <input type="hidden" name="utr" id="utr" value="<?=time().rand(1000,9999)?>"/>
                                <input type="reset" class="btn btn-primary waves-effect waves-light" value="Reset"/>
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Submit"/>
                            </div>
                        </form>
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