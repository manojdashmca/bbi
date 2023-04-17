<script>
    $(document).ready(function () {
        $('#firstorder').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                fiboid: {
                    validators: {
                        notEmpty: {
                            message: "IBO Id is required"
                        }
                    }
                }, fhidval: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on the getdetail"
                        }
                    }
                }, fhiddentotal: {
                    excluded: false,
                    validators: {
                        greaterThan: {
                            value: 999,
                            message: 'Firstorder must minimum value 1000'
                        }
                    }
                }, fpaymenttype: {
                    validators: {
                        notEmpty: {
                            message: "Select Payment type"
                        }
                    }
                }, fpaymentdetail: {
                    validators: {
                        notEmpty: {
                            message: "Enter payment detail"
                        }
                    }
                }, fshippingname: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Name Required"
                        }
                    }
                }, fshippingaddress: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Address Required"
                        }
                    }
                }, fshippingstate: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Address Is Required"
                        }
                    }
                }, fshippingpincode: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Pincode Is Required"
                        }
                    }
                }, fshippingmobile: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Mobile Is Required"
                        }
                    }
                }
            }

        });
        $('#repurchaseorder').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                riboid: {
                    validators: {
                        notEmpty: {
                            message: "IBO Id is required"
                        }
                    }
                }, rhidval: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on the getdetail"
                        }
                    }
                }, rhiddentotal: {
                    excluded: false,
                    validators: {
                        greaterThan: {
                            value: 1,
                            message: 'You need to add atleast one product'
                        }
                    }
                }, rpaymenttype: {
                    validators: {
                        notEmpty: {
                            message: "Select Payment type"
                        }
                    }
                }, rpaymentdetail: {
                    validators: {
                        notEmpty: {
                            message: "Enter payment detail"
                        }
                    }
                }, rshippingname: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Name Required"
                        }
                    }
                }, rshippingaddress: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Address Required"
                        }
                    }
                }, rshippingstate: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Address Is Required"
                        }
                    }
                }, rshippingpincode: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Pincode Is Required"
                        }
                    }
                }, rshippingmobile: {
                    validators: {
                        notEmpty: {
                            message: "Shipping Mobile Is Required"
                        }
                    }
                }
            }

        });
    });

    //---------------------First Order Related----------------
    var products =<?php echo json_encode($allproduct); ?>;
    var rawproduct = <?php echo json_encode($allproduct); ?>;
    var productdata = Array();
    var defaultdata = {'totalproduct': 0, 'totalunit': 0, 'totalgst': 0, 'totalamount': 0, 'dataSet': productdata};
    createProductDropDown(products);
    createProductTable(defaultdata);


    function createProductDropDown(products) {
        var productdata = '<option value="">Select Product </option>';
        if (products.length > 0) {

            for (var i = 0; i < products.length; i++) {
                if (products[i].product_type == 1 || products[i].product_type == 3) {
                    productdata += '<option value="' + products[i].product_id + '">' + products[i].product_name + '</option>';
                }
            }
        }
        document.getElementById('product').innerHTML = productdata;
    }
//creating the product table with count
    function createProductTable(dataarray) {
        //bindDatatable(dataarray.dataSet);
        var totalproduct = dataarray.totalproduct;
        var totalunit = dataarray.totalunit;
        var totalgst = dataarray.totalgst;
        var totalamount = dataarray.totalamount;
        $('#tproduct').html(totalproduct);
        $('#tunit').html(totalunit);
        $('#ttax').html(totalgst);
        $('#tamount').html(totalamount);
        bindDatatable(dataarray.dataSet);
    }

    //binding the data table
    function bindDatatable(dataSet) {
        $('#product-datatable').DataTable().destroy();
        $('#product-datatable').DataTable({
            responsive: true,
            searching: false,
            ordering: false,
            bLengthChange: false,
            serverSide: false,
            bPaginate: false,
            bInfo: false,
            data: dataSet
        });
    }
    function retriveProductDetail(productid) {
        for (var i = 0; i < rawproduct.length; i++) {
            if (rawproduct[i].product_id == productid) {
                document.getElementById('avlstock').value = rawproduct[i].product_avl_stock;
                document.getElementById('mrp').value = rawproduct[i].product_mrp;
                break;
            }
        }
    }


    function createHiddenElement(arraydata) {
        var data = JSON.stringify(arraydata);
        var adata = JSON.parse(data);
        var newData = Array();
        for (var i = 0; i < adata.length; i++) {
            adata[i][8] = '';
            newData.push(adata[i]);
        }
        $('#orderproduct').val(JSON.stringify(newData));
    }
