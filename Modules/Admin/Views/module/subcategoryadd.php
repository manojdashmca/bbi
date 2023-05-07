<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add New Sub Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Module</a></li>
                            <li class="breadcrumb-item active">Add Sub Category</li>
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
                        <h4 class="card-title">Sub Category Add Form</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <div>
                            <h5 class="font-size-14 mb-3">Sub Category Information</h5>
                            <form name="moduleadd" id="moduleadd" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">                                    
                                            <div class="form-group  mb-3">
                                                <label class="form-label">Segment</label>
                                                <select class="form-control form-select" id="segment" name="segment" onchange="getSegmentByCategory();">
                                                    <option value="">Select Segment</option>
                                                    <?php foreach ($segment as $segmentdata) { ?>
                                                        <option value="<?= $segmentdata->segment_id ?>"><?= $segmentdata->segment_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>                                  

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">                                    
                                            <div class="form-group  mb-3">
                                                <label class="form-label">Category</label>
                                                <select class="form-control form-select" id="category" name="category">
                                                    <option value="">Select Category</option>
                                                    
                                                </select>
                                            </div>                                  

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">                                    
                                            <div class="form-group  mb-3">
                                                <label class="form-label">Sub Category Name</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>                                  

                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="text-center mt-4 col-lg-4 col-md-6">
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
