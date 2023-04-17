<?php if (in_array('prescription', $modals)) { ?>
    <!-- Prescription Details Modal -->
    <div class="modal fade custom-modal" id="prescription_details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Prescription Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card">                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="biller-info">
                                            <h4 class="d-block" id='drname'></h4>
                                            <span class="d-block text-sm text-muted" id='drdesignation'></span>
<!--                                            <span class="d-block text-sm text-muted">Newyork, United States</span>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-right">
                                        <div class="billing-info">
                                            <h4 class="d-block" id='consultationdate'></h4>
                                            <span class="d-block text-muted">#INV0001</span>
                                        </div>
                                    </div>
                                </div>

                               

                                <!-- Prescription Item -->
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center" id="medicationData">
                                                <thead>
                                                    <tr>
                                                        <th style="min-width: 200px">Name</th>
                                                        <th style="min-width: 80px;">Quantity</th>
                                                        <th style="min-width: 80px">Days</th>
                                                        <th style="min-width: 100px;">Time</th>
                                                        <th style="min-width: 100px;">Intake</th>
                                                        <th style="min-width: 100px;">Frequency</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='tbcontent'>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Prescription Item -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Prescription Details Modal -->
    <script type="text/javascript">
        function getPrescriptionDetail(id) {
            $.ajax({
                type: "get",
                url: '/get-prescription-detail/' + id,
                success: function (data)
                {
                    var obj = JSON.parse(data);
                    if (obj.status == 'success') {
                        var medication = obj.data;
                        $('#drdesignation').html(medication[0].sp_doctor_designation);
                        $('#drname').html(medication[0].user_name);
                        $('#consultationdate').html(medication[0].prescription_created_date);
                        
                        var dmorning='No';
                        var dafternoon='No';
                        var devening='No';
                        var dnight='No';
                        var dintake='';
                        var dfrequency='';
                        var rowdata = '';
                        
                        for (var i = 0; i < medication.length; i++) {
                                if(medication[i].morning==1){dmorning='Yes'}
                                if(medication[i].afternoon==1){dafternoon='Yes'}
                                if(medication[i].evening==1){devening='Yes'}
                                if(medication[i].night==1){dnight='Yes'}
                                if(medication[i].intake==1){dintake='After Food'}else{dintake='Before Food'}
                                if(medication[i].frequency==1){dfrequency='Daily'}
                                if(medication[i].frequency==2){dfrequency='Alternative Day'}
                                if(medication[i].frequency==3){dfrequency='Once In a week'}
                                if(medication[i].frequency==4){dfrequency='Once In a month'}
                            rowdata += ' <tr><td>' + medication[i].medicine + ' </td>';
                            rowdata += '<td> '+medication[i].quantity+' </td>';
                            rowdata += '<td> '+medication[i].days+' Days </td>';
                            rowdata += '<td>Morning:'+dmorning+'<br/>Afternoon:'+dafternoon+'<br/>Evening:'+devening+'<br/>Night:'+dnight+'</td>'
                            rowdata += '<td> '+dintake+'</td>';
                            rowdata += '<td>'+dfrequency+'</td></tr>';

                        }
                        $('#medicationData tr:last').after(rowdata);
                    }
                }
            });
        }
    </script>


    <?php
}?>