<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">IBO Virtual BP List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">IBO</a></li>
                            <li class="breadcrumb-item active">IBO Virtual BP List</li>
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
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile"/>

                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom03">User Name</label>
                                        <input type="text" class="form-control" id="username" placeholder=" User name"/>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">PAN</label>
                                        <input type="text" class="form-control" id="pan" placeholder="PAN"/>

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
                                        <button class="btn btn-success margintop-29" data-bs-toggle="modal" data-bs-target="#addTransaction" type="button"><i class=" fas fa-plus-circle"></i> Add Virtual BP</button>
                                    </div>                                        
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name</th>
                                            <th>User Name</th>                                            
                                            <th>Mobile</th>                                            
                                            <th>Position</th>
                                            <th>Trn Type</th>
                                            <th>BP Value</th>
                                            <th>LVBP</th>
                                            <th>RVBP</th>
                                            <th>Trn Date</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Added By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<div class="modal fade bs-example-modal-center" id="addTransaction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name='adddata' id='adddata' method='post'>
                <input type='hidden' name='utr' id='utr' value="<?=time().rand(1000,9999)?>"/>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="recipient-name" class="col-form-label">Member Id:</label>
                                        <input type="text" class="form-control" id="memberid" name='memberid'>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <div class="mt-5">                                        
                                        <button class="btn btn-primary" type="button" onclick="return CheckMember();"><i class="bx bx-search-alt align-middle"></i></button>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="recipient-name" class="col-form-label">Member Name:</label>
                                    <input type="hidden" id="hiddenmemberid" name='hiddenmemberid' value=''/>
                                    <input readonly="" type="text" class="form-control" id="membername" id='membername'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">                            
                            <div class="form-group mb-3">
                                <label for="recipient-name" class="col-form-label">BP Position:</label>
                                <select class="form-control" id="position" name='position'>
                                    <option value="">Select BP Type</option>
                                    <option value="1">Left</option>
                                    <option value="2">right</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="recipient-name" class="col-form-label">BP Amount:</label>
                                    <input type="text" class="form-control" id="amount" name='amount'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6">                            
                            <div class="form-group mb-3">
                                <label for="recipient-name" class="col-form-label">Transaction Remark:</label>
                                <input class="form-control" id="remark" name='remark'> 

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transact Now</button>
                </div>
            </form>
        </div>
    </div>
</div>