//adding the product to data table
    function addProductToCart() {
        var product = $('#product').val();
        var shipping = $('#fshipping').val();
        var billingqty = Number($('#billingqty').val());
        var avlstock = Number($('#avlstock').val());
        var productdetail = getProductDetailById(product);
        if (product == '') {
            Swal.fire('', 'Please Select a product', 'error');
            $('#product').focus();
            return false;
        }
        if (billingqty == '' || billingqty == 0) {
            Swal.fire('', 'Enter Billing Quantity', 'error');
            $('#billingqty').focus();
            return false;
        }
        if (!/^[0-9]+$/.test(billingqty)) {
            Swal.fire('', 'Only numbers are allowed', 'error');
            $('#billingqty').focus();
            return false;
        }
        if (billingqty > avlstock) {
            Swal.fire('', 'Stocks not available', 'error');
            $('#billingqty').focus();
            return false;
        }

        var edata = [product, productdetail.product_name, productdetail.product_sku, productdetail.product_mrp, billingqty, productdetail.product_tax_percent, productdetail.product_gst_on_mrp * billingqty / 2, productdetail.product_gst_on_mrp * billingqty / 2, productdetail.product_mrp * billingqty, "<i class='fa fa-trash' style='cursor:pointer;' onclick='return removeProductFromTable(" + product + ");'></i>"];
        productdata.push(edata);
        defaultdata['totalproduct'] = productdata.length;
        defaultdata['totalunit'] = Number(defaultdata['totalunit']) + Number(billingqty);
        defaultdata['totalgst'] = Number(defaultdata['totalgst']) + Number(productdetail.product_gst_on_mrp) * Number(billingqty);
        defaultdata['totalamount'] = Number(defaultdata['totalamount']) + Number(productdetail.product_mrp) * Number(billingqty);
        defaultdata['dataset'] = productdata;
        createProductTable(defaultdata);
        removeProduct(product);
        createHiddenElement(defaultdata['dataset']);
        $('#fhiddentotal').val(Number(defaultdata['totalamount']));
        $('#fbillingamount').val(Number($('#fhiddentotal').val()) + Number(shipping));
        $('#firstorder').formValidation("revalidateField", "fhiddentotal");
        $('#billingqty').val('');
        $('#avlstock').val('');
        $('#mrp').val('');
        alertify.success('Product added to cart');
    }
    //removing the added product after the add product event
    function removeProduct(id) {
        for (var i = 0; i < products.length; i++) {
            if (id == products[i].product_id) {
                products.splice(i, 1);
                break;
            }
        }
        createProductDropDown(products);
    }
    //for removing the product from the datatable
    function removeProductFromTable(id) {
        var shipping = $('#fshipping').val();
        for (var i = 0; i < productdata.length; i++) {
            if (id == productdata[i][0]) {
                var q = productdata[i][4];
                var m = productdata[i][3];
                var t = productdata[i][4];
                var sg = productdata[i][6];
                var cg = productdata[i][7];
                productdata.splice(i, 1);
                defaultdata['totalproduct'] = productdata.length;
                defaultdata['totalunit'] = Number(defaultdata['totalunit']) - Number(q);
                defaultdata['totalgst'] = Number(defaultdata['totalgst']) - Number(sg) - Number(cg);
                defaultdata['totalamount'] = Number(defaultdata['totalamount']) - Number(m) * Number(q);
                break;
            }
        }
        $('#fhiddentotal').val(Number(defaultdata['totalamount']));
        $('#fbillingamount').val(Number($('#fhiddentotal').val()) + Number(shipping));
        $('#firstorder').formValidation("revalidateField", "fhiddentotal");
        defaultdata['dataset'] = productdata;
        createProductTable(defaultdata);
        addProductToDropdown(id);
        createHiddenElement(defaultdata['dataset']);
    }
    //to add the removed product to product dropdown
    function addProductToDropdown(id) {
        for (var i = 0; i < rawproduct.length; i++) {
            if (id == rawproduct[i].product_id) {
                products.push(rawproduct[i]);
                break;
            }
        }
        createProductDropDown(products);
    }
    //for getting the product detail
    function getProductDetailById(id) {
        for (var i = 0; i < rawproduct.length; i++) {
            if (id == rawproduct[i].product_id) {
                return rawproduct[i];
            }
        }
    }

    function updateBillingAmount() {
        var shippingamount = $('#fshipping').val();
        var fbillingamount = $('#fhiddentotal').val();
        if (isNaN(shippingamount)) {
            swal("Enter a valid integer");
            $('#fshipping').focus();
            return false;
        }
        $('#fbillingamount').val(Number(fbillingamount) + Number(shippingamount));


    }

    function CheckIBODetail() {
        $('#fhidval').val('');
        var iboid = $('#fiboid').val();
        if (iboid != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-ibo-by-id-order/' + iboid,
                data: {ordertype: 'f'},
                success: function (data)
                {
                    var jsonData = JSON.parse(data);
                    console.log(jsonData);
                    if (jsonData.status != 'error') {
                        var obj = jsonData.data;
                        $('#fhidval').val(obj.id_user);
                        $('#fiboname').val(obj.user_title + ' ' + obj.user_name);
                        $('#fshippingname').val(obj.user_title + ' ' + obj.user_name);
                        $('#fshippingaddress').val(obj.user_address + ' , ' + obj.user_post_office + ' , ' + obj.user_district + ' , ' + obj.user_city);
                        $('#fshippingstate').val(obj.user_state);
                        $('#fshippingpincode').val(obj.user_pincode);
                        $('#fshippingmobile').val(obj.user_mobile);
                        $('#fshippingemail').val(obj.user_email);
                        $('#firstorder').formValidation("revalidateField", "fhidval");
                        $('#firstorder').formValidation("revalidateField", "fshippingname");
                        $('#firstorder').formValidation("revalidateField", "fshippingaddress");
                        $('#firstorder').formValidation("revalidateField", "fshippingstate");
                        $('#firstorder').formValidation("revalidateField", "fshippingpincode");
                        $('#firstorder').formValidation("revalidateField", "fshippingmobile");
                        Swal.fire('', jsonData.message, jsonData.status);
                    } else {
                        $('#fhidval').val('');
                        $('#fiboname').val('');
                        $('#fshippingname').val('');
                        $('#fshippingaddress').val('');
                        $('#fshippingstate').val('');
                        $('#fshippingpincode').val('');
                        $('#fshippingmobile').val('');
                        $('#fshippingemail').val('');
                        Swal.fire('', jsonData.message, jsonData.status);
                    }
                }
            });
        } else {
            Swal.fire('', 'Enter a IBO id and click on get detail to get the detail!', 'error');
        }
    }
    //---------------------First Order Related----------------
    //---------------------Repurchase Order Related----------------
    var rproducts =<?php echo json_encode($allproduct); ?>;
    var rrawproduct = <?php echo json_encode($allproduct); ?>;
    var rproductdata = Array();
    var rdefaultdata = {'totalproduct': 0, 'totalunit': 0, 'totalgst': 0, 'totalamount': 0, 'dataSet': rproductdata};
    createRProductDropDown(rproducts);
    createRProductTable(rdefaultdata);


    function createRProductDropDown(rproducts) {
        var rproductdata = '<option value="">Select Product </option>';
        if (rproducts.length > 0) {

            for (var i = 0; i < rproducts.length; i++) {
                if (rproducts[i].product_type == 2 || rproducts[i].product_type == 3) {
                    rproductdata += '<option value="' + rproducts[i].product_id + '">' + rproducts[i].product_name + '</option>';
                }
            }
        }
        document.getElementById('rproduct').innerHTML = rproductdata;
    }
