<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">List Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users List</li>
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
                                        <label class="form-label" for="validationCustom01">User name</label>
                                        <input type="text" class="form-control" id="username" id="name" placeholder="name"/>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">User Mobile</label>
                                        <input type="text" class="form-control" id="usermobile" id="mobile" placeholder="mobile" />

                                    </div>
                                </div>                                
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Status</label>
                                        <select class="form-control" name="choices-multiple-remove-button"
                                                id="status" placeholder="This is a placeholder" multiple>
                                            <option value="1">Active</option>
                                            <option value="99">In-Active</option>
                                            <option value="2">Blocked</option>                                            
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Date Range</label>
                                        <input type="text" class="form-control" id="datepicker-range" placeholder="dd-mm-yyy to dd-mm-yyyy" required>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">                                        
                                        <button class="btn btn-primary margintop-29" id="searchsubmit" type="button">Search</button>&nbsp;
                                        <button class="btn btn-success margintop-29" id="addnew" type="button"><i class=" fas fa-plus-circle"></i> Add New User</button>
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
                                <table id="userlist" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>        
                                            <th>Sl No</th>
                                            <th>Name</th>
                                            <th>User Id</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Date Of Join</th>
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