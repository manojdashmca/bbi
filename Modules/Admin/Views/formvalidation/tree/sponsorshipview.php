<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#download').click(function () {
            var code = $("#username").val();
            var level = $("#level").val();            
                       
            window.open("<?=ADMINPATH?>download-referrer-data?code="+code+"&level="+level, "_blank");
        });
        
    });


    function bindDatatable() {

        var code = $("#username").val();
        var level = $("#level").val();
        if (code != '') {
            $('#sponsorshipview').DataTable().destroy();
            $('#sponsorshipview').DataTable({
                responsive: true,
                searching: false,
                processing: true,
                ordering: false,
                bLengthChange: false,
                serverSide: true,
                pageLength: 10,
                //order: [[0, 'desc']],
                ajax: {
                    method: "POST",
                    url: '<?= ADMINPATH ?>tree-sponsorship-data',
                    data: function (d) {
                        d.code = code;
                        d.level = level;
                    }
                }
            });
        }
    }
</script>