<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        
    });


    function bindDatatable() {        
        var level = $("#level").val();        
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
                    url: '<?= CUSTOMPATH ?>my-sponsorship-data',
                    data: function (d) {                        
                        d.level = level;
                    }
                }
            });        
    }
</script>