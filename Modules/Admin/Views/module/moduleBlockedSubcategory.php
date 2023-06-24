<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Sub Category List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Module</a></li>
                            <li class="breadcrumb-item active">Subcategory List</li>
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
                                        <label class="form-label" for="validationCustom04">Module</label>
                                        <select name="moduleid" id="moduleid" class="form-control form-select">

                                            <?php for ($x = 0; $x < count($module); $x++) { ?>
                                                <option value="<?= $module[$x]->lm_id ?>"><?= $module[$x]->lm_name . ' (' . $module[$x]->lm_code . ')' ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Segment Name</label>
                                        <select onchange="getCategoryBySegment();" name="businesssegment" id="businesssegment" class="form-select form-control">
                                            <option value=''>Select</option>
                                            <?php for ($x = 0; $x < count($segment); $x++) { ?>
                                                <option value='<?= $segment[$x]->segment_id ?>'><?= $segment[$x]->segment_name ?></option>
                                            <?php } ?>                                              
                                        </select>
                                        </select>

                                    </div>
                                </div>                                
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Category Name</label>
                                        <select  name="businesscategory" id="businesscategory" class="form-select form-control">
                                            <option value=''>Select</option>
                                            <?php for ($x = 0; $x < count($category); $x++) { ?>
                                                <option value='<?= $category[$x]->category_id ?>'><?= $category[$x]->category_name ?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
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
                            <table id="example" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>     
                                        <th>Sub Category Name</th> 
                                        <th>Category Name</th> 
                                        <th>Segment Name</th> 
                                        <th>Access Status</th>
                                        <th>Used Status</th>                                            
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
