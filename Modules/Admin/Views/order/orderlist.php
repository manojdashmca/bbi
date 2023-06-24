<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Member Payment List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Oder</a></li>
                            <li class="breadcrumb-item active">Member Payment List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name"/>

                                    </div>
                                </div>
                                <!--                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="validationCustom02">Mobile</label>
                                                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile"/>
                                
                                                                    </div>
                                                                </div>-->

                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom03">User Name/Code</label>
                                        <input type="text" class="form-control" id="username" placeholder=" User name"/>

                                    </div>
                                </div>  
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Module</label>
                                        <select name="moduleid" id="moduleid" class="form-control form-select">
                                            <option value="">Select Module</option>
                                            <?php for ($x = 0; $x < count($module); $x++) { ?>
                                                <option value="<?= $module[$x]->lm_id ?>"><?= $module[$x]->lm_name . ' (' . $module[$x]->lm_code . ')' ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Payment Status</label>
                                        <select name="pstatus" id="pstatus" class="form-control form-select">
                                            <option value="">Select Status</option>
                                            <option value="1">Created</option>
                                            <option value="2">Approved</option>
                                            <option value="3">Rejected</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Date Range</label>
                                        <input type="text" class="form-control" id="daterange" placeholder="dd-mm-yyy to dd-mm-yyyy" />

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">                                        
                                        <button class="btn btn-primary margintop-29" id="searchsubmit" type="button">Search</button>  
                                        <button class="btn btn-info margintop-29" id="download" type="button"><i class="fas fa-cloud-download-alt"></i></button>
                                    </div>                                        
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">                        
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered dt-responsive  w-100">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>                                            
                                        <th>Member Name</th>
                                        <th>Payment Date</th>
                                        <th>Joining Fee</th>
                                        <th>Topup Fee</th>
                                        <th>GST</th>
                                        <th>Payment Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Detail</th>
                                        <th>Uploaded Image</th>
                                        <th>Payment Status</th>
                                        <th>Booked Services</th>
                                        <th>Payout Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