//creating the product table with count
    function createRProductTable(dataarray) {
        //bindDatatable(dataarray.dataSet);
        var totalproduct = dataarray.totalproduct;
        var totalunit = dataarray.totalunit;
        var totalgst = dataarray.totalgst;
        var totalamount = dataarray.totalamount;
        $('#rtproduct').html(totalproduct);
        $('#rtunit').html(totalunit);
        $('#rttax').html(totalgst);
        $('#rtamount').html(totalamount);
        bindRDatatable(dataarray.dataSet);
    }

    //binding the data table
    function bindRDatatable(dataSet) {
        $('#rproduct-datatable').DataTable().destroy();
        $('#rproduct-datatable').DataTable({
            responsive: true,
            searching: false,
            ordering: false,
            bLengthChange: false,
            serverSide: false,
            bPaginate: false,
            bInfo: false,
            data: dataSet
        });
    }
    function retriveRProductDetail(productid) {
        for (var i = 0; i < rrawproduct.length; i++) {
            if (rrawproduct[i].product_id == productid) {
                document.getElementById('ravlstock').value = rrawproduct[i].product_avl_stock;
                document.getElementById('dp').value = rrawproduct[i].product_dp;
                break;
            }
        }
    }


    function createRHiddenElement(arraydata) {
        var data = JSON.stringify(arraydata);
        var adata = JSON.parse(data);
        var newData = Array();
        for (var i = 0; i < adata.length; i++) {
            adata[i][8] = '';
            newData.push(adata[i]);
        }
        $('#rorderproduct').val(JSON.stringify(newData));
    }
