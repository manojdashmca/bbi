

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-2 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Sponsor</span>
                                <h4 class="mb-3">
                                    <span class="counter-value"  data-target="<?= $topdata['totalsponsor'] ?>">0</span>
                                </h4>
                            </div>


                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-2 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Income</span>
                                <h4 class="mb-3">
                                    <span class="counter-value"  data-target="<?= $topdata['totalincome'] ?>">0</span>
                                </h4>
                            </div>


                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-2 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Payout Of The month</span>
                                <h4 class="mb-3">
                                    INR <span class="counter-value" data-target="<?= $topdata['payoutofthemonth'] ?>">0</span><sup>*</sup>
                                </h4>
                            </div>

                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->    
        </div><!-- end row-->

        <div class="row">
            
            <!-- end col -->
            <div class="col-xl-6">

                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <h5 class="card-title me-2">Monthwise Income</h5>

                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm">
                                <div id="bar_chart" data-colors='["#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end col -->

            </div>
<!--            <div class="col-xl-6">

                <div class="card card-h-100">
                     card body 
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <h5 class="card-title me-2">Monthly Business Vs Payout</h5>

                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm">
                                <div id="mixed_chart" data-colors='["#fd625e", "#5156be"]' class="apex-charts" dir="ltr"></div> 
                            </div>

                        </div>
                    </div>
                </div>

                 end col 


            </div>-->

            <!-- end col -->
        </div> <!-- end row-->

<!--        <div class="row">

             end row
            <div class="col-xl-12">
                 card 
                <div class="card">
                     card body 
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <h5 class="card-title me-2">Monthly Business Traind</h5>

                        </div>

                        <div class="row align-items-center">
                            <div class="col-xl-12">
                                <div>
                                    <div id="line_chart_datalabel" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                     end card 
                </div>
                 end col 
            </div>

             end col 
        </div>-->
        <!-- end row-->


    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
