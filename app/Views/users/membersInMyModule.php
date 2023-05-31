<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Members In My Module</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Members In MY Module</li>
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
                                        <label class="form-label" for="validationCustom04">Segment</label>
                                        <select class="form-control form-select"  id="segment">
                                            <option value=''>Select</option>
                                            <?php for ($x = 0; $x < count($segment); $x++) { ?>
                                                <option value='<?= $segment[$x]->segment_id ?>'><?= $segment[$x]->segment_name ?></option>
                                            <?php } ?>                                             
                                        </select>

                                    </div>
                                </div> 
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Category</label>
                                        <select class="form-control form-select"  id="cat">
                                            <option value=''>Select</option>
                                            <?php for ($x = 0; $x < count($category); $x++) { ?>
                                                <option value='<?= $category[$x]->category_id ?>'><?= $category[$x]->category_name ?></option>
                                            <?php } ?>                                          
                                        </select>

                                    </div>
                                </div> 

                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">                                        
                                        <button class="btn btn-primary margintop-29" id="searchsubmit" type="button">Search</button>
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
                                <table id="sponsorshipview" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name</th> 
                                            <th>City</th>
                                            <th>Mobile</th>
                                            <th>Segment</th>
                                            <th>Category</th>                                            
                                            <th>DOJ</th>
                                            <th>Status</th>                                            
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