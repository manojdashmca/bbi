<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Member List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Member</a></li>
                            <li class="breadcrumb-item active">Member List</li>
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
                                        <label class="form-label" for="validationCustom04">Module</label>
                                        <select name="moduleid" id="moduleid" class="form-control form-select">
                                            <option value="">Select Module</option>
                                            <?php for ($x=0;$x<count($module);$x++){?>
                                            <option value="<?=$module[$x]->lm_id?>"><?=$module[$x]->lm_name.' ('.$module[$x]->lm_code.')'?></option>
                                            <?php }?>
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
                                        <button class="btn btn-success margintop-29" id="addnew" type="button"><i class=" fas fa-plus-circle"></i> Add Member</button>
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
                                <table id="userlist" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name</th>
                                            <th>User Name</th>
                                            <th>Module Name</th>
                                            <th>City</th>
                                            <th>Mobile</th>
                                            <th>Sponsor Code & Name</th>
                                            <th>Segment</th>
                                            <th>Category</th>
                                            <th>DOJ</th>
                                            <th>Status</th>
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
<div class="modal fade bs-example-modal-center" id="changesponsorforuser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name='changesponsor' id='changesponsor' method='post'>                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="recipient-name" class="col-form-label">New Sponsor Id:</label>
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
                                    <label for="recipient-name" class="col-form-label">New Sponsor Name:</label>
                                    <input type="hidden" id="hiddenmemberid" name='hiddenmemberid' value=''/>
                                    <input readonly="" type="text" class="form-control" id="membername" id='membername'>
                                </div>
                            </div>
                        </div>
                    </div>                  


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userid" id="userid" value=""/>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>