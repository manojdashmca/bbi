<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Create New Order</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                            <li class="breadcrumb-item active">Add New Order</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Product Order Form</h4>

                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#firstordertab" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">First Order</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#repurchaseordertab" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Repurchase Order</span> 
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                    </div><!-- end card header -->
                    <!-- end card header -->

                    <div class="card-body">
                        <?= session()->getFlashdata('message'); ?>
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="firstordertab" role="tabpanel">
                                <form name="firstorder" id="firstorder" method="post" action="<?= ADMINPATH ?>place-order">
                                    <div class="row"> 
                                        <div>
                                            <h5 class="font-size-14 mb-3">Member Information</h5>
                                            <div class="row">                                
                                                <div class="col-lg-4 col-md-6">
                                                    <div class=" form-group mb-3">
                                                        <label class="form-label">Member Id</label>
                                                        <input placeholder="IBO Id/User Name" autocomplete="off" type="text" class="form-control" id="fiboid" name="fiboid">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">                                    
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Member Name</label>
                                                        <input type="hidden" name="fhidval" id="fhidval" value=""/>
                                                        <input readonly="true" type="text" class="form-control" id="fiboname">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class=" form-group mb-3">
                                                        <button type="button" class="btn btn-primary margintop-29" id="fgetDetail" onclick="return CheckIBODetail('f');">Get Detail</button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Add Product to cart</h5>
                                            <div class="row">  
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Product</label>
                                                        <select class="form-select" id="product" onchange="retriveProductDetail(this.value)">
                                                            <option value="">Select Product</option>                                                        
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Available Stock</label>
                                                        <input class="form-control" id="avlstock" readonly="" />                               
                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>MRP</label>
                                                        <input class="form-control" id="mrp" readonly="" />                               
                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Billing Quantity</label>
                                                        <input class="form-control" id="billingqty"/>                               
                                                    </div>
                                                </div>                                             
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary margintop-29" onclick="return addProductToCart();">Add To Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Cart Information</h5>
                                            <div class="row">                                                                                  
                                                <div class="table-responsive">
                                                    <table id="product-datatable" class="table table-bordered table-hover w-100">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Product Id.</strong></th>
                                                                <th><strong>Product Name</strong></th>
                                                                <th><strong>Product Code</strong></th>                                                                    
                                                                <th><strong>MRP</strong></th>                                                            
                                                                <th><strong>Quantity</strong></th>
                                                                <th><strong>GST % </strong></th>
                                                                <th><strong>SGST </strong></th>
                                                                <th><strong>CGST </strong></th>
                                                                <th><strong>Total Amount</strong></th>
                                                                <th><strong>Action</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>                                                            
                                                                <th colspan="2">Total Product-<span id='tproduct'></span></th>
                                                                <th colspan="2">Total Unit-<span id='tunit'></span></th>
                                                                <th></th>                                                                                                   
                                                                <th colspan="2">Total Tax- <span id='ttax'></span></th>                                                            
                                                                <th colspan="2">Total Amount-<span id='tamount'></span> </th>
                                                                <th></th>
                                                            </tr>
                                                        <tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Payment Information</h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Charge</label>                                                    
                                                        <input type="text" class="form-control" name="fshipping" id="fshipping" value="0" onkeyup="updateBillingAmount();"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Total Billing Amount</label>
                                                        <input type="hidden" name="fhiddentotal" id="fhiddentotal" value="0"/>
                                                        <input readonly type="text" name="fbillingamount" id="fbillingamount" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Payment Type</label>
                                                        <select name="fpaymenttype" id="fpaymenttype" class="form-select">
                                                            <option value="">Select</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="CC">Credit Card</option>
                                                            <option value="DB">Debit Card</option>
                                                            <option value="Transfer">Transfer</option>
                                                            <option value="QR">QR Scan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Payment Detail</label>
                                                        <textarea name="fpaymentdetail" id="fpaymentdetail" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Shipping Information</h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Name</label>                                                    
                                                        <input type="text" class="form-control" name="fshippingname" id="fshippingname"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Address</label>                                                    
                                                        <input type="text" name="fshippingaddress" id="fshippingaddress" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping State</label>                                                    
                                                        <input type="text" name="fshippingstate" id="fshippingstate" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Pincode</label>
                                                        <input type="text" name="fshippingpincode" id="fshippingpincode" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Landmark</label>
                                                        <input type="text" name="fshippinglandmark" id="fshippinglandmark" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Mobile</label>
                                                        <input type="text" name="fshippingmobile" id="fshippingmobile" class="form-control" />
                                                    </div>
                                                </div> 
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Email</label>
                                                        <input type="text" name="fshippingemail" id="fshippingemail" class="form-control" />
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>

                                        <div>
                                            <div class="row">
                                                <div class="text-center mt-4">
                                                    <input type="hidden" name="orderproduct" id="orderproduct" value=""/>
                                                    <input type="hidden" name="utr" id="utr" value="<?= time() . rand(1000, 9999) ?>"/>    
                                                    <input type="reset" class="btn btn-primary waves-effect waves-light" value="Cancel"/>
                                                    <input type="submit" class="btn btn-success waves-effect waves-light" value="Place Order (F)"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <div class="tab-pane" id="repurchaseordertab" role="tabpanel">
                                <form name="repurchaseorder" id="repurchaseorder" method="post" action="<?= ADMINPATH ?>place-repurchase-order">
                                    <div class="row"> 
                                        <div>
                                            <h5 class="font-size-14 mb-3">Member Information</h5>
                                            <div class="row">                                
                                                <div class="col-lg-4 col-md-6">
                                                    <div class=" form-group mb-3">
                                                        <label class="form-label">Member Id</label>
                                                        <input placeholder="IBO Id/User Name" autocomplete="off" type="text" class="form-control" id="riboid" name="riboid">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">                                    
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Member Name</label>
                                                        <input type="hidden" name="rhidval" id="rhidval" value=""/>
                                                        <input readonly="true" type="text" class="form-control" id="riboname">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class=" form-group mb-3">
                                                        <button type="button" class="btn btn-primary margintop-29" id="rgetDetail" onclick="return CheckRIBODetail();">Get Detail</button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Add Product to cart</h5>
                                            <div class="row">  
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Product</label>
                                                        <select class="form-select" id="rproduct" onchange="retriveRProductDetail(this.value)">
                                                            <option value="">Select Product</option>                                                        
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Available Stock</label>
                                                        <input class="form-control" id="ravlstock" readonly="" />                               
                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>DP</label>
                                                        <input class="form-control" id="dp" readonly="" />                               
                                                    </div>
                                                </div>
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>Billing Quantity</label>
                                                        <input class="form-control" id="rbillingqty"/>                               
                                                    </div>
                                                </div>                                             
                                                <div class='col-md-2'>
                                                    <div class="form-group mb-3">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary margintop-29" onclick="return addRProductToCart();">Add To Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Cart Information</h5>
                                            <div class="row">                                                                                  
                                                <div class="table-responsive">
                                                    <table id="rproduct-datatable" class="table table-bordered table-hover w-100">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Product Id.</strong></th>
                                                                <th><strong>Product Name</strong></th>
                                                                <th><strong>Product Code</strong></th>                                                                    
                                                                <th><strong>DP</strong></th>                                                            
                                                                <th><strong>Quantity</strong></th>
                                                                <th><strong>GST % </strong></th>
                                                                <th><strong>SGST </strong></th>
                                                                <th><strong>CGST </strong></th>
                                                                <th><strong>Total Amount</strong></th>
                                                                <th><strong>Action</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>                                                            
                                                                <th colspan="2">Total Product-<span id='rtproduct'></span></th>
                                                                <th colspan="2">Total Unit-<span id='rtunit'></span></th>
                                                                <th></th>                                                                                                   
                                                                <th colspan="2">Total Tax- <span id='rttax'></span></th>                                                            
                                                                <th colspan="2">Total Amount-<span id='rtamount'></span> </th>
                                                                <th></th>
                                                            </tr>
                                                        <tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Payment Information</h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Charge</label>                                                    
                                                        <input type="text" class="form-control" name="rshipping" id="rshipping" value="0" onkeyup="updateRBillingAmount();"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Total Billing Amount</label>
                                                        <input type="hidden" name="rhiddentotal" id="rhiddentotal" value="0"/>
                                                        <input readonly type="text" name="rbillingamount" id="rbillingamount" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Payment Type</label>
                                                        <select name="rpaymenttype" id="rpaymenttype" class="form-select">
                                                            <option value="">Select</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="CC">Credit Card</option>
                                                            <option value="DB">Debit Card</option>
                                                            <option value="Transfer">Transfer</option>
                                                            <option value="QR">QR Scan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Payment Detail</label>
                                                        <textarea name="rpaymentdetail" id="rpaymentdetail" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Shipping Information</h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Name</label>                                                    
                                                        <input type="text" class="form-control" name="rshippingname" id="rshippingname"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Address</label>                                                    
                                                        <input type="text" name="rshippingaddress" id="rshippingaddress" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping State</label>                                                    
                                                        <input type="text" name="rshippingstate" id="rshippingstate" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Pincode</label>
                                                        <input type="text" name="rshippingpincode" id="rshippingpincode" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Landmark</label>
                                                        <input type="text" name="rshippinglandmark" id="rshippinglandmark" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Mobile</label>
                                                        <input type="text" name="rshippingmobile" id="rshippingmobile" class="form-control" />
                                                    </div>
                                                </div> 
                                                <div class="col-lg-3 col-md-3 col-xl-3">
                                                    <div class="form-group ">
                                                        <label for="">Shipping Email</label>
                                                        <input type="text" name="rshippingemail" id="rshippingemail" class="form-control" />
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>

                                        <div>
                                            <div class="row">
                                                <div class="text-center mt-4">
                                                    <input type="hidden" name="rorderproduct" id="rorderproduct" value=""/>
                                                    <input type="hidden" name="rutr" id="rutr" value="<?= time() . rand(1000, 9999) ?>"/>    
                                                    <input type="reset" class="btn btn-primary waves-effect waves-light" value="Cancel"/>
                                                    <input type="submit" class="btn btn-success waves-effect waves-light" value="Place Order (F)"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->       

</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->