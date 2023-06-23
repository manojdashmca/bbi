<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Member Payout List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payout</a></li>
                            <li class="breadcrumb-item active">Member Payout List</li>
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
                                        <label class="form-label" for="validationCustom03">Payout</label>
                                        <select name='payoutdate' id='payoutdate' class="form-control form-select" >
                                            <option value=''>All Payout</option>
                                            <?php for ($x = 0; $x < count($dropdown); $x++) { ?>
                                                <option value='<?= $dropdown[$x]->payout_date_id ?>'><?= $dropdown[$x]->startdate . ' To ' . $dropdown[$x]->enddate ?></option>
                                            <?php } ?>
                                        </select>

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
                                        <button class="btn btn-success margintop-29" id="download" type="button"><i class=" fas fa-plus-circle"></i> Download Payout</button>
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
                                <table id="example" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>                                            
                                            <th>Member Name</th>
                                            <th>Payout Range</th>
                                            <th>Gross Income</th>
                                            <th>TDS Deducted</th>
                                            <th>Net Income</th>
                                            <th>Release Status</th>
                                            <th>Release Date</th> 
                                            <th>Release Detail</th>                                            
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
