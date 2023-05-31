<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });

    });


    function bindDatatable() {
        var segment = $("#segment").val();
        var cat = $("#cat").val();       
        $('#sponsorshipview').DataTable().destroy();
        $('#sponsorshipview').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            pageLength: 10,
            order: [[1, 'asc']],
            ajax: {
                method: "POST",
                url: '<?= CUSTOMPATH ?>members-in-my-module-data',
                data: function (d) {
                    d.segment = segment;
                    d.category = cat;
                   
                }
            }
        });
    }
</script>