<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Image Gallery</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                            <li class="breadcrumb-item active">Album List</li>
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
                                        <label class="form-label" for="validationCustom01">Album Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name"/>

                                    </div>
                                </div>                                 
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Date Range</label>
                                        <input type="text" class="form-control" id="daterange" placeholder="dd-mm-yyy to dd-mm-yyyy" />

                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                                    <div class="mb-3">                                        
                                        <button class="btn btn-primary margintop-29" id="searchsubmit" type="button">Search</button>
                                        <button class="btn btn-success margintop-29" data-bs-toggle="modal" type="button" data-bs-target="#addalbummodal"><i class=" fas fa-plus-circle"></i> Add Album</button>
                                    </div>                                        
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="albumlist" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Album Name</th>
                                        <th>Create Date</th> 
                                        <th>No Of Image</th>
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
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<div class="modal fade bs-example-modal-center" id="addalbummodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name='addalbum' id='addalbum' method='post'>                 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="recipient-name" class="col-form-label">Album Name</label>
                                        <input type="text" class="form-control" id="albumname" name='albumname'>

                                    </div>
                                </div>
                                
                            </div>
                        </div>                        
                    </div>                  


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Album</button>
                </div>
            </form>
        </div>
    </div>
</div>