//adding the product to data table
    function addRProductToCart() {
        var product = $('#rproduct').val();
        var shipping = $('#rshipping').val();
        var billingqty = Number($('#rbillingqty').val());
        var avlstock = Number($('#ravlstock').val());
        var productdetail = getRProductDetailById(product);
        if (product == '') {
            Swal.fire('', 'Please Select a product', 'error');
            $('#rproduct').focus();
            return false;
        }
        if (billingqty == '' || billingqty == 0) {
            Swal.fire('', 'Enter Billing Quantity', 'error');
            $('#rbillingqty').focus();
            return false;
        }
        if (!/^[0-9]+$/.test(billingqty)) {
            Swal.fire('', 'Only numbers are allowed', 'error');
            $('#rbillingqty').focus();
            return false;
        }
        if (billingqty > avlstock) {
            Swal.fire('', 'Stocks not available', 'error');
            $('#rbillingqty').focus();
            return false;
        }

        var edata = [product, productdetail.product_name, productdetail.product_sku, productdetail.product_dp, billingqty, productdetail.product_tax_percent, productdetail.product_gst_on_dp * billingqty / 2, productdetail.product_gst_on_dp * billingqty / 2, productdetail.product_dp * billingqty, "<i class='fa fa-trash' style='cursor:pointer;' onclick='return removeRProductFromTable(" + product + ");'></i>"];
        rproductdata.push(edata);
        rdefaultdata['totalproduct'] = rproductdata.length;
        rdefaultdata['totalunit'] = Number(rdefaultdata['totalunit']) + Number(billingqty);
        rdefaultdata['totalgst'] = Number(rdefaultdata['totalgst']) + Number(productdetail.product_gst_on_dp) * Number(billingqty);
        rdefaultdata['totalamount'] = Number(rdefaultdata['totalamount']) + Number(productdetail.product_dp) * Number(billingqty);
        rdefaultdata['dataset'] = rproductdata;
        createRProductTable(rdefaultdata);
        removeRProduct(product);
        createRHiddenElement(rdefaultdata['dataset']);
        $('#rhiddentotal').val(Number(rdefaultdata['totalamount']));
        $('#rbillingamount').val(Number($('#rhiddentotal').val()) + Number(shipping));
        $('#repurchaseorder').formValidation("revalidateField", "rhiddentotal");
        $('#rbillingqty').val('');
        $('#ravlstock').val('');
        $('#dp').val('');
        alertify.success('Product added to cart');
    }
    //removing the added product after the add product event
    function removeRProduct(id) {
        for (var i = 0; i < rproducts.length; i++) {
            if (id == rproducts[i].product_id) {
                rproducts.splice(i, 1);
                break;
            }
        }
        createRProductDropDown(rproducts);
    }
    //for removing the product from the datatable
    function removeRProductFromTable(id) {
        var shipping = $('#fshipping').val();
        for (var i = 0; i < rproductdata.length; i++) {
            if (id == rproductdata[i][0]) {
                var q = rproductdata[i][4];
                var m = rproductdata[i][3];
                var t = rproductdata[i][4];
                var sg = rproductdata[i][6];
                var cg = rproductdata[i][7];
                rproductdata.splice(i, 1);
                rdefaultdata['totalproduct'] = rproductdata.length;
                rdefaultdata['totalunit'] = Number(rdefaultdata['totalunit']) - Number(q);
                rdefaultdata['totalgst'] = Number(rdefaultdata['totalgst']) - Number(sg) - Number(cg);
                rdefaultdata['totalamount'] = Number(rdefaultdata['totalamount']) - Number(m) * Number(q);
                break;
            }
        }
        $('#rhiddentotal').val(Number(rdefaultdata['totalamount']));
        $('#rbillingamount').val(Number($('#rhiddentotal').val()) + Number(shipping));
        $('#repurchaseorder').formValidation("revalidateField", "rhiddentotal");
        rdefaultdata['dataset'] = rproductdata;
        createRProductTable(rdefaultdata);
        addRProductToDropdown(id);
        createRHiddenElement(rdefaultdata['dataset']);
    }
    //to add the removed product to product dropdown
    function addRProductToDropdown(id) {
        for (var i = 0; i < rrawproduct.length; i++) {
            if (id == rrawproduct[i].product_id) {
                rproducts.push(rrawproduct[i]);
                break;
            }
        }
        createRProductDropDown(rproducts);
    }
    //for getting the product detail
    function getRProductDetailById(id) {
        for (var i = 0; i < rrawproduct.length; i++) {
            if (id == rrawproduct[i].product_id) {
                return rrawproduct[i];
            }
        }
    }

    function updateRBillingAmount() {
        var shippingamount = $('#rshipping').val();
        var rbillingamount = $('#rhiddentotal').val();
        if (isNaN(shippingamount)) {
            swal("Enter a valid integer");
            $('#rshipping').focus();
            return false;
        }
        $('#rbillingamount').val(Number(rbillingamount) + Number(shippingamount));


    }

    function CheckRIBODetail() {
        $('#rhidval').val('');
        var iboid = $('#riboid').val();
        if (iboid != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-ibo-by-id-order/' + iboid,
                data: {ordertype: 'r'},
                success: function (data)
                {
                    var jsonData = JSON.parse(data);                    
                    if (jsonData.status != 'error') {
                        var obj = jsonData.data;
                        $('#rhidval').val(obj.id_user);
                        $('#riboname').val(obj.user_title + ' ' + obj.user_name);
                        $('#rshippingname').val(obj.user_title + ' ' + obj.user_name);
                        $('#rshippingaddress').val(obj.user_address + ' , ' + obj.user_post_office + ' , ' + obj.user_district + ' , ' + obj.user_city);
                        $('#rshippingstate').val(obj.user_state);
                        $('#rshippingpincode').val(obj.user_pincode);
                        $('#rshippingmobile').val(obj.user_mobile);
                        $('#rshippingemail').val(obj.user_email);
                        $('#repurchaseorder').formValidation("revalidateField", "rhidval");
                        $('#repurchaseorder').formValidation("revalidateField", "rshippingname");
                        $('#repurchaseorder').formValidation("revalidateField", "rshippingaddress");
                        $('#repurchaseorder').formValidation("revalidateField", "rshippingstate");
                        $('#repurchaseorder').formValidation("revalidateField", "rshippingpincode");
                        $('#repurchaseorder').formValidation("revalidateField", "rshippingmobile");
                        Swal.fire('', jsonData.message, jsonData.status);
                    } else {
                        $('#rhidval').val('');
                        $('#riboname').val('');
                        $('#rshippingname').val('');
                        $('#rshippingaddress').val('');
                        $('#rshippingstate').val('');
                        $('#rshippingpincode').val('');
                        $('#rshippingmobile').val('');
                        $('#rshippingemail').val('');
                        Swal.fire('', jsonData.message, jsonData.status);
                    }
                }
            });
        } else {
            Swal.fire('', 'Enter a IBO id and click on get detail to get the detail!', 'error');
        }
    }
    //---------------------Repurchase Order Related----------------
</script>