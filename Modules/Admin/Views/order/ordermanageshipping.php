<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Manage Shipping</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Oder</a></li>
                            <li class="breadcrumb-item active">Manage Shipping</li>
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
                                        <label class="form-label" for="validationCustom02">Name</label>
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
                                        <label class="form-label" for="validationCustom04">Order No</label>
                                        <input type="text" class="form-control" id="rderno" placeholder="Order No"/>

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
<!--                                        <button class="btn btn-success margintop-29" id="addnew" type="button"><i class=" fas fa-plus-circle"></i> Add New IBO</button>-->
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
                                            <th>Order No</th>
                                            <th>Order Date</th>                                            
                                            <th>Shipping Address</th>
                                            <th>Shipping Status</th>
                                            <th>Shipping Detail</th>                                                                                       
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
<div class="modal fade bs-example-modal-center" id="updateshipping" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Shipping Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name='shipping' id='shipping' method='post'>                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="recipient-name" class="col-form-label">Order No:</label>
                                    <input type="text" class="form-control" id="orderno" name='orderno' readonly/>
                                </div>
                            </div>
                        </div>                        
                    </div>                  
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="recipient-name" class="col-form-label">Shipping Company:</label>
                                    <select  class="form-control" id="shippingcompany" name='shippingcompany'>
                                        <option value="">Select Shipping company</option>
                                        <option>Blue Dart</option>
                                        <option>Professional Courier</option>
                                        <option>DTDC</option>
                                        <option>Delivery</option>
                                        <option>India Post</option>
                                        <option>Gati Express</option>
                                        <option>Ship Rocket</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="recipient-name" class="col-form-label">AWB No:</label>                                    
                                    <input type="text" class="form-control" id="awbno" id='awbno'>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="trnid" id="trnid" value=""/>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Shipping</button>
                </div>
            </form>
        </div>
    </div>
</div>