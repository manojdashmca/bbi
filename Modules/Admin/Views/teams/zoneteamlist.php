<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Zone Team List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teams</a></li>
                            <li class="breadcrumb-item active">Zone Team List</li>
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
                                        <label class="form-label" for="validationCustom02">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="username"/>

                                    </div>
                                </div>                               

                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Date Range</label>
                                        <input type="text" class="form-control" id="daterange" placeholder="dd-mm-yyy to dd-mm-yyyy" />

                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                    <div class="mb-3">                                        
                                        <button class="btn btn-primary margintop-29" id="searchsubmit" type="button">Search</button>
                                        <?php if (in_array(32, session()->get('accesscontrols'))) { ?>
                                            <button class="btn btn-success margintop-29" data-bs-toggle="modal" type="button" data-bs-target="#adduser"><i class=" fas fa-plus-circle"></i> Add New Member To The Team</button>
                                        <?php } ?>
                                    </div>                                        
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">                        
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>                                            
                                        <th>Name</th> 
                                        <th>Code</th>
                                        <th>User Name</th>
                                        <th>DOJ</th> 
                                        <th>Join Type</th> 
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
<!-- End Page-content -->
<div class="modal fade bs-example-modal-center" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Member To Zone Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name='addmember' id='addmember' method='post'>                 
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
                                    <input type="hidden" id="table" name='table' value='team_zone'/>
                                    <input type="hidden" id="hiddenmemberid" name='hiddenmemberid' value=''/>
                                    <input readonly="" type="text" class="form-control" id="membername" id='membername'>
                                </div>
                            </div>
                        </div>
                    </div>                  


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
