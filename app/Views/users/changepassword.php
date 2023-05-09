<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Change Password</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
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
                        <h4 class="card-title">Change Password Form</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <div>
                            <h5 class="font-size-14 mb-3">Change Your Password</h5>
                            <form name="changepassword" id="changepassword" method="post" enctype="multipart/form-data">
                                
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="text-center mt-4">
                                            
                                            <input type="reset" class="btn btn-primary waves-effect waves-light" value="Reset"/>
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Submit"/>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
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
